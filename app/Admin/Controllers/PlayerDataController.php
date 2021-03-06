<?php

namespace App\Admin\Controllers;

use App\Model\PlayerData;
use Encore\Admin\Controllers\AdminController;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Show;

class PlayerDataController extends AdminController
{
    /**
     * Title for current resource.
     *
     * @var string
     */
    protected $title = '玩家即時資訊';

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        $grid = new Grid(new PlayerData());
        $grid->model()->orderBy('update_time', 'DESC');
        $grid->disableCreateButton();

        $grid->disableActions();

        $grid->filter(function($filter){
            $filter->disableIdFilter();
            $filter->equal('Machine.state', __('店家區域'))->select([
                'A' => 'A',
                'B' => 'B',
                'C' => 'C',
                'D' => 'D',
                'E' => 'E',
                'F' => 'F',
            ]);
            $filter->equal('Machine.name', __('店家名稱'));
            $filter->equal('Machine.category', __('機台種類'));
        });

        $grid->column('id', __('Id'));
        $grid->column('Machine.state', __('店家區域'));
        $grid->column('Machine.name', __('店家名稱'));
        $grid->column('Machine.category', __('機台種類'));
        $grid->column('num', __('座位號碼'))->display(function ($num) {
            $result = (int)$num;
            $result += 1;
            return $result.'號';
        });;
        $grid->column('bet', __('開分(押分)'));
        $grid->column('credits', __('洗分(餘分)'));
        //$grid->column('created_time', __('創建時間'))->sortable();
        //$grid->column('update_time', __('更新時間'))->sortable();
        //$grid->column('mac', __('Mac'));

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
        $show = new Show(PlayerData::findOrFail($id));

        $show->field('id', __('Id'));
        $show->field('mac', __('Mac'));
        $show->field('num', __('Num'));
        $show->field('bet', __('Bet'));
        $show->field('credits', __('Credits'));
        $show->field('created_time', __('Created time'));
        $show->field('update_time', __('Update time'));

        return $show;
    }

    /**
     * Make a form builder.
     *
     * @return Form
     */
    protected function form()
    {
        $form = new Form(new PlayerData());

        $form->number('mac', __('Mac'));
        $form->number('num', __('Num'));
        $form->number('bet', __('Bet'));
        $form->number('credits', __('Credits'));
        $form->datetime('created_time', __('Created time'))->default(date('Y-m-d H:i:s'));
        $form->datetime('update_time', __('Update time'))->default(date('Y-m-d H:i:s'));

        return $form;
    }
}
