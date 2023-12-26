<?php

namespace App\Admin\Controllers;

use App\Http\Controllers\Controller;
use Encore\Admin\Http\Controllers\Dashboard;
use Encore\Admin\Layout\Column;
use Encore\Admin\Layout\Content;
use Encore\Admin\Layout\Row;
use App\Models\House;
use App\Models\User;

class HomeController extends Controller
{
    public function index(Content $content)
    {
        $users = User::all()->count();
        $housing = House::all()->count();
        $forsale = House::where('ctype','For sale')->count();
        $forrent = House::where('ctype','For rent')->count();
        return $content
            ->title('Housing Webscraping Dashboard')
            ->view('dashboard',compact('users','housing','forsale','forrent'));
    }
}
