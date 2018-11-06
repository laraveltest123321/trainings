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
                        <a href="/employees/create"><button class="btn btn-primary" type="button" data-toggle="collapse" data-target="#form" aria-expanded="false">
                            <i class="fas fa-plus-circle mr-10"></i>Add
                        </button></a>
                    </p>

                    @if(count($employees) > 0)

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
                    @else
                        @include('alerts.no-result')
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
