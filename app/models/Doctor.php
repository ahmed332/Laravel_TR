<?php

namespace App\models;

use Illuminate\Database\Eloquent\Model;
use  App\models\Hospital;
use  App\models\Servece;

class Doctor extends Model
{
    protected $table = "doctors";
    protected $fillable=['name','title','hospital_id','medical_id','created_at','updated_at'];
    protected $hidden =['created_at','updated_at','pivot'];
    public $timestamps = true;

    public function hospital(){
        return $this -> belongsTo(Hospital::class,'hospital_id','id');
    }

    public function services(){
        return $this -> belongsToMany(Servece::class,'doctor_service','doctor_id','service_id','id','id');
    }

}
