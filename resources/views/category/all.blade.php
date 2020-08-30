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
            <div class="col-md-6">
                <table class="table">
                    <thead class="thead-dark">
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Category Name</th>
                        <th scope="col">Operation</th>
                        <th scope="col">Delete</th>
                    </tr>
                    </thead>
                    <tbody>
@if(count($categories ) > 0)

                    @foreach($categories as $key=>$category)
                        <tr>
                            <th scope="row">{{$key+1}}</th>
                            <td>{{$category -> name}}</td>
                            <td><a href="{{route('category.edit',[$category -> id])}}" class="btn btn-outline-success">update</a></td>
                            <td>
<!--------Begin----- Modal --------for ------ Delete -------->
               <!-- Button trigger modal -->
                                    <button type="button"  class="btn btn-outline-danger" data-toggle="modal" data-target="#exampleModal{{$category->id}}">
                                        Delete
                                    </button>
              <!-- Modal -->
                            <div class="modal fade" id="exampleModal{{$category->id}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog">
                            <!------- Form  Area---------------------------->
                                    <form method="POST" action="{{ route('category.destroy', [$category->id]) }}">
                                        {{ csrf_field() }}
                                        {{ method_field('DELETE') }}
                            <!------End start - Form  for delete--------------------------->
                                            <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="exampleModalLabel">Delete Category <strong>{{$category->name}}</strong></h5>
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
    <td>No categories to display</td>
    @endif
                    </tbody>

                </table>

            </div>
<!----Create  --Category- ---  Area-------------------------- -->
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header  bg-dark text-white">{{ __('creat category') }}</div>

                    <div class="card-body">
                        <form method="POST" action="{{ route('category.store') }}">
                            @csrf

                            <div class="form-group row">
                                <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('Category Name') }}</label>

                                <div class="col-md-6">
                                    <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name"   autocomplete="name" >

                                    @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row mb-0">
                                <div class="col-md-8 offset-md-4">
                                    <button type="submit" class="btn btn-primary">
                                        {{ __('save') }}
                                    </button>

                                </div>
                            </div>
                        </form>
                    </div>
                </div>

            </div>

        </div>
    </div>
    @stop
