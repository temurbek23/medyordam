@extends('layouts.simple.master')

@section('title', 'Programmer UZ')

@section('style')

@endsection

@section('breadcrumb-title')

    <h3>Dashboard</h3>

@endsection

@section('breadcrumb-items')

@endsection

@section('content')
    <div class='col-3 p-3'>
            <div class='card'>
                <div class='card-body'>
                    <a href="{{route('admin.index')}}">
                        <h4>Admin</h4>
                    </a>
                </div>
            </div>
        </div>
        <div class='col-3 p-3'>
            <div class='card'>
                <div class='card-body'>
                    <a href="{{route('patient.index')}}">
                        <h4>Patient</h4>
                    </a>
                </div>
            </div>
        </div>
        <div class='col-3 p-3'>
            <div class='card'>
                <div class='card-body'>
                    <a href="{{route('doctor.index')}}">
                        <h4>Doctor</h4>
                    </a>
                </div>
            </div>
        </div>
        <div class='col-3 p-3'>
            <div class='card'>
                <div class='card-body'>
                    <a href="{{route('profession.index')}}">
                        <h4>Profession</h4>
                    </a>
                </div>
            </div>
        </div>
        <div class='col-3 p-3'>
            <div class='card'>
                <div class='card-body'>
                    <a href="{{route('call_history.index')}}">
                        <h4>CallHistory</h4>
                    </a>
                </div>
            </div>
        </div>
        <div class='col-3 p-3'>
            <div class='card'>
                <div class='card-body'>
                    <a href="{{route('disease.index')}}">
                        <h4>Disease</h4>
                    </a>
                </div>
            </div>
        </div>
        <div class='col-3 p-3'>
            <div class='card'>
                <div class='card-body'>
                    <a href="{{route('symptom.index')}}">
                        <h4>Symptom</h4>
                    </a>
                </div>
            </div>
        </div>
        <div class='col-3 p-3'>
            <div class='card'>
                <div class='card-body'>
                    <a href="{{route('first_aid.index')}}">
                        <h4>FirstAid</h4>
                    </a>
                </div>
            </div>
        </div>
        <!-- ADD_ITEM -->
@endsection
@section('script')
@endsection
