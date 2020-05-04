<?php
namespace App\Http\Controllers\Contact;

use App\Http\Controllers\Controller;
use App\Models\Contact;
use Illuminate\Http\Request;

class ContactRestController extends Controller
{
    public function search(Request $request)
    {
        $contact = Contact::filter($request->all())->get();

        return response()->json($contact);
    }
}
