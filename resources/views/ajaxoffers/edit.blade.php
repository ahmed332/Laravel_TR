
  @extends('layouts.app')



  @section('content')
  <nav class="navbar navbar-expand-lg navbar-light bg-light">

    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
            aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav mr-auto">
            @foreach(LaravelLocalization::getSupportedLocales() as $localeCode => $properties)
                <li class="nav-item active">
                    <a class="nav-link"
                       href="{{ LaravelLocalization::getLocalizedURL($localeCode, null, [], true) }}"> {{ $properties['native'] }}
                        <span class="sr-only">(current)</span></a>
                </li>
            @endforeach


        </ul>

    </div>
</nav>

        <div class="text-center">
            <h1>{{__('messages.update_your_offer')}}</h1>
        </div>
            <div class="container">



                <form action="" id="offerForm" >

                    @csrf
                    <div class="form-group">
                        @if (session('success'))
                        <div class="alert alert-primary" role="alert">
                            {{session('success')}}
                        </div>
                        @endif
                        <input type="text" style="display: none;" class="form-control" value="{{$offer ->id}}" name="offer_id">

                        <div class="form-group">
                            <label for="exampleInputEmail1">أختر صوره العرض</label>
                            <input type="file" class="form-control" name="photo">
                            @error('photo')
                            <small class="form-text text-danger">{{$message}}</small>
                            @enderror
                        </div>
                    <label >{{__("messages.mail")}}</label>
                    <input type='text'  value="{{$offer->email}}" class="form-control text-center" name="email" aria-describedby="emailHelp"  placeholder="{{__('messages.Enter_Name')}}">
                    @error('email')
                    <span class="text-danger">{{$message}}</span>
                    @enderror
                    </div>
                    <div class="form-group">
                        <label>{{__('messages.Offer_Name_en')}}</label>
                        <input type="text" name='name_en'  value="{{$offer->name_en}}" class="form-control text-center "  placeholder="{{__('messages.Offer_Name_en')}}">
                        @error('name_en')
                        <span class="text-danger">{{$message}}</span>
                        @enderror
                    </div>
                    {{-- //arabic name --}}
                    <div class="form-group">
                        <label>{{__('messages.Offer_Name_ar')}}</label>
                        <input type="text" name='name_ar' value="{{$offer->name_ar}}" class="form-control text-center "  placeholder="{{__('messages.Offer_Name_ar')}}">
                        @error('name_ar')
                        <span class="text-danger">{{$message}}</span>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label >{{__("messages.Offer_Detales_en")}}</label>
                        <input name="detales_en" class="form-control text-center"  value="{{$offer->detales_en}}" placeholder="{{__('messages.Offer_Detales_en')}}">
                        @error('detales_en')
                        <span class="text-danger">{{$message}}</span>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label >{{__("messages.Offer_Detales_ar")}}</label>
                        <input name="detales_ar" value="{{$offer->detales_ar}}" class="form-control text-center"  placeholder="{{__('messages.Offer_Detales_ar')}}">
                        @error('detales_ar')
                        <span class="text-danger">{{$message}}</span>
                        @enderror
                    </div>




                    <button id="edit_offer" class="btn btn-success" btn btn-success > {{__("messages.save")}}</button>
                </form>

        </div>

  @endsection
  @section('script')

    <script>

        $(document).on('click', '#edit_offer', function (e) {
            e.preventDefault();


            var formData = new FormData($('#offerForm')[0]);

            $.ajax({
                type: 'post',
                enctype: 'multipart/form-data',
                url: "{{route('ajax.offers.update')}}",
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
