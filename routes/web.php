<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/


Route::get('/', function () {
    return view('welcome');
});
Route::get('/dashboard', function () {

    return 'Not adualt';
}) -> name('not.adult');
Auth::routes();


Route::get('/home', 'HomeController@index')->name('home');

Route::group(['prefix' => LaravelLocalization::setLocale(), 'middleware' => ['localeSessionRedirect', 'localizationRedirect', 'localeViewPath']], function () {

    Route::group(['prefix' => 'offer','namespace'=>'Offers'], function () {
           Route::get('create','GetOffers@create')->name('create.offer');
           Route::post('store', 'GetOffers@store')->name('offers.store');


           Route::get('edit/{id}','GetOffers@editOffer'); //get spicieal offer from db offer/edit/'.$offer->id)}
           Route::Post('update/{id}','GetOffers@updateOffer')->name('offers.update');


           Route::get('all','GetOffers@getAllOffers')->name('offers.all');
           Route::get('delete/{id}','GetOffers@DeleteOffer')->name('offer.delete');


    });








});
  ###################### Begin Ajax routes #####################
  Route::group(['prefix' => 'ajax-offers','namespace'=>'offers'], function () {
    Route::get('create', 'OfferController@create')->name('ajax.create.store');
    Route::post('store', 'OfferController@store')->name('ajax.offers.store');
    Route::get('all', 'OfferController@all')->name('ajax.offers.all');
    Route::post('delete', 'OfferController@delete')->name('ajax.offers.delete');
    Route::get('edit/{offer_id}', 'OfferController@edit')->name('ajax.offers.edit');
    Route::post('update', 'OfferController@Update')->name('ajax.offers.update');
});
###################### End Ajax routes #####################
###################### strart midelware #####################
Route::group(['middleware' => 'CheckAge','namespace' => 'Auth'], function () {
    Route::get('adults', 'CustomController@adualt')-> name('adult');
});
###################### End  midelware #####################
################### Begin relations  routes ######################

Route::get('has-one','Relation@hasOneRelation');

Route::get('get-user-has-phone','Relation@wherHas');


Route::get('get-user-has-phone-with-condition','Relation@getUserWhereHasPhoneWithCondition');

Route::get('get-user-not-has-phone','Relation\RelationsController@getUserNotHasPhone');

################## Begin one To many Relationship #####################

################## Begin one To many Relationship #####################
Route::get('hospital-has-many','Relation@getHospitalDoctors');

Route::get('hospitals','Relation@hospitals') -> name('hospital.all');

Route::get('doctors/{id}','Relation@doctors')-> name('hospital.doctors');




Route::get('hospitals/{id}','Relation@deleteHospital') -> name('hospital.delete');

Route::get('hospitals_has_doctors','Relation@hospitalsHasDoctor');

Route::get('hospitals_has_doctors_male','Relation@hospitalsHasOnlyMaleDoctors');

Route::get('hospitals_not_has_doctors','Relation\RelationsController@hospitals_not_has_doctors');


################## End one To many Relationship #####################

################## Begin  Many To many Relationship #####################

Route::get('doctors-services','Relation@getDoctorServices');

Route::get('service-doctors','Relation@getServiceDoctors');


Route::get('doctors/services/{doctor_id}','Relation@getDoctorServicesById')-> name('doctors.services');
Route::Post('saveServices-to-doctor','Relation@saveServicesToDoctors')-> name('save.doctors.services');


################## End Many To many Relationship #####################

######################### has one through ##########################


Route::get('has-one-through','Relation@getPatientDoctor');

Route::get('has-many-through','Relation@getCountryDoctor');


################### End relations  routes ########################


