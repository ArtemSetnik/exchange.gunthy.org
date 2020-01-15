@extends('layouts.default') 
@section('content')
<div class="container-fluid">
    <div class="mt-3 container">
        <div class="card card-form">
            <div class="card-body bg-dark-2 text-white">
                <h3 class="font-weight-bold text-center text-uppercase text-white mt-4">{{ trans('profile.showProfileTitle') }}</h3>
                {!! Form::open(['route' => 'register', 'id' => 'register', 'role' => 'form', 'method' => 'POST'] ) !!}
                    {{ csrf_field() }}
                {!! Form::close() !!}
            </div>
        </div>
    </div>
</div>
@endsection