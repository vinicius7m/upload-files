<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('home');
    }

    public function upload() {
        $document = \Request::file('documento');

        $userUuid = \Request::get('userUuid');

        // 'public' is a directory of root Laravel app
        $publicPath = public_path().'/documents/'.$userUuid;

        $fileName = $document->getClientOriginalName();

        $document->move($publicPath, $document);
    }
}
