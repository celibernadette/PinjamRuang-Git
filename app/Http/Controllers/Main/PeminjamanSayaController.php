<?php

namespace App\Http\Controllers\Main;

use App\Http\Controllers\Controller;
use App\Models\JadwalRuangan;
use App\Models\MasterRuang;
use App\Models\SysNotif;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PeminjamanSayaController extends Controller
{
    public function index()
    {
        $dataJadwal = JadwalRuangan::where('jadruang_user_id', '=', auth()->id())->get();
        $parser = ['datas' => $dataJadwal];
        return view('main.peminjamansaya')->with($parser);
    }

    public function create()
    {
        $dataRuang = MasterRuang::get();
        $parser = ['dataRuang' => $dataRuang];
        return view('main.tambahpeminjaman')->with($parser);
    }

    public function update($id)
{
    $dataRuang = MasterRuang::get();
    $parser = ['dataRuang' => $dataRuang];
    return view('main.updatepeminjaman')->with($parser);
}
public function processUpdate(Request $request, $id)
    {
        $request->validate([
            'jadruang_keterangan'      => 'required',
            'jadruang_ruang_id'        => 'required',
            'jadruang_tanggal_mulai'   => 'required',
            'jadruang_tanggal_selesai' => 'required',
            'jam_mulai'                => 'required',
            'jam_selesai'              => 'required',
        ]);

        $process = JadwalRuangan::findOrFail($id)->update($request->except('_token'));
        if ($process) {
            return redirect()->back()->with("success", "data berhasil diperbarui");
        } else {
            return redirect()->back()->withInput()->withErrors("Terjadi kesalahan");
        }
    }

    public function delete($id)
{
    $process = JadwalRuangan::findOrFail($id)->delete();
    if ($process) {
        return redirect()->back()->with("success", "data berhasil dihapus");
    } else {
        return redirect()->back()->withErrors("Terjadi kesalahan saat menghapus
data");
    }
}

    public function store(Request $request)
    {
        $request->validate([
            'jadruang_keterangan'      => 'required',
            'jadruang_ruang_id'        => 'required',
            'jadruang_tanggal_mulai'   => 'required',
            'jadruang_tanggal_selesai' => 'required',
            'jam_mulai'                => 'required',
            'jam_selesai'              => 'required',
        ]);

        try {
            DB::beginTransaction();
            // insert ke tabel jadwal_ruangan
            JadwalRuangan::create([
                'jadruang_ruang_id'        => $request['jadruang_ruang_id'],
                'jadruang_user_id'         => auth()->id(),
                'jadruang_keterangan'      => $request['jadruang_keterangan'],
                'jadruang_tanggal_mulai'   => $request['jadruang_tanggal_mulai'] . ' ' . $request['jam_mulai'],
                'jadruang_tanggal_selesai' => $request['jadruang_tanggal_selesai'] . ' ' . $request['jam_selesai'],
            ]);
            DB::commit();
            return redirect("/main/peminjaman-saya")->with('message', "Permohonan berhasil");
        } catch (Exception $e) {
            return redirect()
                ->back()
                ->withErrors(['message' => $e->getMessage()])
                ->withInput($request->except('_token'));
        }
    }




}
