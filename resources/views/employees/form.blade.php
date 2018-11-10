@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-10">
                <div class="card">
                    <div class="card-header">
                        @if(!isset($employee))
                            Create
                        @else
                            Edit
                        @endif
                    </div>
                    <div class="card-body">
                    @include('alerts.alerts')
                    @if(count($companies) > 0)
                        @if(isset($employee))
                            <form method="POST" action="{{ url('/employees/'.$employee->id) }}">
                            @csrf
                            @method('PUT')
                            <input name="id" type="hidden" value="{{ $employee->id }}">

                        @else
                            <form method="POST" action="{{ url('/employees') }}">
                            @csrf
                        @endif
                            <div class="form-group">
                               <label for="companySelect">Select the Company</label>
                               <select class="form-control" id="companySelect" name="company_id">
                                   @foreach ($companies as $company)
                                       <option value="{{ $company->id }}" @if(old('company_id', isset($employee) ? $employee->company_id : '') == $company->id) selected @endif>{{ $company->name }}</option>
                                   @endforeach
                               </select>
                           </div>
                            <div class="form-group">
                                <label for="first_name">Firstname</label>
                                <input type="text" class="form-control" id="first_name" name="first_name" placeholder="Enter firstname" value="{!! old('first_name', isset($employee) ? $employee->first_name : '') !!}">
                            </div>
                            <div class="form-group">
                                <label for="last_name">Lastname</label>
                                <input type="text" class="form-control" id="last_name" name="last_name" placeholder="Enter lastname" value="{!! old('last_name', isset($employee) ? $employee->last_name : '') !!}">
                            </div>
                            <div class="form-group">
                                <label for="email">Email address</label>
                                <input type="email" class="form-control" id="email" name="email" aria-describedby="emailHelp" placeholder="Enter email" value="{!! old('email', isset($employee) ? $employee->email : '') !!}">
                                <small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone else.</small>
                            </div>
                            <div class="form-group">
                                <label for="phone">Phone</label>
                                <input type="text" class="form-control" id="phone" name="phone" placeholder="Enter phone number"  value="{!! old('phone', isset($employee) ? $employee->phone : '') !!}">
                            </div>
                            <button type="submit" class="btn btn-primary">Submit</button>
                        </form>
                        @else
                        <p>Please create a company <a href="{{ url('/companies/create') }}">First --></a></p>
                    @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
