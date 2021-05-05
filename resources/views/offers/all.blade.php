
  @extends('layouts.app')
  @extends('layouts.navbar')


  @section('content')
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
        <th scope="col">{{__('messages.detales')}}</th>
        <th scope="col">{{__('messages.photo')}}</th>

        <th scope="col">{{__('messages.op')}}</th>
      </tr>
    </thead>
    <tbody>


        @foreach ($offers as $offer )

      <tr>
        <th scope="row">{{$offer->id}} </th>


        <td>{{$offer->name}}</td>
        <td>{{$offer->email}}</td>
        <td>{{$offer->detales}}</td>
        <td><img  style="width: 90px; height: 90px;" src="{{asset('images/offers/'.$offer->photo)}}"></td>

        <td>
            <a href="{{url('offer/edit/'.$offer->id)}}" class="btn btn-success"> {{__('messages.update')}}</a>
            <a href="{{route('offer.delete',$offer->id)}}" class="btn btn-danger"> {{__('messages.delete')}}</a>
         </td>
      </tr>
      @endforeach


    </tbody>
  </table>

  @endsection
