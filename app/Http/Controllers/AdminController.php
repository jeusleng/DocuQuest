<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AdminController extends Controller
{
    private function checkSession(){
        if(session()->missing('user_id')){
            return redirect('/');
        }
    }

    public function index()
    {
        if ($this->checkSession()) {
            return $this->checkSession();
        }
        
        return view('admin.dashboard');
    }
}
