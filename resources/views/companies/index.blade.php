@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Companies</div>

                <div class="card-body">
                    <p>
                        <button class="btn btn-primary" type="button" data-toggle="collapse" data-target="#form" aria-expanded="false">
                            <i class="fas fa-plus-circle mr-10"></i>Add
                        </button>
                    </p>
                    <div class="collapse" id="form">
                        <div class="card card-body">
                            <form method="POST" action="{{ url('/companies') }}">
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
                                <button type="submit" class="btn btn-primary">Submit</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
