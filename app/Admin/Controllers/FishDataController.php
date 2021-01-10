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
    protected $title = 'fish_data';

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        $grid = new Grid(new fish_data());
        $player = new player_data;

        $grid->column('id', __('Id'))->totalRow('合计');
        $grid->column('mac', __('Mac'));
        $grid->column('coin_ratio', __('(匯率)Coin ratio'));
        $grid->column('player_count', __('(玩家總計)Player count'));
        $grid->column('income', __('(收入)Income'))->totalRow();
        $grid->column('payout', __('(支出)Payout'))->totalRow();
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
        $show->field('coin_ratio', __('Coin ratio'));
        $show->field('player_count', __('Player count'));
        $show->field('income', __('Income'));
        $show->field('payout', __('Payout'));
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
        $form = new Form(new fish_data());

        $form->text('mac', __('Mac'));
        $form->number('coin_ratio', __('Coin ratio'));
        $form->number('player_count', __('Player count'));
        $form->number('income', __('Income'));
        $form->number('payout', __('Payout'));
        $form->datetime('created_time', __('Created time'))->default(date('Y-m-d H:i:s'));
        $form->datetime('update_time', __('Update time'))->default(date('Y-m-d H:i:s'));

        return $form;
    }
}
