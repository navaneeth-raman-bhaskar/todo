<?php

namespace App\Http\Controllers;

use App\Save;
use Illuminate\Http\Request;

class MainController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
          return view('notes');
    }


    public function add($note)
    {
        $data=['data'=>$note,'date'=>'xx-ee-rr'];
        return $data;
    }

    public function edit()
    {
        //
    }


    public function remove()
    {
        //
    }
}
