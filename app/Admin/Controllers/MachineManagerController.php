<?php

namespace App\Admin\Controllers;

use App\Model\alias_data;
use App\Model\Machine_bind;
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
    protected $title = '機台設定';

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        $grid = new Grid(new Machine_bind());

        $grid->filter(function($filter){
            // 去掉默认的id过滤器
            $filter->disableIdFilter();
            // 在这里添加字段过滤器
            $filter->like('bind_mac',__('MAC地址'));
            $filter->like('name', __('機台名稱'));
        });
        
        $grid->column('bind_mac',__('MAC地址'));
        $grid->column('name', __('機台名稱'));
        $grid->column('state', __('機台縣市'));
        $grid->column('location', __('機台地址'));
        $grid->column('created_at', __('建立時間'));

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
        $show = new Show(Machine_bind::findOrFail($id));

        $show->field('bind_mac',__('MAC地址'));
        $show->field('name', __('機台名稱'));
        $show->field('state', __('機台縣市'));
        $show->field('location', __('機台地址'));
        $show->field('created_at', __('建立時間'));

        
        return $show;
    }

    /**
     * Make a form builder.
     *
     * @return Form
     */
    protected function form()
    {
        $form = new Form(new Machine_bind());

        $alice = alias_data::all();
        $mac = array();

        foreach($alice as $key=>$value) {  
            $mac[$key] = $alice[$key]['mac'];  
        }

        $form->select('bind_mac',__('MAC地址'))->options($mac);
        $form->text('name', __('機台名稱'));
        $form->text('state', __('機台縣市'));
        $form->text('location', __('機台地址'));
        $form->text('created_at', __('建立時間'));

        $form->confirm('確定創建嗎？', 'create');

        return $form;
    }
}
