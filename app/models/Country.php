<?php

namespace App\Models;

use App\models\Doctor;
use App\models\Hospital;
use Illuminate\Database\Eloquent\Model;

class Country extends Model
{
    protected $table = "countries";
    protected $fillable = ['name'];
    public $timestamps = false;




    public function doctors()
    {
        return $this->hasManyThrough(Doctor::class, Hospital::class, 'country_id', 'hospital_id', 'id', 'id');
    }
}
