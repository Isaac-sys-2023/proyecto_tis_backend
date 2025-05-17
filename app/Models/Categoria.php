<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Categoria extends Model
{
    protected $table = 'categoria'; 
    protected $primaryKey = 'idCategoria'; 
    public $timestamps = false;

    protected $fillable = [
        'nombreCategoria',
        'descCategoria',
        'habilitada', // AÑADIDO (si no existe, agregar a la tabla)
        'idArea',
        'maxPost',
        'montoCate', 
        'idConvocatoria', 
    ];

    public function area()
    {
        return $this->belongsTo(Area::class, 'idArea');
    }

    public function cursos()
    {
        return $this->belongsToMany(Curso::class, 'categoria_curso', 'idCategoria', 'idCurso');
    }

    public function convocatoria()
    {
        return $this->belongsTo(Convocatoria::class, 'idConvocatoria');
    }
    
}