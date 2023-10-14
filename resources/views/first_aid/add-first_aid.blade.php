@extends('layouts.simple.master')
@section('title', 'Add FirstAid Table')

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
                                <h5>Add FirstAid</h5>
                            </div>
                            <div class="card-body">
                                <form class="form theme-form" action="{{route('first_aid.store')}}" method="POST" enctype="multipart/form-data">
                                    @csrf
                                    <div class='mb-3 row'>
                                        <label class='col-sm-3 col-form-label'>Case</label>
                                        <div class='col-sm-9'>
                                            <input class='form-control'  type='text' name='case' value="{{old('case')}}" placeholder='Case'>
                                            @error('case')
                                            <p class='text-danger'>{{$message}}</p>
                                            @enderror
                                        </div>
                                    </div>
									<div class='mb-3 row'>
                                        <label class='col-sm-3 col-form-label'>Photo</label>
                                        <div class='col-sm-9'>
                                            <input class='form-control' name='photo' type='file'>
                                            @error('photo')
                                            <p class='text-danger'>{{$message}}</p>
                                            @enderror
                                        </div>
                                    </div>
									<div class='mb-3 row'>
                                        <label class='col-sm-3 col-form-label'>Treatment</label>
                                        <div class='col-sm-9'>
                                            <textarea id='message' name='treatment' rows='1' cols='111' placeholder='Treatment'>{{value(old('treatment'))}}</textarea>
                                            @error('treatment')
                                            <p class='text-danger'>{{$message}}</p>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="card-footer">
                                        <div class="col-sm-9 offset-sm-3">
                                            <button class="btn btn-primary" type="submit">Submit</button>
                                            <a class="btn btn-secondary" href="{{route('first_aid.index')}}">Cancel</a>
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
