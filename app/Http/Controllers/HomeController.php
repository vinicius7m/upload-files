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
        $userId = \Auth::user()->id;

        $user = \App\User::with('documents')->find($userId);

        return view('home')->with(compact('user'));
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

    public function download($userId, $documentId) {
        $document = \App\Document::find($documentId);

        $publicPath = public_path().'/documents/'.$userId;

        return \Response::download($publicPath.'/'.$document->name);
    
    }

    public function destroy($userId, $documentId) {
        $document = \App\Document::find($documentId);

        $publicPath = public_path().'/documents/'.$userId;

        $document->delete();

        unlink($publicPath.'/'.$document->name);

        return redirect()->back()->with('success', 'Arquivo removido com sucesso!');
    }
}
