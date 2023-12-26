<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Goutte\Client;
use App\Models\Housedetail;
use App\Models\House;
use DB;

class Webscrape extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'web:scrap';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'web:scrap';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {

    DB::table('houses')->truncate();
    DB::table('housedetails')->truncate();

    $client = new Client();

    //fetch forsale data
    $url = 'https://efiewura.com/properties/get.php';
    $crawler = $client->request('POST', $url, [
        'limit' => 100,
        'start' => 0,
        'catId' => 1,
        'filterQuery' => "",
        'sortQuery' => 'refreshDate DESC',
        'headers' => [
            'Accept' => '*/*'
        ]
    ]);

    $url = 'https://efiewura.com/';

    $results = $crawler->filter('div.col-sm-3')->each(function ($row) use($url) {
     $img = $row->filter('.items .img a img')
     ->attr('src');
     $title = $row->filter('.items .p-3 h3')->text();
     $px = $row->filter('.items .p-3 .price')->text();
     $link = [];
     $priceIndex = 0;
     $details = $row->filter('.items .p-3 h4')->each(function($detail) use ($link,&$priceIndex) {
        return $detail->text();

     });

     $numofdays = $row->filter('.items .p-3 .small')
     ->text();
     $viewlink = $row->filter('.items a')
     ->attr('href');

     $data = [
        "img" => $url.substr($img, 6),
        "title" => $title,
        "type" => "efiewura",
        "ctype" => "For sale",
        "currency" => trim(substr(trim($px),3)),
        "px" => $px,
        "details" => implode(",", $details),
        "numofdays" => $numofdays,
        "link" => $url.substr($viewlink, 6),
        "url" => $url
     ];

     $new = new House($data);
     $new->save();

     $husurl = $url.substr($viewlink, 6);
     $detailclient = new Client();
     $detailcraw = $detailclient->request('GET', $husurl);

     $imgs = $detailcraw->filter('.properties .container .row .col-md-8 .fotorama')
     ->html();

     $features = $detailcraw->filter('.properties .container .row .col-md-8 .features .details ul li')->each(function($features){
         return $features->text();
     });

     $otherdetails = $detailcraw->filter('.properties .container .row .col-md-8 .features .details p')->each(function($otherdetails){
         return $otherdetails->text();
     });

     $agenttittle = $detailcraw->filter('.properties .container .row .col-md-4 .sidebar h3')
     ->text();

     $agentlocation = $detailcraw->filter('.properties .container .row .col-md-4 .sidebar h4')
     ->text();

     $agentbed = $detailcraw->filter('.properties .container .row .col-md-4 .sidebar .mb-2')
     ->text();
     //dd($agentbed);

     $agentname = $detailcraw->filter('.properties .container .row .col-md-4 .sidebar .agent .name')->text();

     $agentcontact = $detailcraw->filter('.properties .container .row .col-md-4 .sidebar .agent .contact div #hidePhone')->text();

     $agentwatsap = $detailcraw->filter('.properties .container .row .col-md-4 .sidebar .agent .contact .mt-3 .d-none a')->attr('href');

     $datad = [
        "house_id" => $new->id ?? "",
        "title" => $agenttittle,
        "imgs" => $imgs,
        "features" => implode(",", $features),
        "otherdetails" => implode(",", $otherdetails),
        "agentname" => $agentname,
        "agentcontact" => $agentcontact,
        "agentwatsap" => $agentwatsap,
        "location" => $agentlocation
     ];

     Housedetail::create($datad);
        
    });



    //fetch forrent data
    $url = 'https://efiewura.com/properties/get.php';
    $crawler = $client->request('POST', $url, [
        'limit' => 100,
        'start' => 0,
        'catId' => 2,
        'filterQuery' => "",
        'sortQuery' => 'refreshDate DESC',
        'headers' => [
            'Accept' => '*/*'
        ]
    ]);

    $url = 'https://efiewura.com/';

