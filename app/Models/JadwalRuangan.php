<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class JadwalRuangan
 * 
 * @property int $jadruang_id
 * @property int|null $jadruang_ruang_id
 * @property int|null $jadruang_user_id
 * @property string|null $jadruang_keterangan
 * @property Carbon|null $jadruang_tanggal_mulai
 * @property Carbon|null $jadruang_tanggal_selesai
 * @property string|null $jadruang_status
 * @property Carbon|null $jadruang_created_at
 * @property Carbon|null $jadruang_updated_at
 * 
 * @property MasterRuang|null $master_ruang
 * @property SysUser|null $sys_user
 *
 * @package App\Models
 */
class JadwalRuangan extends Model
{
	protected $table = 'jadwal_ruangan';
	protected $primaryKey = 'jadruang_id';
	public $timestamps = false;

	protected $casts = [
		'jadruang_ruang_id' => 'int',
		'jadruang_user_id' => 'int'
	];

	protected $dates = [
		'jadruang_tanggal_mulai',
		'jadruang_tanggal_selesai',
		'jadruang_created_at',
		'jadruang_updated_at'
	];

	protected $fillable = [
		'jadruang_ruang_id',
		'jadruang_user_id',
		'jadruang_keterangan',
		'jadruang_tanggal_mulai',
		'jadruang_tanggal_selesai',
		'jadruang_status',
		'jadruang_created_at',
		'jadruang_updated_at'
	];

	public function master_ruang()
	{
		return $this->belongsTo(MasterRuang::class, 'jadruang_ruang_id');
	}

	public function sys_user()
	{
		return $this->belongsTo(SysUser::class, 'jadruang_user_id');
	}
}
