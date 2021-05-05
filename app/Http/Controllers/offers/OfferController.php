<?php

namespace App\Http\Controllers\offers;

use App\Http\Controllers\Controller;
use App\models\Offer;
use App\Traits\OfferTrait;
use Illuminate\Http\Request;
use LaravelLocalization;

class OfferController extends Controller
{
    use OfferTrait;

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $offer = Offer::all();
        return view('offers.all',compact('offers',$offer));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('ajaxoffers.create');

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $file_name = $this->saveImage($request->photo, 'images/offers');
        //insert  table offers in database
        $offer = Offer::create([
            'photo' => $file_name,
            'name_ar' => $request->name_ar,
            'name_en' => $request->name_en,
            'email' => $request->email,
            'detales_ar' => $request->detales_ar,
            'detales_en' => $request->detales_en,

        ]);
        if ($offer)
        return response()->json([
            'status' => true,
            'msg' => 'تم الحفظ بنجاح',
        ]);

    else
        return response()->json([
            'status' => false,
            'msg' => 'فشل الحفظ برجاء المحاوله مجددا',
        ]);



    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

        public function all(){

            $offers = Offer::select('id',
               'email',
               'photo',
               'name_' . LaravelLocalization::getCurrentLocale() . ' as name',
               'detales_' . LaravelLocalization::getCurrentLocale() . ' as detales'
           )->limit(10)->get(); // return collection

           return view('ajaxoffers.all', compact('offers'));
       }

        // $offers = Offer::all();
        // return view('ajaxoffers.all', compact('offers'));


    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $offer = Offer::find($id);  // search in given table id only
        if (!$offer)
        return response()->json([
            'status' => false,
            'msg' => 'العرض غير موجود',

        ]);
        $offer = Offer::select('id', 'name_ar', 'name_en', 'detales_ar', 'detales_en', 'email')->find($id);

        return view('ajaxoffers.edit', compact('offer'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $offer=Offer::find($request->offer_id);
        $offer->update($request->all());
        return response()->json([
            'status'=>true,
            'msg'=>'تم التعديل'
        ]);


    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */


     public function delete(Request $request )
    {
        $offer = Offer::find($request->id);   // Offer::where('id','$offer_id') -> first();

        if (!$offer)
            return redirect()->back()->with(['error' => __('messages.offer not exist')]);

            $offer->delete();

            return response()->json([
                'status' => true,
                'msg' => 'تم الحذف بنجاح',
                'id' =>  $request->id
            ]);

    }
}
