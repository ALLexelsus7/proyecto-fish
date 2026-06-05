<?php
// con 'php artisan make:model Review -mf' para hacer el modelo, migracion y factory
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\SoftDeletes; // para que el review no se elimine si se elimina el usuario

#[Fillable(['user_id', 'rating', 'comentario'])]
class Review extends Model
{
    /** @use HasFactory<\Database\Factories\ReviewFactory> */
    use HasFactory, SoftDeletes;

    protected $table = 'reviews';

    // Relacion de una reseña pertenece a un unico Usuario
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
