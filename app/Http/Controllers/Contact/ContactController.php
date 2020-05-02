<?php
namespace App\Http\Controllers\Contact;

use App\Http\Controllers\Controller;
use App\Models\Contact;
use Illuminate\Http\Request;

class ContactController extends Controller{

    protected $rules = [
        'nama' => 'required',
        'alamat' => 'required',
        'phone' => 'required',
        'instansi' => 'nullable',
        'jabatan' => 'nullable'
    ];

    public function index(Request $request)
    {
        $contacts = Contact::filter($request->all())->paginate(20);
        return view('contact.index',compact('contacts'));
    }

    public function create()
    {
        $contact = new Contact();
        return view('contact.form',compact('contact'));
    }

    public function doCreate(Request $request)
    {
        $request->validate($this->rules);

        $contact = new Contact();
        $contact->fill($request->only(array_keys($this->rules)));
        $contact->save();

        return redirect()->route('contact')->with('popup-info','Sukses input kontak');
    }

    public function edit($id)
    {
        $contact = Contact::findOrFail($id);

        return view('contact.form',compact('contact'));
    }

    public function doEdit($id, Request $request)
    {
        $request->validate($this->rules);

        $contact = Contact::findOrFail($id);
        $contact->fill($request->only(array_keys($this->rules)));
        $contact->save();

        return redirect()->back()->with('success','Sukses edit kontak');
    }

    public function doDelete(Request $request)
    {
        $request->validate(['id' => 'required']);

        $contact = Contact::findOrFail($request->input('id'));

        $contact->delete();

        return redirect()->route('contact')->with('popup-warning','Sukses hapus kontak');
    }
}
