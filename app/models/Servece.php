<?php

namespace App\models;
use App\models\Doctor;

use Illuminate\Database\Eloquent\Model;

class Servece extends Model
{
    protected $tabel ='serveces';
    protected $fillable =['name','price','created_at','updated_at'];
    protected $hidden =['created_at','updated_at','pivot'];


    public function doctors(){

        return $this -> belongsToMany(Doctor::class,'doctor_service','service_id','doctor_id','id','id');
    }
    
}


