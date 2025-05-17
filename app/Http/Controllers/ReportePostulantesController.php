<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Postulante;
use App\Models\Curso;

class ReportePostulantesController extends Controller
{
    public function obtenerPostulantesPorCurso($idCurso)
    {
        try {
            // Obtener postulantes con tutor y postulaciones → categoria → area
            $postulantes = Postulante::with([
                'tutor',
                'postulaciones.categoria.area'
            ])
            ->where('idCurso', $idCurso)
            ->get();

            // Transformar datos
            $resultado = $postulantes->map(function ($postulante) {
                $categorias = $postulante->postulaciones->map(function ($postulacion) {
                    return [
                        'nombreCategoria' => $postulacion->categoria->nombreCategoria,
                        'monto' => $postulacion->categoria->montoCate,
                        'area' => [
                            'nombreArea' => $postulacion->categoria->area->tituloArea ?? 'Sin área'
                        ]
                    ];
                });

                return [
                    'postulante' => [
                        'nombrePost' => $postulante->nombrePost,
                        'apellidoPost' => $postulante->apellidoPost,
                        'tutor' => [
                            'nombreTutor' => $postulante->tutor->nombreTutor ?? '',
                            'apellidoTutor' => $postulante->tutor->apellidoTutor ?? ''
                        ]
                    ],
                    'categoria' => $categorias
                ];
            });

            return response()->json($resultado);

        } catch (\Exception $e) {
            return response()->json([
                'error' => 'Error al obtener los datos del reporte.',
                'detalle' => $e->getMessage()
            ], 500);
        }
    }
}
