<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Foundation\Auth\User as Authenticatable;

/**
 * Class SysUser
 *
 * @property int $user_id
 * @property int $user_level_id
 * @property string $user_email
 * @property string $user_password
 * @property Carbon|null $user_last_login
 * @property Carbon $user_created_at
 * @property Carbon|null $user_updated_at
 * @property string|null $user_token
 *
 * @property SysLevel $sys_level
 * @property Collection|JadwalRuangan[] $jadwal_ruangans
 * @property Collection|MasterRuangApprover[] $master_ruang_approvers
 * @property Collection|SysNotif[] $sys_notifs
 *
 * @package App\Models
 */
class SysUser extends Authenticatable
{
	protected $table = 'sys_user';
	protected $primaryKey = 'user_id';
	public $timestamps = false;

	protected $casts = [
		'user_level_id' => 'int'
	];

	protected $dates = [
		'user_last_login',
		'user_created_at',
		'user_updated_at'
	];

	protected $hidden = [
		'user_password',
		'user_token'
	];

	protected $fillable = [
		'user_level_id',
		'user_email',
		'user_password',
		'user_last_login',
		'user_created_at',
		'user_updated_at',
		'user_token'
	];

	public function sys_level()
	{
		return $this->belongsTo(SysLevel::class, 'user_level_id');
	}

	public function jadwal_ruangans()
	{
		return $this->hasMany(JadwalRuangan::class, 'jadruang_user_id');
	}

	public function master_ruang_approvers()
	{
		return $this->hasMany(MasterRuangApprover::class, 'approver_user_id');
	}

	public function sys_notifs()
	{
		return $this->hasMany(SysNotif::class, 'notif_user_id');
	}
}
