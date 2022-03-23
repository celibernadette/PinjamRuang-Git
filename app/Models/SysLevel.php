<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * Class SysLevel
 * 
 * @property int $level_id
 * @property string $level_nama
 * @property Carbon|null $level_created_at
 * @property Carbon|null $level_updated_at
 * 
 * @property Collection|SysUser[] $sys_users
 *
 * @package App\Models
 */
class SysLevel extends Model
{
	protected $table = 'sys_level';
	protected $primaryKey = 'level_id';
	public $timestamps = false;

	protected $dates = [
		'level_created_at',
		'level_updated_at'
	];

	protected $fillable = [
		'level_nama',
		'level_created_at',
		'level_updated_at'
	];

	public function sys_users()
	{
		return $this->hasMany(SysUser::class, 'user_level_id');
	}
}
