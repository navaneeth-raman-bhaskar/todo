<?php

namespace App\Http\Controllers;

use App\NoteModel;

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
        $saveObj= new NoteModel();

        $saveObj->data=$note;//dynamic cretion of member variable
        $saveObj->save();//built in save function
        return json_encode($saveObj);

//        $notes=['data'=>$note,'time'=>'2018-08-08'];
//        $saveObj->insertNote($notes);
//        return $this->retrieveDb();
    }

    public function retrieveDb()
    {
        $saveObj= new NoteModel();
        $note=$saveObj->takeNote();
        return $note;
    }
    public function retrieveAllDb()
    {
        $saveObj= new NoteModel();
        $note=$saveObj->takeNotes();
        return $note;
    }

    public function edit($id,$data)
    {
        $editObj= new NoteModel();
        $stat=$editObj->editNote($id,$data);
        return $stat;

    }


    public function remove($id)
    {
        $delObj= new NoteModel();
        $stat=$delObj->removeNote($id);
       return $stat;
    }
}
