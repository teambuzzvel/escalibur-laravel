<?php

namespace App\Http\Controllers;

use App\Models\hotel;
use Illuminate\Http\Request;
use App\Shop;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;

class HotelController extends Controller
{

    public function index(Request $request) {

        $latitude       =       "28.418715";
        $longitude      =       "77.0478997";

        $hotels         =       DB::table("shops");

        $hotels          =       $hotels->select("*", DB::raw("6371 * acos(cos(radians(" . $latitude . "))
                                * cos(radians(latitude)) * cos(radians(longitude) - radians(" . $longitude . "))
                                + sin(radians(" .$latitude. ")) * sin(radians(latitude))) AS distance"));
        $hotels          =       $hotels->having('distance', '<', 20);
        $hotels          =       $hotels->orderBy('distance', 'asc');

        $hotels          =       $hotels->get();

        return view('hotels-listing', compact("hotels"));
    }


    // ------------ load shop view ---------------
    public function create() {
        return view('create-hotel');
    }


    // ----------------- save shop detail ----------------------
    public function store(Request $request) {

        $request->validate([
            "name"     =>  "required",
            "location"      =>  "required",
        ]);



                $dataArray      =       array (
                    "name"         =>      $request->name,
                    "address"           =>      $request->location,
                    "description"       =>      $request->description,
                    "latitude"          =>      $request->latitude,
                    "longitude"         =>      $request->longitude,
                );

                $hotel          =       hotel::create($dataArray);

                if(!is_null($hotel)) {
                    return back()->with("success", "hotel details saved successfully");
                }
            }
        }


