@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            @if(isset($categories) && $categories->count() >0)
            @foreach($categories as $category)

            <div class="col-md-12">
                <h2>{{$category->name}}</h2>
                <div class="jumbotron">
                    <div class="row">
                        @foreach(\App\Food::where('category_id',$category->id)->get() as $food)
                    <div class="col-md-3" >
                        <img src="{{asset('images/food/'.$food->image)}}" width="200px" height="200px"/>
                        <p>{{ $food->name }}</p>
                        <span>${{  $food->price }}</span>
                        <br/> <br/>
                        <p class="text-center">
                            <a href="{{route('food.view',$food->id)}}">
                            <button class="btn btn-outline-danger btn-block">
                                View
                            </button>
                        </a>

                        </p>
                    </div>
                        @endforeach
                    </div>

                </div>
            </div>

            @endforeach
            @endif
        </div>

    </div>
@endsection
