@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-10">
                <div class="card">
                    <div class="card-header">
                        @if(!isset($company))
                            Create
                        @else
                            Edit
                        @endif
                    </div>
                    <div class="card-body">
                    @include('alerts.alerts')
                        @if(isset($company))
                            <form method="POST" action="{{ url('/companies/'.$company->id) }}" enctype="multipart/form-data">
                            @csrf
                            @method('PUT')
                            <input name="id" type="hidden" value="{{ $company->id }}">
                        @else
                            <form method="POST" action="{{ url('/companies') }}" enctype="multipart/form-data">
                            @csrf
                        @endif
                            <div class="form-group">
                                <label for="name">Name</label>
                                <input type="text" class="form-control" id="name" name="name" placeholder="Enter name" value="{!! old('name', isset($company)?$company->name:'') !!}">
                            </div>
                            <div class="form-group">
                                <label for="email">Email address</label>
                                <input type="email" class="form-control" id="email" name="email" aria-describedby="emailHelp" placeholder="Enter email" value="{!! old('email', isset($company)?$company->email:'') !!}">
                                <small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone else.</small>
                            </div>

                            <div class="form-group">
                                <label for="website">Website address</label>
                                <input type="text" class="form-control" id="website" name="website" placeholder="Enter website address" value="{!! old('website', isset($company)?$company->website:'') !!}">
                            </div>

                            <div class="form-group">
                                <label for="logo">Upload logo</label>
                                <input type="file" id="logo" name="logo"/>
                            </div>
                            <button type="submit" class="btn btn-primary">Submit</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
