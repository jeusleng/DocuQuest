<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Items;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{

    private function checkSession(){
        if(session()->missing('user_id')){
            return redirect('/');
        }
    }

    

    public function GetHome(){
        if ($this->checkSession()) {
            return $this->checkSession();
        }

        return view('student.home');
    }
}
