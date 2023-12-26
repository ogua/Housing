<?php

namespace App\Admin\Actions;

use Encore\Admin\Actions\RowAction;
use Illuminate\Http\Request;

class Viewdetails extends RowAction
{
    public $name = 'Details';

    public function href()
    {
       return "/admin/housedetails/".$this->row->id;
    }
}