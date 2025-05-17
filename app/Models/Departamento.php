<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Departamento extends Model
{
    protected $table = 'departamento';
    protected $fillable = ['nombre'];

    public function provincias()
    {
        return $this->hasMany(Provincia::class, 'idDepartamento');
    }
}
