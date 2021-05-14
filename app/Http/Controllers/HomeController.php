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
        /**
         * Request related
         */
        $file = \Request::file('documento');

        $userId = \Request::get('userId');

        /** 
         * Public related
        */

        // 'public' is a directory of root Laravel app
        $publicPath = public_path().'/documents/'.$userId;

        $fileName = $file->getClientOriginalName();

        /**
         * Database related
        */
        $fileModel = new \App\Document();
        $fileModel->name = $fileName;

        $user = \App\User::find($userId);
        $user->documents()->save($fileModel);

        return $file->move($publicPath, $fileName);
    }
}