    $results = $crawler->filter('div.col-sm-3')->each(function ($row) use($url) {
     $img = $row->filter('.items .img a img')
     ->attr('src');
     $title = $row->filter('.items .p-3 h3')->text();
     $px = $row->filter('.items .p-3 .price')->text();
     $link = [];
     $priceIndex = 0;
     $details = $row->filter('.items .p-3 h4')->each(function($detail) use ($link,&$priceIndex) {
        return $detail->text();

     });

     $numofdays = $row->filter('.items .p-3 .small')
     ->text();
     $viewlink = $row->filter('.items a')
     ->attr('href');

     $data = [
        "img" => $url.substr($img, 6),
        "title" => $title,
        "type" => "efiewura",
        "ctype" => "For rent",
        "currency" => trim(substr(trim($px),3)),
        "px" => $px,
        "details" => implode(",", $details),
        "numofdays" => $numofdays,
        "link" => $url.substr($viewlink, 6),
        "url" => $url
     ];

     $new = new House($data);
     $new->save();

     $husurl = $url.substr($viewlink, 6);
     $detailclient = new Client();
     $detailcraw = $detailclient->request('GET', $husurl);

     $imgs = $detailcraw->filter('.properties .container .row .col-md-8 .fotorama')
     ->html();

     $features = $detailcraw->filter('.properties .container .row .col-md-8 .features .details ul li')->each(function($features){
         return $features->text();
     });

     $otherdetails = $detailcraw->filter('.properties .container .row .col-md-8 .features .details p')->each(function($otherdetails){
         return $otherdetails->text();
     });

     $agenttittle = $detailcraw->filter('.properties .container .row .col-md-4 .sidebar h3')
     ->text();

     $agentlocation = $detailcraw->filter('.properties .container .row .col-md-4 .sidebar h4')
     ->text();

     $agentbed = $detailcraw->filter('.properties .container .row .col-md-4 .sidebar .mb-2')
     ->text();
     //dd($agentbed);

     $agentname = $detailcraw->filter('.properties .container .row .col-md-4 .sidebar .agent .name')->text();

     $agentcontact = $detailcraw->filter('.properties .container .row .col-md-4 .sidebar .agent .contact div #hidePhone')->text();

     $agentwatsap = $detailcraw->filter('.properties .container .row .col-md-4 .sidebar .agent .contact .mt-3 .d-none a')->attr('href');

     $datad = [
        "house_id" => $new->id ?? "",
        "title" => $agenttittle,
        "imgs" => $imgs,
        "features" => implode(",", $features),
        "otherdetails" => implode(",", $otherdetails),
        "agentname" => $agentname,
        "agentcontact" => $agentcontact,
        "agentwatsap" => $agentwatsap,
        "location" => $agentlocation
     ];

     Housedetail::create($datad);
        
    });









    exit();



    $url = 'https://efiewura.com/';
    $crawler = $client->request('GET', $url);
    $pageTitle = $crawler->filter('section .container h2')->text();
    $results = $crawler->filter('section .container .row .loadContent')->each(function ($row) use($url) {
     $img = $row->filter('.item .img a img')
     ->attr('src');
     $title = $row->filter('.item .p-3 h4')->text();
     $px = $row->filter('.item .p-3 .price')->text();
     $link = [];
     $priceIndex = 0;
     $details = $row->filter('.item .p-3 h3')->each(function($detail) use ($link,&$priceIndex) {
        return $detail->text();

     });

     $numofdays = $row->filter('.item .p-3 .small')
     ->text();
     $viewlink = $row->filter('.item a')
     ->attr('href');

     $data = [
        "img" => $url.substr($img, 2),
        "title" => $title,
        "type" => "efiewura",
        "ctype" => "For sale",
        "currency" => trim(substr(trim($px),3)),
        "px" => $px,
        "details" => implode(",", $details),
        "numofdays" => $numofdays,
        "link" => $url.$viewlink,
        "url" => $url
     ];

     //logger($data);

     $new = new House($data);
     $new->save();

     $husurl = $url.$viewlink;
     $detailclient = new Client();
     $detailcraw = $detailclient->request('GET', $husurl);

     $imgs = $detailcraw->filter('.properties .container .row .col-md-8 .fotorama')
     ->html();

     $features = $detailcraw->filter('.properties .container .row .col-md-8 .features .details ul li')->each(function($features){
         return $features->text();
     });

     $otherdetails = $detailcraw->filter('.properties .container .row .col-md-8 .features .details p')->each(function($otherdetails){
         return $otherdetails->text();
     });

     $agenttittle = $detailcraw->filter('.properties .container .row .col-md-4 .sidebar h3')
     ->text();

     $agentlocation = $detailcraw->filter('.properties .container .row .col-md-4 .sidebar h4')
     ->text();

     $agentbed = $detailcraw->filter('.properties .container .row .col-md-4 .sidebar .mb-2')
     ->text();
     //dd($agentbed);

     $agentname = $detailcraw->filter('.properties .container .row .col-md-4 .sidebar .agent .name')->text();

     $agentcontact = $detailcraw->filter('.properties .container .row .col-md-4 .sidebar .agent .contact div #hidePhone')->text();

     $agentwatsap = $detailcraw->filter('.properties .container .row .col-md-4 .sidebar .agent .contact .mt-3 .d-none a')->attr('href');

     $datad = [
        "house_id" => $new->id ?? "",
        "title" => $agenttittle,
        "imgs" => $imgs,
        "features" => implode(",", $features),
        "otherdetails" => implode(",", $otherdetails),
        "agentname" => $agentname,
        "agentcontact" => $agentcontact,
        "agentwatsap" => $agentwatsap,
        "location" => $agentlocation
     ];

     //logger($datad);

     Housedetail::create($datad);
        
    });


    }




}