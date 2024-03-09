<?php

namespace App\Http\Controllers;

use App\Models\State;
use Illuminate\Http\Request;

class IndexController extends Controller
{
    //
    public function index(){
    return State::all();
    }
}
