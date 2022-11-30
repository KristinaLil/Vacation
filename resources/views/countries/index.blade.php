@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">Countries</div>

                    <div class="card-body">
                        <a href="{{route('country.create')}}" class="btn btn btn-success">Add new</a>
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>Name</th>
                                    <th>Season</th>
                                    <th>Hotels</th>
                                    <th colspan="2">Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($countries as $country)
                                    <tr>
                                        <td>{{$country->name}}</td>
                                        <td>{{$country->season}}</td>
                                        <td>
                                            <a href="{{route('countryHotels',$country->id)}}" class="btn btn btn-success">Hotels</a>
                                        </td>
                                        <td>
                                            <form method="post" action="{{route('country.destroy',$country->id)}}">
                                            @csrf
                                            @method('delete')
                                            <button value="" class="btn btn-danger">Delete</button>
                                            </form>
                                        </td>
                                        <td>
                                            <a href="{{route('country.edit',$country->id)}}" class="btn btn btn-success">Edit</a>
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
