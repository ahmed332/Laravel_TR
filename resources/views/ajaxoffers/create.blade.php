
  @extends('layouts.app')
  @extends('layouts.navbar')



  @section('content')
  @if (session('success'))
  <div class="alert alert-primary" role="alert">
      {{session('success')}}
   </div>
   @endif

  <div class="text-center">
      <h1>{{__('messages.Add_your_offer')}}</h1>
  </div>
    <div class="container">
        <div class="alert alert-success" id="success_msg" style="display: none;">
            تم الحفظ بنجاح
        </div>

        <form id="offerForm" >

            @csrf
            <div class="form-group">
                <label for="exampleInputEmail1">أختر صوره العرض</label>
                <input type="file" class="form-control" name="photo">
                @error('photo')
                <small class="form-text text-danger">{{$message}}</small>
                @enderror
            </div>

            <div class="form-group">

              <label >{{__("messages.mail")}}</label>
              <input type='email' class="form-control text-center" name="email" aria-describedby="emailHelp"  placeholder="{{__('messages.Enter_Name')}}">
              @error('email')
              <span class="text-danger">{{$message}}</span>
              @enderror
            </div>
            <div class="form-group">
                <label>{{__('messages.Offer_Name_en')}}</label>
                <input type="text" name='name_en' class="form-control text-center "  placeholder="{{__('messages.Offer_Name_en')}}">
                @error('name_en')
                <span class="text-danger">{{$message}}</span>
                @enderror
            </div>
            {{-- //arabic name --}}
            <div class="form-group">
                <label>{{__('messages.Offer_Name_ar')}}</label>
                <input type="text" name='name_ar' class="form-control text-center "  placeholder="{{__('messages.Offer_Name_ar')}}">
                @error('name_ar')
                <span class="text-danger">{{$message}}</span>
                @enderror
            </div>
              <div class="form-group">
                <label >{{__("messages.Offer_Detales_en")}}</label>
                <input name="detales_en" class="form-control text-center"  placeholder="{{__('messages.Offer_Detales_en')}}">
                @error('detales_en')
                <span class="text-danger">{{$message}}</span>
                @enderror
              </div>
              <div class="form-group">
                <label >{{__("messages.Offer_Detales_ar")}}</label>
                <input name="detales_ar" class="form-control text-center"  placeholder="{{__('messages.Offer_Detales_ar')}}">
                @error('detales_ar')
                <span class="text-danger">{{$message}}</span>
                @enderror
              </div>




            <button  id="save_offer"  > submit</button>
        </form>

  </div>



  @endsection
  @section('script')

    <script>

        $(document).on('click', '#save_offer', function (e) {
            e.preventDefault();


            var formData = new FormData($('#offerForm')[0]);

            $.ajax({
                type: 'post',
                enctype: 'multipart/form-data',
                url: "{{route('ajax.offers.store')}}",
                data: formData,
                processData: false,
                contentType: false,
                cache: false,
                success: function (data){
                    if (data.status == true) {
                        $('#success_msg').show();
                    }


                }, error : function (reject){

                }
            });
        });


    </script>
  @endsection
