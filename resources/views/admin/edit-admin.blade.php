@extends('layouts.simple.master')
@section('title', 'Edit Admin Table')

@section('css')
@endsection

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-12 col-xl-12">
                <div class="row">
                    <div class="col-sm-12">
                        <div class="card">
                            <div class="card-header pb-0">
                                <h5>Edit Admin</h5>
                            </div>
                            <div class="card-body">
                                <form class="form theme-form" action="{{route('admin.update', ['admin' => $model->id])}}" method="POST" enctype="multipart/form-data">
                                    @method('put')
                                    @csrf
                                    <div class='mb-3 row'>
                                        <label class='col-sm-3 col-form-label'>Firstname</label>
                                        <div class='col-sm-9'>
                                            <input class='form-control'  type='text' name='firstname' value='{{$model->firstname}}' placeholder='Firstname'>
                                            @error('firstname')
                                            <p class='text-danger'>{{$message}}</p>
                                            @enderror
                                        </div>
                                    </div>
									<div class='mb-3 row'>
                                        <label class='col-sm-3 col-form-label'>Lastname</label>
                                        <div class='col-sm-9'>
                                            <input class='form-control'  type='text' name='lastname' value='{{$model->lastname}}' placeholder='Lastname'>
                                            @error('lastname')
                                            <p class='text-danger'>{{$message}}</p>
                                            @enderror
                                        </div>
                                    </div>
									<div class='mb-3 row'>
                                        <label class='col-sm-3 col-form-label'>Password</label>
                                        <div class='col-sm-9'>
                                            <input class='form-control'  type='text' name='password' value='{{$model->password}}' placeholder='Password'>
                                            @error('password')
                                            <p class='text-danger'>{{$message}}</p>
                                            @enderror
                                        </div>
                                    </div>
									<div class='mb-3 row'>
                                        <label class='col-sm-3 col-form-label'>Email</label>
                                        <div class='col-sm-9'>
                                            <input class='form-control'  type='text' name='email' value='{{$model->email}}' placeholder='Email'>
                                            @error('email')
                                            <p class='text-danger'>{{$message}}</p>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="card-footer">
                                        <div class="col-sm-9 offset-sm-3">
                                            <button class="btn btn-primary" type="submit">Submit</button>
                                            <a class="btn btn-secondary" href="{{route('admin.index')}}">Cancel</a>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('script')
@endsection
