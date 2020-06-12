<?php
namespace App\Http\Controllers\Landing;

use App\Http\Controllers\Controller;
use App\Models\Location;
use App\Models\ObservasiLokasi;
use App\Models\ObservasiTransaksi;
use App\Models\Observation;
use App\Models\ObserveCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class LocationApiController extends Controller
{
    public function list(Request $request)
    {
        $locations = Location::filter($request->all())
        ->orderBy('lokasiid','desc')
        ->with('bencana','province','state','district','subdistrict','type')
        ->get();

        return response()->json($locations);
    }

    public function view($id, Request $request)
    {
        $locations = Location::where('lokasiid',$id)
        ->with('bencana','province','state','district','subdistrict','type','contact')
        ->with('observasi')->first();

        return response()->json($locations);
    }

    public function observasi($id)
    {
        $lokasi = Location::findOrFail($id);

        $results = DB::table('observasi')->leftJoin('observasi_lokasi',function($join) use ($lokasi){
            $join->on('observasi.id','=','observasi_lokasi.observasi_id');
            $join->where('observasi_lokasi.lokasiid','=',$lokasi->lokasiid);
        })
        ->join('observasi_kategori','observasi_kategori.id','=','observasi.kategori')
        ->select('observasi.id','observasi.nama','observasi.deskripsi','observasi_kategori.title','observasi_lokasi.posisi_jumlah')
        ->whereNull('observasi.deleted_at')
        ->get();
        return response()->json($results);
    }

    public function observasiOrdered($location_id,Request $request)
    {
        $lokasi = Location::findOrFail($location_id);

        $kategori = ObserveCategory::orderBy('order','desc')->get();
        $results = [];
        foreach ($kategori as $key => $cat)
        {
            $cat->observasies = DB::table('observasi')->leftJoin('observasi_lokasi',function($join) use ($lokasi){
                $join->on('observasi.id','=','observasi_lokasi.observasi_id');
                $join->where('observasi_lokasi.lokasiid','=',$lokasi->lokasiid);
            })
            ->join('observasi_kategori','observasi_kategori.id','=','observasi.kategori')
            ->select('observasi.id','observasi.nama','observasi.deskripsi','observasi_kategori.title','observasi_lokasi.posisi_jumlah')
            ->whereNull('observasi.deleted_at')
            ->where('observasi.kategori',$cat->id)
            ->get();

            array_push($results, $cat);
        }

        return response()->json($results);
    }

    public function createTransaksi(Request $request)
    {
        $rules  = [
            'jumlah' => 'required|integer',
            'lokasiid' => 'required',
            'observasi_id' => 'required',
            'type' => 'required',
            'sumber_tujuan' => 'nullable',
            'keterangan' => 'nullable'
        ];
        $request->validate($rules);
        $trans = new ObservasiTransaksi();
        $trans->fill($request->only(array_keys($rules)));
        if ($trans->type == 'penjumlahan')
        {
            $trans->type = 'penambahan';
        }
        $lokasi = Location::find($request->input('lokasiid'));
        $trans->bencanaid = $lokasi->lokasiid;
        $trans->save();

        $lokasiObservasi = ObservasiLokasi::firstOrCreate([
            'observasi_id' => $trans->observasi_id,
            'lokasiid' => $trans->lokasiid
        ]);

        if ($trans->type == 'penambahan')
        {
            $lokasiObservasi->posisi_jumlah = (int) $lokasiObservasi->posisi_jumlah + (int) $trans->jumlah;
        }

        if ($trans->type == 'pengurangan')
        {
            $lokasiObservasi->posisi_jumlah = (int) $lokasiObservasi->posisi_jumlah - (int) $trans->jumlah;
        }

        $lokasiObservasi->save();

        return response()->json([
            'data' => $trans,
            'message' => 'Sukses membuat transaksi baru'
        ]);
    }
}
