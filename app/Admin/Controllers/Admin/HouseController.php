<?php

namespace App\Admin\Controllers\Admin;

use App\Models\House;
use Encore\Admin\Form;
use Encore\Admin\Http\Controllers\AdminController;
use Encore\Admin\Show;
use Encore\Admin\Table;
use Encore\Admin\Widgets\Table as Expandtable;
use App\Admin\Actions\Viewdetails;
use Artisan;
use Encore\Admin\Layout\Content;
use Illuminate\Support\Facades\App;

class HouseController extends AdminController
{
    /**
     * Title for current resource.
     *
     * @var string
     */
    protected $title = 'Houses';

    /**
     * Make a table builder.
     *
     * @return Table
     */
    protected function table()
    {
        $table = new Table(new House());

        $table->column('id', __('Id'));
        $table->column('img', __('Img'))
        ->image('',100,100);
        $table->column('title', __('Title'));
        // ->expand(function ($model) {
        //     $guardian = $model->gaurdain()->get()->map(function ($comment) {
        //         return $comment->only(['gurdianname','relationship','mobile', 'created_at']);
        //     });
        //     return new Expandtable([__('Formfields.gurdianname'), __('Formfields.relationship'),__('Formfields.mobile'), __('Created')], $guardian->toArray());
        // });
        $table->column('type', __('Type'))->hide();
        $table->column('ctype', __('Type'));
        $table->column('currency', __('Currency'))->hide();
        $table->column('px', __('Px'))->display(function($px){
            return $this->currency.$px;
        });
        $table->column('details', __('Details'));
        $table->column('numofdays', __('Numofdays'))->hide();
        $table->column('link', __('Link'))
        ->url();
        $table->column('url', __('Url'))->hide();
        $table->column('created_at', __('Created at'))->display(function($created_at){
            return date('m-d-Y',strtotime($created_at));
        });
        //$table->column('updated_at', __('Updated at'));

        $table->actions(function ($actions) {
            $actions->add(new Viewdetails());
        });

        $table->filter(function($filter){

            $filter->disableIdFilter();

            $filter->like('ctype', 'Type')->select(['For sale' => 'For sale', 'For rent' => 'For rent']);

        });

    $table->disableCreateButton();
    $table->disableRowSelector();
    $table->disableColumnSelector();

        return $table;
    }

    /**
     * Make a show builder.
     *
     * @param mixed $id
     * @return Show
     */
    protected function detail($id)
    {
        $show = new Show(House::findOrFail($id));

        $show->field('img', __('Img'))->image();
        $show->field('title', __('Title'));
        $show->field('ctype', __('Type'));
        $show->field('px', __('Px'));
        $show->field('details', __('Details'));
        $show->field('link', __('Link'))->link();
        $show->field('created_at', __('Created at'));
        $show->field('updated_at', __('Updated at'));

        return $show;
    }

    /**
     * Make a form builder.
     *
     * @return Form
     */
    protected function form()
    {
        $form = new Form(new House());

        $form->image('img', __('Img'));
        $form->textarea('title', __('Title'));
        $form->textarea('type', __('Type'));
        $form->textarea('ctype', __('Ctype'));
        $form->text('currency', __('Currency'));
        $form->text('px', __('Px'));
        $form->textarea('details', __('Details'));
        $form->text('numofdays', __('Numofdays'));
        $form->text('link', __('Link'));
        $form->text('url', __('Url'));

        return $form;
    }

    public function botrun(Content $content)
    {
        Artisan::call('web:scrap');

        return $content->title('Bot Run')
        ->view('bot');

    }


    public function runbot(Content $content)
    {

        return $content->title('Data Scraping')
        ->view('runbot');

    }


    public function generatereport(Content $content)
    {
        return $content->title('Generate Report')
        ->view('report');
    }

    public function generatedreport($fromdate,$todate)
    {
        
        $pdf = App::make('dompdf.wrapper');

        $houses = House::whereBetween('created_at',[$fromdate,$todate])->get();

        $pdf->loadView('generated-report',compact('houses','fromdate','todate'));

        return $pdf->stream("report-generated-from-{$fromdate}-to-{$todate}.pdf");
        
        dd($houses);
        //0559932943 :-: Jennifer
    }





}
