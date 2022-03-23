<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class SysNotif
 * 
 * @property int $notif_id
 * @property int|null $notif_user_id
 * @property string|null $notif_title
 * @property string|null $notif_message
 * @property Carbon|null $notif_updated_at
 * @property Carbon|null $notif_created_at
 * 
 * @property SysUser|null $sys_user
 *
 * @package App\Models
 */
class SysNotif extends Model
{
	protected $table = 'sys_notif';
	protected $primaryKey = 'notif_id';
	public $timestamps = false;

	protected $casts = [
		'notif_user_id' => 'int'
	];

	protected $dates = [
		'notif_updated_at',
		'notif_created_at'
	];

	protected $fillable = [
		'notif_user_id',
		'notif_title',
		'notif_message',
		'notif_updated_at',
		'notif_created_at'
	];

	public function sys_user()
	{
		return $this->belongsTo(SysUser::class, 'notif_user_id');
	}
}
