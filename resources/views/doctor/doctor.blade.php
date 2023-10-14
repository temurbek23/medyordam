@extends('layouts.simple.master')
@section('title', 'Programmer UZ')


@section('style')
@endsection

@section('breadcrumb-title')
    <h3>Doctor</h3>
@endsection

@section('breadcrumb-items')
    <div class="py-3">
        <div class="justify-content-between row mx-2">
            <a  href="{{route('doctor.create')}}" class="btn btn-success font-weight-bold"><i class="fa fa-plus"></i></a>
        </div>
    </div>
@endsection

@section('content')
    @if(session()->has('message'))
        <div class="alert {{session('error') ? 'alert-danger' : 'alert-success'}}">
            {{ session('message') }}
        </div>
    @endif
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-header">
                        <h5>Doctor</h5>
                    </div>
                    <div class="table-responsive">
                        <table class="table table-hover">
                            <thead>
                            <tr>
                                <th scope="col">#</th>
								<th scope='col'>Firstname</th>
								<th scope='col'>Lastname</th>
								<th scope='col'>Password</th>
								<th scope='col'>Email</th>
								<th scope='col'>Contact</th>
								<th scope='col'>Photo</th>
								<th scope='col'>About</th>
								<th scope='col'>Education</th>
								<th scope='col'>Practice</th>
								<th scope='col'>Residency</th>
								<th scope='col'>Created At</th>
								<th scope="col">Action</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($models as $model)
                            <tr>
                                <td>{{$model->id}}</td>
								<td>{{$model->firstname}}</td>
								<td>{{$model->lastname}}</td>
								<td>{{$model->password}}</td>
								<td>{{$model->email}}</td>
								<td>{{$model->contact}}</td>
								<td><img src='{{$model->photo}}' width='100' alt=''></td>
								<td>{{$model->about}}</td>
								<td>{{$model->education}}</td>
								<td>{{$model->practice}}</td>
								<td>{{$model->residency}}</td>
								<td>{{$model->created_at}}</td>
                                <td>
                                    <div class="btn-group">
                                        <a href="{{route('doctor.edit', ['doctor' => $model->id])}}" class="btn btn-info"><i class="fa fa-edit"></i></a>
                                        <a href="{{route('doctor.show', ['doctor' => $model->id])}}" class="btn btn-danger"><i class="fa fa-trash"></i></a>
                                    </div>
                                </td>
                            </tr>
                            @endforeach
                            </tbody>
                        </table>
                        <div class="d-flex justify-content-center">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('script')
@endsection
