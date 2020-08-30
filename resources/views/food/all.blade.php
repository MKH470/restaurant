@extends('layouts.app')

@section('content')
    <div class="container">
        @if(Session::has('success'))
            <div class="col-md-12">
                <div class="alert alert-success" role="alert">
                {{ Session::get('success') }}
                </div>
            </div>
        @endif
            @if(Session::has('error'))
                <div class="col-md-12">
                <div class="alert alert-danger">
                    {{Session::get('error')}}
                </div>
                </div>
            @endif
        <div class="row justify-content-center">

 <!---Table  Area------------------------------->
            <div class="col-md-8">
                <table class="table">
                    <thead class="thead-dark">
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Image</th>
                        <th scope="col">Name</th>
                        <th scope="col">Descriotion</th>
                        <th scope="col">Price</th>
                        <th scope="col">Category</th>
                        <th scope="col">Operation</th>
                        <th scope="col">Delete</th>
                    </tr>
                    </thead>
                    <tbody>
                    @if(count($food ) > 0)

                        @foreach($food as $key=>$value)
                            <tr>
                                <th scope="row">{{$key+1}}</th>
                                <td><img src="{{asset('images/food')}}/{{$value->image}}" alt="{{$value -> name}}" class="img-thumbnail" width="100px" height="100px"/> </td>
                                <td>{{$value -> name}}</td>
                                <td>{{substr($value -> description,0,100)}}</td>
                                <td>{{$value -> price}}$</td>
                                <td>{{$value -> category->name}}</td>
                                <td><a href="{{route('food.edit',[$value -> id])}}" class="btn btn-outline-success">update</a></td>
                                <td>
                                    <!--------Begin----- Modal --------for ------ Delete -------->
                                    <!-- Button trigger modal -->
                                    <button type="button"  class="btn btn-outline-danger" data-toggle="modal" data-target="#exampleModal{{$value->id}}">
                                        Delete
                                    </button>
                                    <!-- Modal -->
                                    <div class="modal fade" id="exampleModal{{$value->id}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                        <div class="modal-dialog">
                                            <!------- Form  Area---------------------------->
                                            <form method="POST" action="{{ route('food.destroy', [$value->id]) }}">
                                            {{ csrf_field() }}
                                            {{ method_field('DELETE') }}
                                            <!------End start - Form  for delete--------------------------->
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="exampleModalLabel">Delete <strong>{{$value->name}}</strong></h5>
                                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                            <span aria-hidden="true">&times;</span>
                                                        </button>
                                                    </div>
                                                    <div class="modal-body">
                                                        are you sure?
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                                        <!-- Do not forget  --type="submit"---------------->
                                                        <button class="btn btn-outline-danger" type="submit">Delete</button>
                                                    </div>
                                                </div>
                                            </form>
                                            <!----End --- Form  Area---------------------------->
                                        </div>
                                    </div>
                                    <!---end modal--------------->
                                </td>
                            </tr>
                        @endforeach
                    @else
                        <td>No food to display</td>
                    @endif
                    </tbody>

                </table>
                {{ $food->links() }}
            </div>

            <!---Create  Area------------------------------->
            <div class="col-md-4 ">
                <div class="card ">

                    <div class="card-header bg-dark text-white"><srtong> Creat Food</srtong></div>

                    <div class="card-body">
                        <!----Begin-----------form----------->
                        <form method="POST" action="{{ route('food.store') }}" enctype="multipart/form-data">
                            @csrf

                            <div class="form-group row">
                                <label for="image" class="col-md-4 col-form-label text-md-right">Select Image</label>
                                <div class="col-md-8">
                                    <input id="image" type="file" class="form-control @error('image') is-invalid @enderror" name="image" >
                                    @error('image')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('Food Name') }}</label>

                                <div class="col-md-8">
                                    <input id="name" type="text" class="form-control @error('name') is-invalid @enderror " name="name"  value="{{old('name')}}" autocomplete="name" >

                                    @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="description" class="col-md-4 col-form-label text-md-right">Description</label>
                                <div class="col-md-8">
                                    <textarea id="description" class="form-control @error('description') is-invalid @enderror " name="description">{{old('description')}} </textarea>
                                    @error('description')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="price" class="col-md-4 col-form-label text-md-right">Price</label>

                                <div class="col-md-8">
                                    <input id="price" type="text" class="form-control @error('price') is-invalid @enderror " name="price" value="{{old('price')}}"  autocomplete="price" >

                                    @error('price')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="category" class="col-md-4 col-form-label text-md-right">category</label>
                                <div class="col-md-8 ">
                                    <select name="category" class="form-control">
                                        <option disabled selected value> -- select a category -- </option>
                                        @foreach(App\Category::all() as $category)

                                            <option value="{{$category->id}}">{{$category->name}}</option>
                                        @endforeach

                                    </select>
                                    @error('category')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group row mb-0">
                                <div class="col-md-8 offset-md-4">
                                    <button type="submit" class="btn btn-primary btn-block">
                                        {{ __('Add new food') }}
                                    </button>

                                </div>
                            </div>
                        </form>
                        <!----------end---form--->
                    </div>
                </div>
            </div>
        </div>
    </div>
    @stop
