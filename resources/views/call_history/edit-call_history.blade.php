@extends('layouts.simple.master')
@section('title', 'Edit CallHistory Table')

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
                                <h5>Edit CallHistory</h5>
                            </div>
                            <div class="card-body">
                                <form class="form theme-form" action="{{route('call_history.update', ['call_history' => $model->id])}}" method="POST" enctype="multipart/form-data">
                                    @method('put')
                                    @csrf
                                    <div class='mb-3 row'>
                                        <label class='col-sm-3 col-form-label'>Doctor Id</label>
                                        <div class='col-sm-9'>
                                            <input class='form-control'  type='text' name='doctor_id' value='{{$model->doctor_id}}' placeholder='Doctor Id'>
                                            @error('doctor_id')
                                            <p class='text-danger'>{{$message}}</p>
                                            @enderror
                                        </div>
                                    </div>
									<div class='mb-3 row'>
                                        <label class='col-sm-3 col-form-label'>Patient Id</label>
                                        <div class='col-sm-9'>
                                            <input class='form-control'  type='text' name='patient_id' value='{{$model->patient_id}}' placeholder='Patient Id'>
                                            @error('patient_id')
                                            <p class='text-danger'>{{$message}}</p>
                                            @enderror
                                        </div>
                                    </div>
									<div class='mb-3 row'>
                                        <label class='col-sm-3 col-form-label'>Duration</label>
                                        <div class='col-sm-9'>
                                            <input class='form-control'  type='text' name='duration' value='{{$model->duration}}' placeholder='Duration'>
                                            @error('duration')
                                            <p class='text-danger'>{{$message}}</p>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="card-footer">
                                        <div class="col-sm-9 offset-sm-3">
                                            <button class="btn btn-primary" type="submit">Submit</button>
                                            <a class="btn btn-secondary" href="{{route('call_history.index')}}">Cancel</a>
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
