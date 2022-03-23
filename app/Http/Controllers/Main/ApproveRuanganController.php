<?php

namespace App\Http\Controllers\Main;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\JadwalRuangan;
use Illuminate\Support\Facades\DB;

class ApproveRuanganController extends Controller
{
    public function index()
    {
        $dataApprove = DB::table('jadwal_ruangan')
            ->select('jadruang_keterangan', 'jadruang_status', 'jadruang_id', 'ruang_nama', 'ruang_lokasi', 'user_email', 'jadruang_tanggal_mulai'
                , 'jadruang_tanggal_selesai')
            ->join('sys_user', 'user_id', '=', 'jadruang_user_id')
            ->join('master_ruang', 'jadruang_ruang_id', '=', 'ruang_id')
            ->join('master_ruang_approver', 'ruang_id', '=', 'approver_ruang_id')
            ->where('approver_user_id', '=', auth()->id())
            ->groupBy('jadruang_id')
            ->groupBy('ruang_nama')
            ->groupBy('ruang_lokasi')
            ->groupBy('user_email')
            ->groupBy('jadruang_tanggal_mulai')
            ->groupBy('jadruang_tanggal_selesai')
            ->groupBy('jadruang_status')
            ->groupBy('jadruang_keterangan')
            ->get();
        $parser = ['datas' => $dataApprove];

        return view('main.approveruang')->with($parser);
    }

    public function approve(Request $request)
    {
        $dataJadwal = JadwalRuangan::find($request['jad_id']);
        $dataJadwal->jadruang_status = $request['status'];
        $dataJadwal->save();

        return redirect()->back()->with('message', "Berhasil");
    }
}
