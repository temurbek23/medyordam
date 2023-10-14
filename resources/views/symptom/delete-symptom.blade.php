@extends('layouts.simple.master')
@section('title', 'Add Symptom Table')

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
                                <h5>Delete Symptom</h5>
                            </div>
                            <div class="card-body">
                                <form class="form theme-form" action="{{route('symptom.destroy',['symptom' => $id])}}" method="POST" enctype="multipart/form-data">
                                    @method('delete')
                                    @csrf
                                    <div class='mb-3 row'>
                                        <label class='col-sm-3 col-form-label'>Name</label>
                                        <div class='col-sm-9'>
                                            <input class='form-control' disabled  type='text' name='name' value='{{$model->name}}' placeholder='Name'>
                                            @error('name')
                                            <p class='text-danger'>{{$message}}</p>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="card-footer">
                                        <div class="col-sm-9 offset-sm-3">
                                            <button class="btn btn-danger" type="submit">Delete</button>
                                            <a class="btn btn-primary" href="{{route('symptom.index')}}">Cancel</a>
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
