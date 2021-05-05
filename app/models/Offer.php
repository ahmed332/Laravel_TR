<?php

namespace App\models;

use Illuminate\Database\Eloquent\Model;

class Offer extends Model
{
    protected $tabel ='offers';
    protected $fillable =['name_ar','name_en','email','detales_ar','detales_en','photo','created_at','updated_at'];
    protected $hidden =['created_at','updated_at','email'];
}
