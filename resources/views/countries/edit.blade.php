@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">Countries</div>

                    <div class="card-body">
                        <form method="POST" action="{{(isset($country)?route('country.update',$country->id):route('country.store'))}}">
                            @csrf
                            @if(isset($country))
                                @method('put')
                            @endif

                            <div class="mb-3">
                                <label class="form-label">Name</label>
                                <input type="text" name="name" class="form-control" value="{{isset($country)?$country->name:''}}">
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Season</label>
                                <input type="text" name="season" class="form-control" value="{{isset($country)?$country->season:''}}">
                            </div>
                            <button type="submit" class="btn btn-success">{{ isset($country)?'Edit':'Add new' }}</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
