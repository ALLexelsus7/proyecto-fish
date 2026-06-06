<?php
// con 'php artisan make:model ContactMessage -m' hago el modelo y migracion
namespace App\Models;

use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

#[Fillable(['nombre', 'email', 'asunto', 'mensaje', 'leido'])]
class ContactMessage extends Model
{
    use HasFactory;
}
