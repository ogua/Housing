<?php

use Illuminate\Support\Facades\Route;
use Goutte\Client;
use App\Models\Housedetail;
use App\Models\House;
use Illuminate\Http\Request;



/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
    

Route::get('/', function () {

    $data = House::all();
    $corouseldata = $data->take(4);
    $otherdata = $data->slice(4,15);

    return view('home',compact('data','corouseldata','otherdata'));

})->name('home');

Route::get('property-info/{id}/{name}', function ($id,$name) {

    $data = House::where('id',$id)->first();

    return view('property',compact('data','name'));

})->name('property-info');

Route::get('properties-for-sale', function () {

    $data = House::where('ctype','For sale')->paginate(15);
    $name = "properties for sale";

    return view('property-info',compact('data','name'));
})->name('properties-for-sale');


Route::get('properties-for-rent', function () {

    $data = House::where('ctype','For rent')->paginate(15);
    $name = "properties for rent";

    return view('property-info',compact('data','name'));
})->name('properties-for-rent');


Route::get('contact', function () {

    $data = House::where('ctype','For rent')->paginate(15);
    $name = "properties for rent";

    return view('contact',compact('data','name'));
})->name('contact');


Route::get('about', function () {

    $data = House::where('ctype','For rent')->paginate(15);
    $name = "properties for rent";

    return view('about',compact('data','name'));
})->name('about');


Route::get('search-results', function (Request $request) {

    $Keyword = $request->Keyword;
    $Type = $request->Type;
    $city = $request->city;
    $bedrooms = $request->bedrooms;
    $bathrooms = $request->bathrooms;
    $price = $request->price;

    $data = House::query();

    if ($Keyword !== "") {
        $data->where('title','like',"%$Keyword%")
        ->orWhere('details','like',"%$Keyword%");
    }

    if ($Type !== "") {
        $data->where('ctype','like',"%$Type%");
    }

    if ($city !== "") {
        $data->where('title','like',"%$city%")
        ->orWhere('details','like',"%$Keyword%");
    }

    if ($bedrooms !== "") {
        $data->where('details','like',"%$bedrooms%");
    }

    if ($bathrooms !== "") {
        $data->where('details','like',"%$bathrooms%");
    }

    //dd($price);

    if (!is_null($price)) {
        $data->where('px','<=',$price);
    }

    $result = $data->paginate(15);
    

    return view('search',['data' => $result]);
});

