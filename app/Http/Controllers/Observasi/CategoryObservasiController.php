<?php
namespace App\Http\Controllers\Observasi;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Disaster\DisasterBase;
use App\Models\Observation;
use App\Models\ObserveCategory;
use Illuminate\Http\Request;

class CategoryObservasiController extends Controller
{
    protected $rules = [
        'title' => 'required',
        'description' => 'required'
    ];

    public function index(Request $request)
    {
        $categories = ObserveCategory::orderBy('order','desc')->get();
        return view('common.observation_category',compact('categories'));
    }

    public function create(Request $request)
    {
        $cat = new ObserveCategory();
        return view('common.observation_category_form',compact('cat'));
    }

    public function edit($id, Request $request)
    {
        $cat = ObserveCategory::findOrFail($id);
        return view('common.observation_category_form',compact('cat'));
    }

    public function doCreate(Request $request)
    {
        $request->validate($this->rules);

        $cat = new ObserveCategory();
        $cat->fill($request->only(array_keys($this->rules)));
        $cat->save();

        return redirect()->back()->with('popup-info','Berhasil membuat');
    }

    public function doEdit(Request $request)
    {
        $request->validate(array_merge($this->rules,['id' => 'required']));

        $cat = ObserveCategory::findOrFail($request->input('id'));

        $cat->fill($request->only(array_keys($this->rules)));
    }
    public function up($id)
    {
        $cat = ObserveCategory::findOrFail($id);
        $next_cat = $cat->order + 1;
        ObserveCategory::where(['order' => $next_cat])->update([
            'order' => $cat->order ? $cat->order : 0
        ]);

        $cat->order = $next_cat;
        $cat->save();

        return redirect()->back()->with('popup-info','Berhasil mengurutkan');
    }

}
