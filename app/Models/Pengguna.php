<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\SoftDeletes;
/**
 * @property int $id
 * @property string $name
 * @property string $email
 * @property string $phone_number
 * @property string $password
 * @property string $level
 * @property string $created_at
 * @property string $updated_at
 * @property string $deleted_at
 * @property Lahan[] $lahans
 */
class Pengguna extends Authenticatable
{
    use Notifiable, SoftDeletes;
    use HasFactory;
    /**
     * @var array
     */
    protected $table = 'pengguna';
    protected $fillable = ['name', 'email', 'phone_number', 'password', 'level', 'alamat','created_at', 'updated_at', 'deleted_at'];

    protected $hidden = [
        'password', 'remember_token',
    ];
    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function lahans()
    {
        return $this->hasMany('App\Lahan', 'id_user');
    }

}
