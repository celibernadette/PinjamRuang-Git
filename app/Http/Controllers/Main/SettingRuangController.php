<?php

namespace App\Http\Controllers\Main;
use App\Http\Controllers\Controller;
use App\Models\JadwalRuangan;
use App\Models\MasterRuang;
use App\Models\SysNotif;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class SettingRuangController extends Controller
{
    public function index()
    {
        $dataRuang = MasterRuang::get();
        $parser = ['datas' => $dataRuang];
        return view('main.settingruang')->with($parser);
    }

    public function update($id)
    {
        $dataRuang = MasterRuang::findOrFail($id);
        $parser = ['datas' => $dataRuang];
        return view('main.updatesettingruang')->with($parser);
    }
    public function processUpdate(Request $request, $id)
    {
        $request->validate([
            'ruang_nama'      => 'required',
            'ruang_lokasi'     => 'required',
        ]);

        $process = MasterRuang::findOrFail($id)->update($request->except('_token'));
        if ($process) {
            return redirect()->back()->with("success", "data berhasil diperbarui");
        } else {
            return redirect()->back()->withInput()->withErrors("Terjadi kesalahan");
        }
    }

    public function delete($id)
    {
        $process = MasterRuang::findOrFail($id)->delete();
        if ($process) {
            return redirect()->back()->with("success", "data berhasil dihapus");
        } else {
            return redirect()->back()->withErrors("Terjadi kesalahan saat menghapus
data");
        }
    }
}