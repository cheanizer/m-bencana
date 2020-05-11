<?php
namespace App\Http\Controllers\Stock;

use App\Http\Controllers\Controller;
use App\Models\Location;
use Illuminate\Http\Request;

class StockController extends Controller
{
    public function index(Request $request){
        $disaster = session()->get('disaster');
        if (empty ($disaster)) return redirect()
        ->route('dashboard')
        ->with('popup-warning','Silahkan pilih bencana aktif dahulu');
        $locations = Location::where('bencanaid',$disaster->bencanaid)
        ->paginate(config('site.pagination'));
        return view('stock.index',compact('disaster','locations'));
    }

    public function create()
    {

    }

    public function edit()
    {

    }
}
