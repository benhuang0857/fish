<?php

namespace App\Admin\Controllers;

use App\Model\FishData;
use App\Model\MachineBind;
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
        $grid = new Grid(new MachineBind());

        $grid->filter(function($filter){
            // 去掉默认的id过滤器
            $filter->disableIdFilter();
            // 在这里添加字段过滤器
            
            $filter->equal('state', __('店家區域'))->select([
                'A' => 'A',
                'B' => 'B',
                'C' => 'C',
                'D' => 'D',
                'E' => 'E',
                'F' => 'F',
            ]);
            $filter->equal('name', __('店家名稱'));
            $filter->equal('category', __('機台種類'));
            $filter->equal('bind_mac',__('機台身分證'));
        });
        
        $grid->column('state', __('機台區域'));
        $grid->column('name', __('店家名稱'));
        $grid->column('category', __('機台種類'));
        $grid->column('created_at', __('建立時間'))->sortable();
        $grid->column('bind_mac',__('機台身分證'));

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
        $show = new Show(MachineBind::findOrFail($id));

        $show->field('bind_mac',__('機台身分證'));
        $show->field('state', __('機台區域'));
        $show->field('name', __('機台名稱'));
        $show->column('category', __('機台種類'));
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
        $form = new Form(new MachineBind());

        $Fish_data = FishData::all();
        $mac = [];

        foreach($Fish_data as $key=>$value) {  
            $num = $Fish_data[$key]['mac'];
            $mac[$num] = $Fish_data[$key]['mac'];
        }

        $locations = [
            'A' => 'A',
            'B' => 'B',
            'C' => 'C',
            'D' => 'D',
            'E' => 'E',
            'F' => 'F',
        ];

        $form->select('bind_mac',__('MAC地址'))->options($mac);
        $form->select('state', __('機台區域'))->options($locations);
        $form->text('name', __('機台名稱'));
        $form->text('category', __('機台種類'));
        $form->confirm('確定創建嗎？', 'create');

        return $form;
    }
}
