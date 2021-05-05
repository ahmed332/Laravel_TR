
  @extends('layouts.app')
  @extends('layouts.navbar')


  @section('content')
  <div class="container">
    <div class="alert alert-success" id="success_msg" style="display: none;">
        تم الحزف بنجاح
    </div>
  @if (session('success'))
  <div class="alert alert-primary" role="alert">
      {{session('success')}}
   </div>
   @endif

  <table class="table">

    <thead>
      <tr>
        <th scope="col">id</th>
        <th scope="col">{{__('messages.name')}}</th>
        <th scope="col">{{__('messages.mail')}}</th>
        <th scope="col">{{__('messages.photo')}}</th>
        <th scope="col">{{__('messages.detales')}}</th>
        <th scope="col">{{__('messages.op')}}</th>
      </tr>
    </thead>
    <tbody>


        @foreach ($offers as $offer )

      <tr class="offerRow{{$offer->id}}">
        <th scope="row">{{$offer->id}} </th>


        <td>{{$offer->name}}</td>
        <td>{{$offer->email}}</td>
        <td>{{$offer->detales}}</td>
                    <td><img  style="width: 90px; height: 90px;" src="{{asset('images/offers/'.$offer->photo)}}"></td>

        <td>
            <a href="{{url('offer/edit/'.$offer->id)}}" class="btn btn-success"> {{__('messages.update')}}</a>
            <a href="{{route('offer.delete',$offer->id)}}" class="btn btn-danger"> {{__('messages.delete')}}</a>
              <a href="" offer_id="{{$offer ->id}}"  class="delete_btn btn btn-danger"> حذف اجاكس     </a>
            <a href="{{route('ajax.offers.edit',$offer ->id)}}" class="btn btn-success">  تعديل</a>
         </td>
      </tr>
      @endforeach


    </tbody>
  </table>

  @endsection
  @section('script')
    <script>

        $(document).on('click', '.delete_btn', function (e) {
            e.preventDefault();

              var offer_id =  $(this).attr('offer_id');

            $.ajax({
                type: 'post',
                 url: "{{route('ajax.offers.delete')}}",
                data: {
                    '_token': "{{csrf_token()}}",
                    'id' :offer_id
                },
                success: function (data) {

                    if(data.status == true){
                        $('#success_msg').show();
                    }
                    $('.offerRow'+data.id).remove();
                }, error: function (reject) {

                }
            });
        });


    </script>

  @endsection
