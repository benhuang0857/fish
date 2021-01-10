<?php

namespace App\Admin\Controllers;

use App\Model\alias_data;
use Encore\Admin\Controllers\AdminController;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Show;
use Encore\Admin\Widgets\Table;

class MachineManagerController extends AdminController
{
    /**
     * Title for current resource.
     *
     * @var string
     */
    protected $title = 'alias_data';

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        $grid = new Grid(new alias_data());

        $grid->filter(function($filter){
            // 去掉默认的id过滤器
            $filter->disableIdFilter();
            // 在这里添加字段过滤器
            $filter->like('mac',__('MAC地址'));
            $filter->like('name', __('機台名稱'));
        });
        
        $grid->column('mac',__('MAC地址'));
        $grid->column('name', __('機台名稱'));
        $grid->column('created_time', __('建立時間'));

        return $grid;
    }

    /**
     * Make a show builder.
     *
     * @param mixed $id
     * @return Show
     */
    protected function detail($id)
    {
        $show = new Show(alias_data::findOrFail($id));
        $show->field('mac',__('MAC地址'));
        $show->field('name', __('機台名稱'));
        
        return $show;
    }

    /**
     * Make a form builder.
     *
     * @return Form
     */
    protected function form()
    {
        $form = new Form(new alias_data());

        $form->text('mac', __('MAC地址'));
        $form->text('name', __('機台名稱'));
        $form->confirm('確定創建嗎？', 'create');

        return $form;
    }
}
