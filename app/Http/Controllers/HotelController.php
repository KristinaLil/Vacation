<?php

namespace App\Http\Controllers;

use App\Models\Country;
use App\Models\Hotel;
use Illuminate\Http\Request;
use function GuzzleHttp\Promise\all;

class HotelController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $countryId=$request->session()->get('filter_country_id',null);
        $name=$request->session()->get('find_hotel',null);
        $orderBy=$request->session()->get('order_by','name');
        $dir=$request->session()->get('order_direction', 'ASC');


        $hotels=Hotel::filterByCountry($countryId)->findByName($name)->orderBy($orderBy,$dir)->get();

        return view('hotels.index',[
            'hotels'=>$hotels,
            'countries'=>Country::all(),
            'filter_country_id'=>$countryId,
            'findHotel'=>$name,
            'orderBy'=>$orderBy,
            'orderDirection'=>$dir
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('hotels.edit',['countries'=>Country::all()]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, Hotel $hotel)
    {
        Hotel::create($request->all());
        $img=$request->file('img');
        $filename=$hotel->id.  '.'. $img->extension();
        $hotel->img=$filename;
        $img->storeAs('public/hotels',$filename);
        return redirect()->route('hotels.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Hotel  $hotel
     * @return \Illuminate\Http\Response
     */
    public function show(Hotel $hotel)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Hotel  $hotel
     * @return \Illuminate\Http\Response
     */
    public function edit(Hotel $hotel)
    {
        return view('hotels.edit',[
            'hotel'=>$hotel,
            'countries'=>Country::all()
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Hotel  $hotel
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Hotel $hotel)
    {
        $hotel->fill($request->all());
        $img=$request->file('img');
        $filename=$hotel->id.  '.'. $img->extension();
        $hotel->img=$filename;
        $img->storeAs('public/hotels',$filename);
        $hotel->save();
        return redirect()->route('hotels.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Hotel  $hotel
     * @return \Illuminate\Http\Response
     */
    public function destroy(Hotel $hotel)
    {
        $hotel->delete();
        return redirect()->route('hotels.index');

    }

    public function countryHotels($id)
    {
        return view('hotels.index',['hotels'=>Hotel::where('country_id',$id)->get()]);
    }

    public function filterHotels(Request $request)
    {
        $request->session()->put('filter_country_id',$request->country_id);
        return redirect()->route('hotels.index');
    }

    public function findHotels(Request $request)
    {
        $request->session()->put('find_hotel',$request->name);
        return redirect()->route('hotels.index');
    }

    public function orderHotels(Request $request, $field)
    {
        if ($request->session()->get('order_by')==$field) {
            $dir=$request->session()->get('order_direction', 'ASC');
            if ($dir=='ASC') {
                $request->session()->put('order_direction', 'DESC');
            } else {
                $request->session()->put('order_direction', 'ASC');
            }
        } else {
            $request->session()->put('order_direction', 'ASC');
        }
        $request->session()->put('order_by',$field);
        return redirect()->route('hotels.index');
    }
}
