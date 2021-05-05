<?php

namespace App\Http\Controllers;

use App\Models\Country;
use App\models\Doctor;
use App\models\Hospital;
use App\Models\Medical;
use App\models\Patient;
use App\models\phone;
use App\models\Servece;
use App\User;
use Illuminate\Http\Request;

class Relation extends Controller
{
    public function hasOneRelation()
    {
        return  $user =user::with(['phone'=>function($q){
        $q->select('code', 'phone', 'user_id');
      }])->find(1);

       $phone =phone::with(['user'=>function($q){
          $q->select('name','id');
      }])->find(14);

      return response()->json($phone);


    }
    public function wherHas()
    {
        //return user hasphone with there phone
      return User::whereHas('phone',function($q){

        $q->where('code','020');
      })
      ->with(['phone'=>function($q){
          $q->select('phone','user_id');
      }]
      )->get();


    }
    //getUserWhereHasPhoneWithConditio
    public function getUserWhereHasPhoneWithCondition(){
       $user=user::whereDoesntHave('phone')->get();
        return response()->json($user);

    }








    //ONE TO MANY

    public function getHospitalDoctors(){
         $hospital= Hospital::with('doctors')->find(2);
         $doctors= $hospital->doctors;
    // foreach ($doctors as $key ) {
    //  echo  $key->name;
    // };
    $doctor=Doctor::find(3);
    return $doctor->hospital->name;



        return response()->json($doctor);
    }

    public function hospitals()
    {

          $hospitals = Hospital::select('id', 'name', 'address')->get();

        return view('doctors.hospitals', compact('hospitals'));
    }
      public function doctors($id)
    {
       $hospital_id = Hospital::find($id);
      $docctor_in_hospital= $hospital_id->doctors;

      return view('doctors.doctors',compact('docctor_in_hospital'));

    }

    public function hospitalsHasDoctor(){
      $a = Hospital::whereHas('doctors')->get();
        return response()->json($a);
    }
    public function hospitalsHasOnlyMaleDoctors(){
       $a = Hospital::with('doctors')->whereHas('doctors',function($q){

            $q->where('gender',1);
        })->get();
        return response()->json($a);

    }
    public function deleteHospital($id){
       $hospital= Hospital::find($id);
       $hospital->doctors()->delete();
       $hospital->delete();
       return redirect() -> route('hospital.all');
    }




    public function getDoctorServices(){


         $doctor = Doctor::with('services')->find(4);
         return $doctor->name;
     }
//MANY TO MANY

     public function getDoctorServicesById($doctorId)
    {
        $doctor = Doctor::find($doctorId);
         $services = $doctor->services;  //doctor services

        $doctors = Doctor::select('id', 'name')->get();
        $allServices = Servece::select('id', 'name')->get(); // all db serves

        return view('doctors.services', compact('services', 'doctors', 'allServices'));
    }
    public function saveServicesToDoctors(Request $request)
    {

          $doctor = Doctor::with('services')->find($request->doctor_id);
        if (!$doctor)
            return abort('404');
        // $doctor ->services()-> attach($request -> servicesIds);  // many to many insert to database
        //$doctor ->services()-> sync($request -> servicesIds);


        $doctor->services()->sync($request->servicesIds);
        return 'success';
    }

    public function getPatientDoctor()
    {
         $patient = Medical::find(2);
        return $patient->patient;
    }

    public function getCountryDoctor()
    {
         $country =Country::find(1);
        return $country->doctors[0];
    }



}
