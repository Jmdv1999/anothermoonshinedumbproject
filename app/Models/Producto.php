<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Producto extends Model
{
    use HasFactory;
    use SoftDeletes;
    protected $fillable = ["nombre", "cantidad", "precio", "categoria_id"];

    public function Categoria(){
        return $this->belongsTo(Categoria::class, 'categoria_id');
    }
}
