<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Save extends Model
{
    protected $table='notes';
   public function insertNote($data){

//       dd($data);
       $this->insert($data);
        return;
    }
    function takeNote(){
        $id=$this->max('id');
        $note=$this->where('id',$id)->first();
        return $note;
    }
    function takeNotes(){
        $id=$this->max('id');
        $note=$this->get();
        return $note;
    }
}
