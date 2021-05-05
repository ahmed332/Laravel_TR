@extends('layouts.app')
@section('content')
    <div class="container">


        <div class="flex-center position-ref full-height">
            <div class="content">
                <div class="title m-b-md">
                    الاطباء

                </div>

                <br>

                <table class="table">
                    <thead>
                    <tr>
                        <th scope="col">hospiatal_id</th>
                        <th scope="col">Dr_name</th>
                        <th scope="col">Dr_title</th>
                        <th scope="col">gender</th>
                        <th scope="col">operation</th>
                    </tr>
                    </thead>
                    <tbody>

                    @if(isset($docctor_in_hospital) && $docctor_in_hospital -> count() > 0 )
                        @foreach($docctor_in_hospital as $doctor)
                            <tr>
                                <th scope="row">{{$doctor->id}}</th>
                                <td>{{$doctor->name}}</td>
                                <td>{{$doctor->title}}</td>
                                <td>
                                    @if ($doctor->gender == 1)
                                    Man
                                    @else
                                    Woman
                                @endif </td>
                                <td><a href="{{route('doctors.services',$doctor -> id)}}" class="btn btn-success">عرض الخدمات </a></td>
                            </tr>
                        @endforeach
                    @endif

                    </tbody>
                </table>


            </div>
        </div>
    </div>
@stop

