<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class MasterRuangApprover
 * 
 * @property int $approver_id
 * @property int|null $approver_ruang_id
 * @property int|null $approver_user_id
 * @property Carbon|null $approver_created_at
 * @property Carbon|null $approver_updated_at
 * 
 * @property MasterRuang|null $master_ruang
 * @property SysUser|null $sys_user
 *
 * @package App\Models
 */
class MasterRuangApprover extends Model
{
	protected $table = 'master_ruang_approver';
	protected $primaryKey = 'approver_id';
	public $timestamps = false;

	protected $casts = [
		'approver_ruang_id' => 'int',
		'approver_user_id' => 'int'
	];

	protected $dates = [
		'approver_created_at',
		'approver_updated_at'
	];

	protected $fillable = [
		'approver_ruang_id',
		'approver_user_id',
		'approver_created_at',
		'approver_updated_at'
	];

	public function master_ruang()
	{
		return $this->belongsTo(MasterRuang::class, 'approver_ruang_id');
	}

	public function sys_user()
	{
		return $this->belongsTo(SysUser::class, 'approver_user_id');
	}
}
