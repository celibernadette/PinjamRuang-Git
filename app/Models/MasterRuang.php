<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * Class MasterRuang
 * 
 * @property int $ruang_id
 * @property string|null $ruang_nama
 * @property string|null $ruang_lokasi
 * @property Carbon|null $ruang_created_at
 * @property Carbon|null $ruang_updated_at
 * 
 * @property Collection|JadwalRuangan[] $jadwal_ruangans
 * @property Collection|MasterRuangApprover[] $master_ruang_approvers
 *
 * @package App\Models
 */
class MasterRuang extends Model
{
	protected $table = 'master_ruang';
	protected $primaryKey = 'ruang_id';
	public $timestamps = false;

	protected $dates = [
		'ruang_created_at',
		'ruang_updated_at'
	];

	protected $fillable = [
		'ruang_nama',
		'ruang_lokasi',
		'ruang_created_at',
		'ruang_updated_at'
	];

	public function jadwal_ruangans()
	{
		return $this->hasMany(JadwalRuangan::class, 'jadruang_ruang_id');
	}

	public function master_ruang_approvers()
	{
		return $this->hasMany(MasterRuangApprover::class, 'approver_ruang_id');
	}
}
