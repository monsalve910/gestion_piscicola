<?php

namespace App\Services;

use App\Contracts\ParametrosEspecieProvider;
use App\Data\ParametrosEspecie;
use App\Models\Lago;
use App\Models\Monitoreo;

class RecomendacionEngine
{
    private ParametrosEspecieProvider $especieProvider;

    public function __construct(?ParametrosEspecieProvider $especieProvider = null)
    {
        $this->especieProvider = $especieProvider ?? new ParametrosEspecieNulo();
    }

    public function analizarLago(Lago $lago): array
    {
        $ultimo = $lago->monitoreos()
            ->orderBy('fecha_monitoreo', 'desc')
            ->orderBy('created_at', 'desc')
            ->first();

        if (!$ultimo) {
            return [
                'recomendaciones' => [],
                'nivel_riesgo' => 'Sin Datos',
                'parametros_afectados' => [],
                'monitoreo' => null,
            ];
        }

        return $this->analizar($ultimo);
    }

    public function analizar(Monitoreo $monitoreo): array
    {
        $lago = $monitoreo->lago;
        $recomendaciones = [];
        $parametrosAfectados = [];

        $paramsList = $this->especieProvider->obtenerPorLago($lago);

        if ($paramsList->isEmpty()) {
            return [
                'recomendaciones' => [
                    [
                        'tipo' => 'informacion',
                        'mensaje' => 'El lago no tiene una especie con parámetros ideales configurados. Asigne una especie con parámetros para recibir recomendaciones.',
                        'parametro' => 'general',
                    ],
                ],
                'nivel_riesgo' => 'Sin Datos',
                'parametros_afectados' => [],
                'monitoreo' => $monitoreo,
            ];
        }

        $params = $paramsList->first();

        if ($monitoreo->temperatura_agua !== null) {
            $resultado = $this->evaluarTemperatura($monitoreo->temperatura_agua, $params);
            if ($resultado) {
                $recomendaciones[] = $resultado;
                $parametrosAfectados[] = 'temperatura';
            }
        }

        if ($monitoreo->ph !== null) {
            $resultado = $this->evaluarPh($monitoreo->ph, $params);
            if ($resultado) {
                $recomendaciones[] = $resultado;
                $parametrosAfectados[] = 'ph';
            }
        }

        if ($monitoreo->nivel_oxigeno !== null) {
            $resultado = $this->evaluarOxigeno($monitoreo->nivel_oxigeno, $params);
            if ($resultado) {
                $recomendaciones[] = $resultado;
                $parametrosAfectados[] = 'oxigeno';
            }
        }

        $nivelRiesgo = $this->clasificarRiesgo(count($parametrosAfectados), $recomendaciones);

        if (empty($recomendaciones)) {
            $recomendaciones[] = [
                'tipo' => 'informacion',
                'mensaje' => "Las condiciones del lago son adecuadas para la especie {$params->nombreEspecie}. Todos los parámetros están dentro de los rangos ideales.",
                'parametro' => 'general',
            ];
        }

        return [
            'recomendaciones' => $recomendaciones,
            'nivel_riesgo' => $nivelRiesgo,
            'parametros_afectados' => $parametrosAfectados,
            'monitoreo' => $monitoreo,
        ];
    }

    public function generarParaLago(Lago $lago): array
    {
        $resultado = $this->analizarLago($lago);

        if (!$resultado['monitoreo']) {
            return $resultado;
        }

        $lago->recomendaciones()->where('es_actual', true)->update(['es_actual' => false]);

        foreach ($resultado['recomendaciones'] as $rec) {
            $lago->recomendaciones()->create([
                'mensaje' => $rec['mensaje'],
                'tipo' => $rec['tipo'],
                'nivel_riesgo' => $resultado['nivel_riesgo'],
                'parametros' => [
                    'parametro' => $rec['parametro'],
                    'valor' => $resultado['monitoreo']->{$rec['parametro'] === 'general' ? 'estado_general' : $rec['parametro']},
                    'fecha_monitoreo' => $resultado['monitoreo']->fecha_monitoreo->format('Y-m-d'),
                ],
                'es_actual' => true,
            ]);
        }

        return $resultado;
    }

    public function generarTodosLosLagos(): int
    {
        $lagos = Lago::where('estado', 'activo')->get();
        $contador = 0;

        foreach ($lagos as $lago) {
            $resultado = $this->generarParaLago($lago);
            $contador += count($resultado['recomendaciones']);
        }

        return $contador;
    }

    private function evaluarTemperatura(float $temp, ParametrosEspecie $params): ?array
    {
        if ($temp < $params->tempMin) {
            return [
                'tipo' => 'recomendacion',
                'mensaje' => "La temperatura de {$temp}°C está por debajo del rango ideal para {$params->nombreEspecie} ({$params->tempMin}°C - {$params->tempMax}°C). Se recomienda aumentar la temperatura del agua.",
                'parametro' => 'temperatura_agua',
            ];
        }

        if ($temp > $params->tempMax) {
            return [
                'tipo' => 'advertencia',
                'mensaje' => "La temperatura de {$temp}°C excede el rango recomendado para {$params->nombreEspecie} ({$params->tempMin}°C - {$params->tempMax}°C). Se recomienda reducir la temperatura del agua y aumentar la circulación.",
                'parametro' => 'temperatura_agua',
            ];
        }

        return null;
    }

    private function evaluarPh(float $ph, ParametrosEspecie $params): ?array
    {
        if ($ph < $params->phMin) {
            return [
                'tipo' => 'recomendacion',
                'mensaje' => "El pH de {$ph} está por debajo del rango ideal para {$params->nombreEspecie} ({$params->phMin} - {$params->phMax}). El agua está más ácida de lo recomendado.",
                'parametro' => 'ph',
            ];
        }

        if ($ph > $params->phMax) {
            return [
                'tipo' => 'recomendacion',
                'mensaje' => "El pH de {$ph} supera el rango ideal para {$params->nombreEspecie} ({$params->phMin} - {$params->phMax}). El agua está más alcalina de lo recomendado.",
                'parametro' => 'ph',
            ];
        }

        return null;
    }

    private function evaluarOxigeno(float $oxigeno, ParametrosEspecie $params): ?array
    {
        if ($oxigeno < $params->oxigenoMin) {
            return [
                'tipo' => 'alerta',
                'mensaje' => "Los niveles de oxígeno ({$oxigeno} mg/L) son insuficientes para {$params->nombreEspecie} (mínimo: {$params->oxigenoMin} mg/L). Se recomienda mejorar la aireación del lago urgentemente.",
                'parametro' => 'nivel_oxigeno',
            ];
        }

        if ($oxigeno > $params->oxigenoMax) {
            return [
                'tipo' => 'informacion',
                'mensaje' => "Los niveles de oxígeno ({$oxigeno} mg/L) superan el rango ideal para {$params->nombreEspecie} (máximo: {$params->oxigenoMax} mg/L). Monitorear para evitar sobresaturación.",
                'parametro' => 'nivel_oxigeno',
            ];
        }

        return null;
    }

    private function clasificarRiesgo(int $parametrosFuera, array $recomendaciones): string
    {
        $tieneAlerta = collect($recomendaciones)->contains('tipo', 'alerta');

        if ($parametrosFuera >= 2 || $tieneAlerta) {
            return 'Alto Riesgo';
        }

        if ($parametrosFuera === 1) {
            return 'Requiere Atención';
        }

        return 'Saludable';
    }
}
