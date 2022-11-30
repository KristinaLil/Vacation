@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">Hotels</div>

                    <div class="card-body">
                        <form method="POST" action="{{(isset($hotel)?route('hotels.update',$hotel->id):route('hotels.store'))}}" enctype="multipart/form-data">
                            @csrf
                            @if(isset($hotel))
                                @method('put')
                            @endif

                            <div class="mb-3">
                                <label class="form-label">Name</label>
                                <input type="text" name="name" class="form-control" value="{{isset($hotel)?$hotel->name:''}}">
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Price</label>
                                <input type="text" name="price" class="form-control" value="{{isset($hotel)?$hotel->price:''}}">
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Duration</label>
                                <input type="text" name="duration" class="form-control" value="{{isset($hotel)?$hotel->duration:''}}">
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Image</label>
                                <input type="file" name="img" class="form-control" value="{{isset($hotel)?$hotel->img:''}}">
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Country</label>
                                <select name="country_id" class="form-select">
                                    @foreach($countries as $country)
                                        {{$country->id}}
                                    <option value="{{$country->id}}" {{isset($hotel) && ($country->id==$hotel->country_id)?'selected':''}}>{{ $country->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <button type="submit" class="btn btn-success">{{ isset($hotel)?'Edit':'Add new' }}</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
