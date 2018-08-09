<?php

namespace App\Http\Controllers;

use App\Save;

class MainController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $fullnote=$this->retrieveAllDb();

        return view('notes',['notes'=>$fullnote]);
    }
    
    public function add($note)
    {
        $saveObj= new Save();
        $notes=['data'=>$note,'time'=>'2018-08-08'];
        $saveObj->insertNote($notes);
        return $this->retrieveDb();
    }

    public function retrieveDb()
    {
        $saveObj= new Save();
        $note=$saveObj->takeNote();
        return $note;
    }
    public function retrieveAllDb()
    {
        $saveObj= new Save();
        $note=$saveObj->takeNotes();
        return $note;
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
