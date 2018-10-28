@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="card">
                <div class="card-header">Employees</div>
                <div class="card-body">
                    @if(Session::has('success'))
                        <p class="alert {{ Session::get('alert-class', 'alert-success') }}">{{ Session::get('success') }}</p>
                    @elseif(Session::has('failed'))
                        <p class="alert {{ Session::get('alert-class', 'alert-danger') }}">{{ Session::get('failed') }}</p>
                    @endif
                    <p>
                        @if(isset($employee))
                                <button class="btn btn-primary" type="button" data-toggle="collapse" data-target="#form" aria-expanded="false">
                                <i class="fas fa-plus-circle mr-10"></i>Edit
                            </button>
                        @else
                            <button class="btn btn-primary" type="button" data-toggle="collapse" data-target="#form" aria-expanded="false">
                                <i class="fas fa-plus-circle mr-10"></i>Add
                            </button>
                        @endif
                    </p>
                    <div class="collapse" id="form">
                        <div class="card card-body">
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
                    <table class="table table-bordered">
                        <thead>
                        <tr>
                            <th>ID</th>
                            <th>Company</th>
                            <th>Firstname</th>
                            <th>Lastname</th>
                            <th>Email</th>
                            <th>Phone</th>
                            <th>Edit</th>
                            <th>Delete</th>
                        </tr>
                        </thead>
                        <tbody>
                            @foreach ($employees as $employee)
                                <tr>
                                    <td>{{ $employee->id }}</td>
                                    <td>{{ $employee->company->name }}</td>
                                    <td>{{ $employee->first_name }}</td>
                                    <td>{{ $employee->last_name }}</td>
                                    <td>{{ $employee->email }}</td>
                                    <td>{{ $employee->phone }}</td>
                                    <td>
                                        <a href="{{ url('/employees/'.$employee->id.'/edit') }}"><button type="button" class="btn btn-warning btn-sm">Edit</button></a>
                                    </td>
                                    <td>
                                    <form method="POST" action="{{ url('/employees/'.$employee->id) }}">
                                        @csrf
                                        <input name="_method" type="hidden" value="DELETE">
                                        <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                                    </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                    {{ $employees->links() }}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
