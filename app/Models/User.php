<?php
//  Este modelo se creo por default y le agregue cosas
namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Database\Factories\UserFactory;
use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Attributes\Hidden;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

#[Fillable(['name', 'email', 'password', 'rol'])]
#[Hidden(['password', 'remember_token'])]
class User extends Authenticatable
{
    /** @use HasFactory<UserFactory> */
    use HasFactory, Notifiable;

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    public function favoritos()
    {
        // Relación de muchos a muchos
        return $this->belongsToMany(Producto::class, 'favoritos', 'user_id', 'producto_id')->withTimestamps();
    }

    // Función para verificar el rol del usuario (la uso en el blade edit.blade.php del perfil)
    public function hasRol(string $rol): bool
    {
        return $this->rol === $rol;
    }
}
