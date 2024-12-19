<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Foundation\Auth\User as Authenticatable;

/**
 * Class User
 * 
 * @property int $user_id
 * @property int $fk_rol
 * @property string $user_name
 * @property string $email
 * @property string $password
 * @property string $email_verified
 * @property string $user_token
 * @property string|null $user_status
 * 
 * @property Rol $rol
 * @property Collection|Post[] $posts
 * @property Collection|SessionsUser[] $sessions_users
 *
 * @package App\Models
 */
class User extends Authenticatable
{
	protected $table = 'users';
	protected $primaryKey = 'user_id';
	public $timestamps = false;

	protected $casts = [
		'fk_rol' => 'int'
	];

	protected $hidden = [
		'password',
		'user_token'
	];

	protected $fillable = [
		'fk_rol',
		'user_name',
		'email',
		'password',
		'email_verified',
		'user_token',
		'user_status'
	];

	public function rol()
	{
		return $this->belongsTo(Rol::class, 'fk_rol');
	}

	public function posts()
	{
		return $this->hasMany(Post::class, 'fk_user');
	}

	public function sessions_users()
	{
		return $this->hasMany(SessionsUser::class, 'fk_user');
	}
}
