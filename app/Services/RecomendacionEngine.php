<?php

namespace App\Services;

use App\Contracts\ParametrosEspecieProvider;
use App\Models\Lago;
use App\Models\Monitoreo;

class RecomendacionEngine
{
    const TEMP_MIN = 24;
    const TEMP_MAX = 30;
    const TEMP_CRITICO = 32;
    const PH_MIN = 6.5;
    const PH_MAX = 8.5;
    const OXIGENO_MIN = 4;
    const OXIGENO_OPTIMO = 5;

    private ParametrosEspecieProvider $especieProvider;

    public function __construct(?ParametrosEspecieProvider $especieProvider = null)
    {
        $this->especieProvider = $especieProvider ?? new ParametrosEspecieNulo();
    }

    public function analizarLago(Lago $lago): array
    {
        $ultimo = $lago->monitoreos()->latest('fecha_monitoreo')->first();

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
        $recomendaciones = [];
        $parametrosAfectados = [];

        if ($monitoreo->temperatura_agua !== null) {
            $resultado = $this->evaluarTemperatura($monitoreo->temperatura_agua);
            if ($resultado) {
                $recomendaciones[] = $resultado;
                $parametrosAfectados[] = 'temperatura';
            }
        }

        if ($monitoreo->ph !== null) {
            $resultado = $this->evaluarPh($monitoreo->ph);
            if ($resultado) {
                $recomendaciones[] = $resultado;
                $parametrosAfectados[] = 'ph';
            }
        }

        if ($monitoreo->nivel_oxigeno !== null) {
            $resultado = $this->evaluarOxigeno($monitoreo->nivel_oxigeno);
            if ($resultado) {
                $recomendaciones[] = $resultado;
                $parametrosAfectados[] = 'oxigeno';
            }
        }

        $especiesRecs = $this->evaluarEspecies($monitoreo);
        $recomendaciones = array_merge($recomendaciones, $especiesRecs);

        $todosParametros = $parametrosAfectados;
        if (!empty($especiesRecs)) {
            $todosParametros[] = 'especies';
        }

        $nivelRiesgo = $this->clasificarRiesgo(count($todosParametros), $recomendaciones);

        if (empty($recomendaciones)) {
            $recomendaciones[] = [
                'tipo' => 'informacion',
                'mensaje' => 'Todos los parámetros del agua se encuentran dentro de los rangos óptimos. El lago presenta un estado saludable.',
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

    private function evaluarTemperatura(float $temp): ?array
    {
        if ($temp > self::TEMP_CRITICO) {
            return [
                'tipo' => 'advertencia',
                'mensaje' => "La temperatura del agua es de {$temp}°C, superando el límite crítico de " . self::TEMP_CRITICO . "°C. Existe riesgo para las especies. Se recomienda activar sistemas de aireación y monitorear constantemente.",
                'parametro' => 'temperatura_agua',
            ];
        }

        if ($temp > self::TEMP_MAX) {
            return [
                'tipo' => 'advertencia',
                'mensaje' => "La temperatura del agua es de {$temp}°C, superando el rango óptimo de " . self::TEMP_MIN . "°C - " . self::TEMP_MAX . "°C. Se recomienda aumentar la circulación del agua y reducir la exposición solar.",
                'parametro' => 'temperatura_agua',
            ];
        }

        if ($temp < self::TEMP_MIN) {
            return [
                'tipo' => 'recomendacion',
                'mensaje' => "La temperatura del agua es de {$temp}°C, inferior al rango recomendado de " . self::TEMP_MIN . "°C - " . self::TEMP_MAX . "°C. Se recomienda revisar las condiciones y considerar sistemas de calefacción si es necesario.",
                'parametro' => 'temperatura_agua',
            ];
        }

        return null;
    }

    private function evaluarPh(float $ph): ?array
    {
        if ($ph < self::PH_MIN) {
            return [
                'tipo' => 'recomendacion',
                'mensaje' => "El pH del agua es de {$ph}, considerado ácido (rango óptimo: " . self::PH_MIN . " - " . self::PH_MAX . "). Se recomienda aplicar correctores de pH como carbonato de calcio para estabilizar el nivel.",
                'parametro' => 'ph',
            ];
        }

        if ($ph > self::PH_MAX) {
            return [
                'tipo' => 'recomendacion',
                'mensaje' => "El pH del agua es de {$ph}, considerado alcalino (rango óptimo: " . self::PH_MIN . " - " . self::PH_MAX . "). Se recomienda aplicar correctores de pH como materia orgánica o ácidos suaves para reducir la alcalinidad.",
                'parametro' => 'ph',
            ];
        }

        return null;
    }

    private function evaluarOxigeno(float $oxigeno): ?array
    {
        if ($oxigeno < self::OXIGENO_MIN) {
            return [
                'tipo' => 'alerta',
                'mensaje' => "El nivel de oxígeno disuelto es de {$oxigeno} mg/L, críticamente bajo (mínimo recomendado: " . self::OXIGENO_MIN . " mg/L). ¡Acción inmediata requerida! Active sistemas de aireación urgente y reduzca la carga orgánica.",
                'parametro' => 'nivel_oxigeno',
            ];
        }

        if ($oxigeno < self::OXIGENO_OPTIMO) {
            return [
                'tipo' => 'recomendacion',
                'mensaje' => "El nivel de oxígeno disuelto es de {$oxigeno} mg/L, por debajo del rango óptimo de " . self::OXIGENO_OPTIMO . " mg/L. Se recomienda aumentar la aireación y monitorear la calidad del agua.",
                'parametro' => 'nivel_oxigeno',
            ];
        }

        return null;
    }

    private function evaluarEspecies(Monitoreo $monitoreo): array
    {
        $lago = $monitoreo->lago;

        if (!$lago) {
            return [];
        }

        $parametros = $this->especieProvider->obtenerPorLago($lago);

        if ($parametros->isEmpty()) {
            return [];
        }

        $recomendaciones = [];

        foreach ($parametros as $param) {
            $recomendaciones[] = [
                'tipo' => 'informacion',
                'mensaje' => "La especie {$param->nombreEspecie} está siendo evaluada según sus parámetros ideales (Temperatura: {$param->tempMin}°C - {$param->tempMax}°C, pH: {$param->phMin} - {$param->phMax}, Oxígeno mínimo: {$param->oxigenoMin} mg/L). Pendiente de implementación completa.",
                'parametro' => "especie:{$param->nombreEspecie}",
            ];
        }

        return $recomendaciones;
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
