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
                                <h5>Delete FirstAid</h5>
                            </div>
                            <div class="card-body">
                                <form class="form theme-form" action="{{route('first_aid.destroy',['first_aid' => $id])}}" method="POST" enctype="multipart/form-data">
                                    @method('delete')
                                    @csrf
                                    <div class='mb-3 row'>
                                        <label class='col-sm-3 col-form-label'>Case</label>
                                        <div class='col-sm-9'>
                                            <input class='form-control' disabled  type='text' name='case' value='{{$model->case}}' placeholder='Case'>
                                            @error('case')
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
                                        <label class='col-sm-3 col-form-label'>Treatment</label>
                                        <div class='col-sm-9'>
                                            <input class='form-control' disabled  type='text' name='treatment' value='{{$model->treatment}}' placeholder='Treatment'>
                                            @error('treatment')
                                            <p class='text-danger'>{{$message}}</p>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="card-footer">
                                        <div class="col-sm-9 offset-sm-3">
                                            <button class="btn btn-danger" type="submit">Delete</button>
                                            <a class="btn btn-primary" href="{{route('first_aid.index')}}">Cancel</a>
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
