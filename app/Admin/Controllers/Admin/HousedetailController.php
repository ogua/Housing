<?php

namespace App\Admin\Controllers\Admin;

use App\Models\Housedetail;
use Encore\Admin\Form;
use Encore\Admin\Http\Controllers\AdminController;
use Encore\Admin\Show;
use Encore\Admin\Layout\Content;
use Encore\Admin\Table;

class HousedetailController extends AdminController
{
    /**
     * Title for current resource.
     *
     * @var string
     */
    protected $title = 'Housing Details';

    public function index(Content $content)
    {
        return Redirect()->to('/admin/housing');
    }

    /**
     * Make a table builder.
     *
     * @return Table
     */
    protected function table()
    {
        $table = new Table(new Housedetail());

        $table->column('id', __('Id'));
        $table->column('house_id', __('House id'));
        $table->column('title', __('Title'));
        $table->column('imgs', __('Imgs'));
        $table->column('features', __('Features'));
        $table->column('otherdetails', __('Otherdetails'));
        $table->column('agentname', __('Agentname'));
        $table->column('agentcontact', __('Agentcontact'));
        $table->column('agentwatsap', __('Agentwatsap'));
        $table->column('location', __('Location'));
        $table->column('created_at', __('Created at'));
        $table->column('updated_at', __('Updated at'));

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
        $show = new Show(Housedetail::where('house_id',$id)->first());

        $show->field('id', __('Id'));
        //$show->field('house_id', __('House id'));
        $show->field('title', __('Title'));
        // $show->field('imgs', __('Imgs'))->unescape()
        // ->as(function($imgs){
        //       $imgs = explode("<img", $imgs);
        //       $srcAttributes = [];
        //       $url = 'https://efiewura.com/';
              
        //       foreach ($imgs as $imageTag) {
        //           if (strpos($imageTag, 'src=') !== false) {
        //               $parts = explode('src="', $imageTag);
        //               if (count($parts) > 1) {
        //                   $src = explode('"', $parts[1])[0];
        //                   $srcAttributes[] = $url.substr($src,9);
        //               }
        //           }
        //       }

        //       $count = count($srcAttributes);

        //       for($i = 0; $i < $count; $i++){
        //         return '<div style="height: 100px;width: 100px;">
        //            <img src=""'.$srcAttributes[$i].'"" alt="">
        //         </div>';
        //       }
              
        // });
        $show->field('imgs', __('Imgs'))->unescape()
        ->as(function($imgs){
            $absolutePath = 'https://efiewura.com/';
            $html = str_replace('../../../', $absolutePath, $imgs);
            return $html;
        });
        //$show->field('features', __('Features'));
        $show->field('otherdetails', __('Other Details'));
        $show->field('agentname', __('Agent name'));
        $show->field('agentcontact', __('Agent contact'));
        $show->field('agentwatsap', __('Agentwatsap'))->link();
        $show->field('location', __('Location'));
        $show->field('created_at', __('Created at'));
        //$show->field('updated_at', __('Updated at'));


        $show->panel()
        ->tools(function ($tools) {
            $tools->disableEdit();
            $tools->disableList();
            $tools->disableDelete();
        });

        return $show;
    }

    /**
     * Make a form builder.
     *
     * @return Form
     */
    protected function form()
    {
        $form = new Form(new Housedetail());

        $form->text('house_id', __('House id'));
        $form->textarea('title', __('Title'));
        $form->textarea('imgs', __('Imgs'));
        $form->textarea('features', __('Features'));
        $form->textarea('otherdetails', __('Otherdetails'));
        $form->textarea('agentname', __('Agentname'));
        $form->textarea('agentcontact', __('Agentcontact'));
        $form->textarea('agentwatsap', __('Agentwatsap'));
        $form->textarea('location', __('Location'));

        return $form;
    }
}
