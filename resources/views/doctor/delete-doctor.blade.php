@extends('layouts.simple.master')
@section('title', 'Add Doctor Table')

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
                                <h5>Delete Doctor</h5>
                            </div>
                            <div class="card-body">
                                <form class="form theme-form" action="{{route('doctor.destroy',['doctor' => $id])}}" method="POST" enctype="multipart/form-data">
                                    @method('delete')
                                    @csrf
                                    <div class='mb-3 row'>
                                        <label class='col-sm-3 col-form-label'>Firstname</label>
                                        <div class='col-sm-9'>
                                            <input class='form-control' disabled  type='text' name='firstname' value='{{$model->firstname}}' placeholder='Firstname'>
                                            @error('firstname')
                                            <p class='text-danger'>{{$message}}</p>
                                            @enderror
                                        </div>
                                    </div>
									<div class='mb-3 row'>
                                        <label class='col-sm-3 col-form-label'>Lastname</label>
                                        <div class='col-sm-9'>
                                            <input class='form-control' disabled  type='text' name='lastname' value='{{$model->lastname}}' placeholder='Lastname'>
                                            @error('lastname')
                                            <p class='text-danger'>{{$message}}</p>
                                            @enderror
                                        </div>
                                    </div>
									<div class='mb-3 row'>
                                        <label class='col-sm-3 col-form-label'>Password</label>
                                        <div class='col-sm-9'>
                                            <input class='form-control' disabled  type='text' name='password' value='{{$model->password}}' placeholder='Password'>
                                            @error('password')
                                            <p class='text-danger'>{{$message}}</p>
                                            @enderror
                                        </div>
                                    </div>
									<div class='mb-3 row'>
                                        <label class='col-sm-3 col-form-label'>Email</label>
                                        <div class='col-sm-9'>
                                            <input class='form-control' disabled  type='text' name='email' value='{{$model->email}}' placeholder='Email'>
                                            @error('email')
                                            <p class='text-danger'>{{$message}}</p>
                                            @enderror
                                        </div>
                                    </div>
									<div class='mb-3 row'>
                                        <label class='col-sm-3 col-form-label'>Contact</label>
                                        <div class='col-sm-9'>
                                            <input class='form-control' disabled  type='text' name='contact' value='{{$model->contact}}' placeholder='Contact'>
                                            @error('contact')
                                            <p class='text-danger'>{{$message}}</p>
                                            @enderror
                                        </div>
                                    </div>
									<div class='mb-3 row'>
                                        <label class='col-sm-3 col-form-label'>Photo</label>
                                        <div class='col-2'>
                                            <img src='{{$model->photo}}' width='100' alt=''>
                                        </div>
                                    </div>
									<div class='mb-3 row'>
                                        <label class='col-sm-3 col-form-label'>About</label>
                                        <div class='col-sm-9'>
                                            <input class='form-control' disabled  type='text' name='about' value='{{$model->about}}' placeholder='About'>
                                            @error('about')
                                            <p class='text-danger'>{{$message}}</p>
                                            @enderror
                                        </div>
                                    </div>
									<div class='mb-3 row'>
                                        <label class='col-sm-3 col-form-label'>Education</label>
                                        <div class='col-sm-9'>
                                            <input class='form-control' disabled  type='text' name='education' value='{{$model->education}}' placeholder='Education'>
                                            @error('education')
                                            <p class='text-danger'>{{$message}}</p>
                                            @enderror
                                        </div>
                                    </div>
									<div class='mb-3 row'>
                                        <label class='col-sm-3 col-form-label'>Practice</label>
                                        <div class='col-sm-9'>
                                            <input class='form-control' disabled  type='text' name='practice' value='{{$model->practice}}' placeholder='Practice'>
                                            @error('practice')
                                            <p class='text-danger'>{{$message}}</p>
                                            @enderror
                                        </div>
                                    </div>
									<div class='mb-3 row'>
                                        <label class='col-sm-3 col-form-label'>Residency</label>
                                        <div class='col-sm-9'>
                                            <input class='form-control' disabled  type='text' name='residency' value='{{$model->residency}}' placeholder='Residency'>
                                            @error('residency')
                                            <p class='text-danger'>{{$message}}</p>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="card-footer">
                                        <div class="col-sm-9 offset-sm-3">
                                            <button class="btn btn-danger" type="submit">Delete</button>
                                            <a class="btn btn-primary" href="{{route('doctor.index')}}">Cancel</a>
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
