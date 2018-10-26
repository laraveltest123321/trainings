@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Companies</div>
                <div class="card-body">
                    @if(Session::has('success'))
                        <p class="alert {{ Session::get('alert-class', 'alert-success') }}">{{ Session::get('success') }}</p>
                    @elseif(Session::has('failed'))
                        <p class="alert {{ Session::get('alert-class', 'alert-danger') }}">{{ Session::get('failed') }}</p>
                    @endif
                    <p>
                        <button class="btn btn-primary" type="button" data-toggle="collapse" data-target="#form" aria-expanded="false">
                            <i class="fas fa-plus-circle mr-10"></i>Add
                        </button>
                    </p>
                    <div class="collapse" id="form">
                        <div class="card card-body">
                            <form method="POST" action="{{ url('/companies') }}" enctype="multipart/form-data">
                                @csrf

                                <div class="form-group">
                                    <label for="name">Name</label>
                                    <input type="text" class="form-control" id="name" name="name" placeholder="Enter name">
                                </div>
                                <div class="form-group">
                                    <label for="email">Email address</label>
                                    <input type="email" class="form-control" id="email" name="email" aria-describedby="emailHelp" placeholder="Enter email">
                                    <small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone else.</small>
                                </div>

                                <div class="form-group">
                                    <label for="website">Website address</label>
                                    <input type="text" class="form-control" id="website" name="website" placeholder="Enter website address">
                                </div>

                                <div class="form-group">
                                    <label for="logo">Upload logo</label>
                                    <input type="file" id="logo" name="logo" accept="image/png, image/jpeg" />
                                </div>
                                <button type="submit" class="btn btn-primary">Submit</button>
                            </form>
                        </div>
                    </div>

                    <table class="table table-bordered">
                        <thead>
                        <tr>
                            <th>ID</th>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Logo</th>
                            <th>Website</th>
                            <th>Update</th>
                            <th>Delete</th>
                        </tr>
                        </thead>
                        <tbody>
                            @foreach ($companies as $company)
                                <tr>
                                    <td>{{ $company->id }}</td>
                                    <td>{{ $company->name }}</td>
                                    <td>{{ $company->email }}</td>
                                    <td>
                                        @unless(is_null($company->logo))
                                            <img src="{{ url('/storage/' . $company->logo) }}" width="80" class="rounded">
                                        @endif
                                    </td>
                                    <td>{{ $company->website }}</td>
                                    <td>
                                        <button type="button" class="btn btn-warning btn-sm">Update</button>
                                    </td>
                                    <td>
                                     <form method="POST" action="{{ url('/companies/'.$company->id) }}" enctype="multipart/form-data">
                                        @csrf
                                        <input name="_method" type="hidden" value="DELETE">
                                        <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                                    </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
