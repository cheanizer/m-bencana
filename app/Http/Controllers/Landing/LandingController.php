<?php
namespace App\Http\Controllers\Landing;

use App\Http\Controllers\Controller;

Class LandingController extends Controller
{
    public function index()
    {


        return view('landing.index');
    }
}
