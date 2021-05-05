<?php

namespace App\models;

use App\User;
use Illuminate\Database\Eloquent\Model;

class phone extends Model
{
    protected $tabel ='phones';
    protected $fillable =['code','phone','user_id'];
    protected $hidden = [
        'user_id'
    ];

    public function  user(){
        return $this->belongsTo(user::class,'user_id');
    }
}
