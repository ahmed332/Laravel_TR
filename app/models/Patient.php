<?php

namespace App\models;

use App\Models\Medical;
use Illuminate\Database\Eloquent\Model;

class Patient extends Model
{
    protected $table = "patients";
    protected $fillable=['name','age','address'];
    public $timestamps = false;

    public function doctor(){
        return $this -> hasOneThrough(Doctor::class,Medical::class,'patient_id','medical_id','id','id');
    }

}
