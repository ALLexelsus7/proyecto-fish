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
use Illuminate\Database\Eloquent\SoftDeletes; // para que el usuario no se elimine

#[Fillable(['name', 'email', 'password', 'rol', 'avatar'])]
#[Hidden(['password', 'remember_token'])]
class User extends Authenticatable
{
    /** @use HasFactory<UserFactory> */
    use HasFactory, Notifiable, SoftDeletes;

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
        // Relación de que los favoritos pueden pertenecer a muchos productos
        return $this->belongsToMany(Producto::class, 'favoritos', 'user_id', 'producto_id')->withTimestamps();
    }

    // Función para verificar el rol del usuario (la uso en el blade edit.blade.php del perfil)
    public function hasRol(string $rol): bool
    {
        return $this->rol === $rol;
    }

    public function reviews() { 
        //Relacion de un usuario puede tener varias resenias
        return $this->hasMany(Review::class); 
    }


    public function getAvatarUrlAttribute()
    {
        // Si no hay avatar, devuelve las iniciales del user
        if (!$this->avatar) {
            return 'https://ui-avatars.com/api/?name='.urlencode($this->name).'&color=FF7F50&background=111827';
        }
        
        // Si en la BD dice 'avatars/foto.png', lo convierte a solo 'foto.png'
        $nombreLimpio = basename($this->avatar);
        // basename() limpia basura vieja

        // Arma la ruta final hacia la carpeta pública
        return asset('img/avatars/' . $nombreLimpio);
    }

}
