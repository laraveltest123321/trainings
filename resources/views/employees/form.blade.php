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
                        @if(isset($employee))
                            <form method="POST" action="{{ url('/employees/'.$employee->id) }}">
                            @csrf
                            <input name="_method" type="hidden" value="PUT">
                            <input name="id" type="hidden" value="{{ $employee->id }}">

                        @else
                            <form method="POST" action="{{ url('/employees') }}">
                            @csrf
                        @endif
                            <div class="form-group">
                                <label for="companySelect">Select the Company</label>
                                <select class="form-control" id="companySelect" name="company_id">
                                    @if($companies)
                                        @foreach($companies as $company)
                                            @if(isset($employee))
                                                <option value="{{ $company->id }}" selected="<?= $company->id === $employee->company->id? 'selected':'' ?>">{{ $company->name }}</option>
                                            @else
                                                <option value="{{ $company->id }}">{{ $company->name }}</option>
                                            @endif
                                        @endforeach
                                    @endif
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="first_name">Firstname</label>
                                <input type="text" class="form-control" id="first_name" name="first_name" placeholder="Enter firstname" value="<?= isset($employee) ? $employee->first_name : ''?>">
                            </div>
                            <div class="form-group">
                                <label for="last_name">Lastname</label>
                                <input type="text" class="form-control" id="last_name" name="last_name" placeholder="Enter lastname" value="<?= isset($employee) ? $employee->last_name : ''?>">
                            </div>
                            <div class="form-group">
                                <label for="email">Email address</label>
                                <input type="email" class="form-control" id="email" name="email" aria-describedby="emailHelp" placeholder="Enter email" value="<?= isset($employee) ? $employee->email : ''?>">
                                <small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone else.</small>
                            </div>
                            <div class="form-group">
                                <label for="phone">Phone</label>
                                <input type="text" class="form-control" id="phone" name="phone" placeholder="Enter phone number" value="<?= isset($employee) ? $employee->phone : ''?>">
                            </div>
                            <button type="submit" class="btn btn-primary">Submit</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
