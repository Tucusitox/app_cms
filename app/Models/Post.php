<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class Post
 * 
 * @property int $id_post
 * @property int $fk_user
 * @property string $post_code
 * @property string $post_img
 * @property string $post_tittle
 * @property string $post_body
 * @property Carbon $post_date
 * 
 * @property User $user
 *
 * @package App\Models
 */
class Post extends Model
{
	use SoftDeletes;
	
	protected $table = 'posts';
	protected $primaryKey = 'id_post';
	public $timestamps = false;

	protected $casts = [
		'fk_user' => 'int',
		'post_date' => 'datetime'
	];

	protected $fillable = [
		'fk_user',
		'post_code',
		'post_img',
		'post_tittle',
		'post_body',
		'post_date'
	];

	public function user()
	{
		return $this->belongsTo(User::class, 'fk_user');
	}
}
