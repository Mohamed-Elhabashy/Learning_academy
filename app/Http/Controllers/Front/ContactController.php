<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Models\Setting;
use Illuminate\Http\Request;

class ContactController extends Controller
{
    public function index(){
        
        $data['setting']=Setting::first();
        return View('Front\Contact\index')->with($data);
    }
}
