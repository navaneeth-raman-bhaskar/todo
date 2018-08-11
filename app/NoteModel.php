<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class NoteModel extends Model
{
    protected $table='notes';
//    public $timestamps = true;
    public function insertNote($data){

       $this->insert($data);
        return;
    }
    function takeNote($id){
        $note=$this->where('id',$id)->first();
        return $note;
    }
    function takeNotes(){
        $note=$this->get();
        return $note;
    }
    function removeNote($id){
        $status= $this->where('id',$id)->delete();
        return $status;
    }

    function editNote($id,$data){
        $stat=$this->where('id', $id)
            ->update(['data' => $data]);
        return $stat;
    }
}
