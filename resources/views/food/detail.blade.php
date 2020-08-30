
@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
           <div class="col-md-4">
               <div class="card">
                   <div class="card-header">
                       product
                   </div>
                   <img src="{{asset('images/food')}}/{{$food->image}}"  class="img-fluid ">
                   <div class="card-body">

                   </div>
               </div>
           </div>
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">
                       Datails
                    </div>

                    <div class="card-body">
                    <p><h2>{{$food->name}}</h2></p>
                        <p class="lead">{{$food->description}}</p>
                        <p><h4>${{$food->price}}</h4></p>
                    </div>
                </div>
            </div>
        </div>

    </div>
@endsection
