<?php

namespace App\models;

use App\User;
use Illuminate\Database\Eloquent\Model;
Use App\models\Doctor;

class Hospital extends Model
{
    // protected $table = "hospitals";
    // protected $fillable=['name','address','created_at','updated_at'];
    // protected $hidden =['created_at','updated_at'];
    // public $timestamps = true;


    // public function doctors(){
    //     return $this->hasMany(Doctor::class,'hospital_id','id');


    // }
    protected $table = "hospitals";
    protected $fillable=['name','address','country_id','created_at','updated_at'];
    protected $hidden =['created_at','updated_at'];
    public $timestamps = true;

    public function doctors(){
        return $this -> hasMany(Doctor::class,'hospital_id','id');
    }
}

