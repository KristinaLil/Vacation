@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Hotels</div>

                    <div class="card-body">
                        <a href="{{route('hotels.create')}}" class="btn btn btn-success">Add new</a>
                        <hr>
                        <h5>Hotels filter</h5>
                        <form method="post" action="{{route('hotels.filter')}}">
                            @csrf
                            <div class="mb-3">
                                <label>Choose country</label>
                                <select class="form-select" name="country_id">
                                    <option value=" {{(isset($filter_country_id)&&$filter_country_id==null)?'selected':''}}">-</option>
                                    @foreach($countries as $country)
                                    <option value="{{$country->id}}" {{(isset($filter_country_id)&&$filter_country_id==$country->id)?'selected':''}}>{{$country->name}} </option>
                                     @endforeach
                                </select>
                            </div>
                            <button class="btn btn-success">Filter</button>
                        </form>
                        <hr>
                        <h5>Search hotels</h5>
                        <form method="post" action="{{route('hotels.find')}}">
                            @csrf
                            <div class="mb-3">
                                <label>Search</label>
                                <input name="name" type="text" value="{{$findHotel}}" class="form-control">
                            </div>
                            <button class="btn btn-success">Search</button>
                        </form>
                        <hr>
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>
                                        <a href="{{route('hotels.order', 'name')}}">Name
                                            @if($orderBy=='name')
                                            {!! ($orderDirection=='ASC')?'&uparrow;':'&downarrow;' !!}
                                            @endif
                                        </a>
                                    </th>
                                    <th>
                                        <a href="{{route('hotels.order', 'price')}}">Price
                                            @if($orderBy=='price')
                                                {!!($orderDirection=='ASC')?'&uparrow;':'&downarrow;'!!}
                                            @endif
                                        </a>
                                    </th>
                                    <th>
                                        <a href="{{route('hotels.order', 'duration')}}">Duration
                                            @if($orderBy=='duration')
                                                {!! ($orderDirection=='ASC')?'&uparrow;':'&downarrow;' !!}
                                            @endif
                                        </a>
                                    </th>
                                    <th>Image</th>
                                    <th>Country</th>
                                    <th colspan="2"></th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($hotels as $hotel)
                                    <tr>
                                        <td>{{$hotel->name}}</td>
                                        <td>{{$hotel->price}}</td>
                                        <td>{{$hotel->duration}}</td>
                                        <td>
                                            @if($hotel->img!=null)
                                                <img src="{{asset('storage/hotels/' . $hotel->img)}}" style="width: 200px;">
                                            @endif
                                        </td>
                                        <td>{{$hotel->country->name}}</td>
                                        @can('edit')
                                        <td>
                                            <form method="post" action="{{route('hotels.destroy',$hotel->id)}}">
                                            @csrf
                                            @method('delete')
                                                <button value="" class="btn btn-danger">Delete</button>
                                            </form>
                                        </td>

                                        <td>
                                            <a href="{{route('hotels.edit',$hotel->id)}}" class="btn btn btn-success">Edit</a>
                                        </td>
                                        @endcan
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
