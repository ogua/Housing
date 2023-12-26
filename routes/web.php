<?php

use Illuminate\Support\Facades\Route;
use App\Models\Housedetail;
use App\Models\House;
use Illuminate\Http\Request;
use Goutte\Client;
use Spatie\Browsershot\Browsershot;
use Symfony\Component\DomCrawler\Crawler;




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


    //$client = new Client();

    // $url = 'https://efiewura.com/properties/get.php';
    // $crawler = $client->request('POST', $url, [
    //     'limit' => 100,
    //     'start' => 0,
    //     'catId' => 1,
    //     'filterQuery' => "",
    //     'sortQuery' => 'refreshDate DESC',
    //     'headers' => [
    //         'Accept' => '*/*'
    //     ]
    // ]);

    // $url = 'https://efiewura.com/';

    // $results = $crawler->filter('div.col-sm-3')->each(function ($row) use($url) {
    //  $img = $row->filter('.items .img a img')
    //  ->attr('src');
    //  $title = $row->filter('.items .p-3 h3')->text();
    //  $px = $row->filter('.items .p-3 .price')->text();
    //  $link = [];
    //  $priceIndex = 0;
    //  $details = $row->filter('.items .p-3 h4')->each(function($detail) use ($link,&$priceIndex) {
    //     return $detail->text();

    //  });

    //  $numofdays = $row->filter('.items .p-3 .small')
    //  ->text();
    //  $viewlink = $row->filter('.items a')
    //  ->attr('href');

    //  $data = [
    //     "img" => $url.substr($img, 6),
    //     "title" => $title,
    //     "type" => "efiewura",
    //     "ctype" => "For sale",
    //     "currency" => trim(substr(trim($px),3)),
    //     "px" => $px,
    //     "details" => implode(",", $details),
    //     "numofdays" => $numofdays,
    //     "link" => $url.substr($viewlink, 6),
    //     "url" => $url
    //  ];

    //  $new = new House($data);
    //  $new->save();

    //  $husurl = $url.substr($viewlink, 6);
    //  $detailclient = new Client();
    //  $detailcraw = $detailclient->request('GET', $husurl);

    //  $imgs = $detailcraw->filter('.properties .container .row .col-md-8 .fotorama')
    //  ->html();

    //  $features = $detailcraw->filter('.properties .container .row .col-md-8 .features .details ul li')->each(function($features){
    //      return $features->text();
    //  });

    //  $otherdetails = $detailcraw->filter('.properties .container .row .col-md-8 .features .details p')->each(function($otherdetails){
    //      return $otherdetails->text();
    //  });

    //  $agenttittle = $detailcraw->filter('.properties .container .row .col-md-4 .sidebar h3')
    //  ->text();

    //  $agentlocation = $detailcraw->filter('.properties .container .row .col-md-4 .sidebar h4')
    //  ->text();

    //  $agentbed = $detailcraw->filter('.properties .container .row .col-md-4 .sidebar .mb-2')
    //  ->text();
    //  //dd($agentbed);

    //  $agentname = $detailcraw->filter('.properties .container .row .col-md-4 .sidebar .agent .name')->text();

    //  $agentcontact = $detailcraw->filter('.properties .container .row .col-md-4 .sidebar .agent .contact div #hidePhone')->text();

    //  $agentwatsap = $detailcraw->filter('.properties .container .row .col-md-4 .sidebar .agent .contact .mt-3 .d-none a')->attr('href');

    //  $datad = [
    //     "house_id" => $new->id ?? "",
    //     "title" => $agenttittle,
    //     "imgs" => $imgs,
    //     "features" => implode(",", $features),
    //     "otherdetails" => implode(",", $otherdetails),
    //     "agentname" => $agentname,
    //     "agentcontact" => $agentcontact,
    //     "agentwatsap" => $agentwatsap,
    //     "location" => $agentlocation
    //  ];

    //  Housedetail::create($datad);
        
    // });

    $data = House::all();
    $corouseldata = $data->take(4);
    $otherdata = $data->take(18);

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

