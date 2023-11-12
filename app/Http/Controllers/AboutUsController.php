<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AboutUsController extends Controller
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
        
        return view('student.about-us');
    }
}
