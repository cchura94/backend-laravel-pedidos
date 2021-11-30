<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Categoria extends Model
{
    use HasFactory, SoftDeletes;

    // 1 a N  (1:N)
    public function subcategorias()
    {
        return $this->hasMany(Subcategoria::class);
    }
}
