@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="card">
                <div class="card-header">Companies</div>
                <div class="card-body">

                    @include('alerts.alerts')

                    <p>
                        <a href="{{  url('/companies/create')  }}"><button class="btn btn-primary" type="button" data-toggle="collapse" data-target="#form" aria-expanded="false">
                            <i class="fas fa-plus-circle mr-10"></i>Add
                        </button></a>
                    </p>

                    @if(count($companies) > 0)
                        <table class="table table-bordered">
                            <thead>
                            <tr>
                                <th>ID</th>
                                <th>Name</th>
                                <th>Email</th>
                                <th>Logo</th>
                                <th>Website</th>
                                <th>Edit</th>
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
                                            <a href="{{ url('/companies/'.$company->id.'/edit') }}"><button type="button" class="btn btn-warning btn-sm">Edit</button></a>
                                        </td>
                                        <td>
                                        <form method="POST" action="{{ url('/companies/'.$company->id) }}">
                                            @csrf
                                            <input name="_method" type="hidden" value="DELETE">
                                            <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                                        </form>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                        {{ $companies->links() }}
                    @else
                        @include('alerts.no-result')
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
