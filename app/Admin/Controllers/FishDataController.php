<?php

namespace App\Admin\Controllers;

use App\Model\fish_data;
use App\Model\player_data;
use Encore\Admin\Controllers\AdminController;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Show;
use Encore\Admin\Widgets\Table;

class FishDataController extends AdminController
{
    /**
     * Title for current resource.
     *
     * @var string
     */
    protected $title = '機台帳務';

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        $grid = new Grid(new fish_data());
        $player = player_data::all();
        $player = $player->where('mac', '2882391723459784293');

        $grid->column('id', __('Id'))->totalRow('合计');
        $grid->column('mac', __('Mac'));
        $grid->column('coin_ratio', __('投幣比率'));
        $grid->column('player_count', __('玩家總計'));
        $grid->column('income', __('收入'))->totalRow();
        $grid->column('payout', __('支出'))->totalRow();
        $grid->column('created_time', __('創建時間'));
        $grid->column('update_time', __('更新時間'));

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
        $show = new Show(fish_data::findOrFail($id));

        $show->field('id', __('Id'));
        $show->field('mac', __('Mac'));
        $show->field('coin_ratio', __('投幣比率'));
        $show->field('player_count', __('玩家總計'));
        $show->field('income', __('收入'));
        $show->field('payout', __('支出'));
        $show->field('created_time', __('創建時間'));
        $show->field('update_time', __('更新時間'));

        return $show;
    }

    /**
     * Make a form builder.
     *
     * @return Form
     */
    protected function form()
    {
        $form = new Form(new fish_data());

        $form->text('mac', __('Mac'));
        $form->number('coin_ratio', __('投幣比率'));
        $form->number('player_count', __('玩家總計'));
        $form->number('income', __('收入'));
        $form->number('payout', __('支出'));
        $form->datetime('created_time', __('創建時間'))->default(date('Y-m-d H:i:s'));
        $form->datetime('update_time', __('更新時間'))->default(date('Y-m-d H:i:s'));

        return $form;
    }
}
