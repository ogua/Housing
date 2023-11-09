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


    for ($i=1; $i < 10; $i++) {
    logger('page='.$i);
    //tonaton
    if ($i=="1") {
        $url = 'https://tonaton.com/r_greater-accra/c_houses-apartments-for-rent';
    }else{
        $url = 'https://tonaton.com/r_greater-accra/c_houses-apartments-for-rent?page='.$i;
    }
    
    $link = 'https://tonaton.com';
    $crawler = $client->request('GET', $url);
    $tonaton = $crawler->filter("section .product .product__container")
    ->each(function ($row) use($link) {

        $img = $row->filter('.product__image img')
         ->attr('src');
         $title = $row->filter('.product__content p.product__description')->text();
         $px = $row->filter('.product__content .product__title')->text();
         $details = $row->filter('.product__content .product__location')->text();;

     $numofdays = $row->filter('.product__image .product__count ')
     ->text();
     $viewlink = $row->filter('a')->attr('href');

     $data = [
        "img" => $img,
        "title" => $title,
        "type" => "tonaton",
        "ctype" => "For rent",
        "currency" => trim(substr(trim($px),3)),
        "px" => $px,
        "details" => $details,
        "numofdays" => $numofdays,
        "link" => $link.$viewlink,
     ];

     //logger($data);

     $new = new House($data);
     $new->save();


     $husurl = $link.$viewlink;
     $detailclient = new Client();
     $detailcraw = $detailclient->request('GET', $husurl);

     $imgs = $detailcraw->filter('section .details div .details__content div .details__images .details__images__container .details__images__item--half')->each(function($node){

            $lopimg = $node->filter(".details__images__item")->each(function($img){

                return $img->filter("img")->attr('src');
            });

            return $lopimg;
            
     });


     $title = $detailcraw->filter('section .details div .details__share-location .location h1')->text();

     $location = $detailcraw->filter('section .details div .details__share-location .location .details__location')->text();

    $contact = $detailcraw->filter('section .details div .details__share-location .details__contact a')->text();

    $agentname = $detailcraw->filter('.details__feedback div p')->text();


    $tags = $detailcraw->filter('section .details div div.details__tags')->text();

    $description = $detailcraw->filter('section .details div div .details__description div')
    ->each(function($description){
        return $description->text();
    });

    $datad = [
        "house_id" => $new->id ?? '',
        "title" => $title,
        "imgs" => isset($imgs[1]) ? implode(",", $imgs[1]) : implode(",", $imgs[0]),
        "features" => implode(",", $description),
        "otherdetails" => $tags,
        "agentname" => $agentname,
        "agentcontact" => $contact,
        "agentwatsap" => '',
        "location" => $location
     ];

     Housedetail::create($datad);
     
    });
}



    for ($i=1; $i < 6; $i++) {
    logger('page='.$i);
    //tonaton
    if ($i=="1") {
        $url = 'https://tonaton.com/c_houses-apartments-for-sale';
    }else{
        $url = 'https://tonaton.com/c_houses-apartments-for-sale?page='.$i;
    }
    
    $link = 'https://tonaton.com';
    $crawler = $client->request('GET', $url);
    $tonaton = $crawler->filter("section .product .product__container")
    ->each(function ($row) use($link) {

        $img = $row->filter('.product__image img')
         ->attr('src');
         $title = $row->filter('.product__content p.product__description')->text();
         $px = $row->filter('.product__content .product__title')->text();
         $details = $row->filter('.product__content .product__location')->text();;

     $numofdays = $row->filter('.product__image .product__count ')
     ->text();
     $viewlink = $row->filter('a')->attr('href');

     $data = [
        "img" => $img,
        "title" => $title,
        "type" => "tonaton",
        "ctype" => "For sale",
        "currency" => trim(substr(trim($px),3)),
        "px" => $px,
        "details" => $details,
        "numofdays" => $numofdays,
        "link" => $link.$viewlink,
        "url" => $link."/"
     ];

     //logger($data);

     $new = new House($data);
     $new->save();


     $husurl = $link.$viewlink;
     $detailclient = new Client();
     $detailcraw = $detailclient->request('GET', $husurl);

     $imgs = $detailcraw->filter('section .details div .details__content div .details__images .details__images__container .details__images__item--half')->each(function($node){

            $lopimg = $node->filter(".details__images__item")->each(function($img){

                return $img->filter("img")->attr('src');
            });

            return $lopimg;
            
     });


     $title = $detailcraw->filter('section .details div .details__share-location .location h1')->text();

     $location = $detailcraw->filter('section .details div .details__share-location .location .details__location')->text();

    $contact = $detailcraw->filter('section .details div .details__share-location .details__contact a')->text();

    $agentname = $detailcraw->filter('.details__feedback div p')->text();


    $tags = $detailcraw->filter('section .details div div.details__tags');

    if ($tags->count() > 0) {
        $tags = $detailcraw->filter('section .details div div.details__tags');
    } else {
        $tags = "";
    }



    $description = $detailcraw->filter('section .details div div .details__description div')
    ->each(function($description){
        return $description->text();
    });

    $datad = [
        "house_id" => $new->id ?? '',
        "title" => $title,
        "imgs" => isset($imgs[1]) ? implode(",", $imgs[1]) : implode(",", $imgs[0]),
        "features" => implode(",", $description),
        "otherdetails" => $tags,
        "agentname" => $agentname,
        "agentcontact" => $contact,
        "agentwatsap" => "",
        "location" => $location
     ];

     Housedetail::create($datad);
     
    });

    }




}









}