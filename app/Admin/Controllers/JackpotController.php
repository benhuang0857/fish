<?php

namespace App\Admin\Controllers;

use App\Model\JackpotHistory;
use App\Model\MachineBind;
use Encore\Admin\Controllers\AdminController;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Show;

class JackpotController extends AdminController
{
    /**
     * Title for current resource.
     *
     * @var string
     */
    protected $title = '彩金紀錄';

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        $grid = new Grid(new JackpotHistory());

        $grid->model()->orderBy('datetime', 'DESC');

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
            $filter->equal('mac', __('機台身分證'));
        });

        $grid->column('Machine.state', __('機台區域'));
        $grid->column('Machine.name', __('店家名稱'));
        $grid->column('Machine.category', __('機台種類'));
        $grid->column('player', __('座位'))->display(function ($player) {
            $result = (int)$player;
            $result += 1;
            return $result.'號';
        });
        $grid->column('jackpot', __('JP'))->display(function ($jackpot) {
            $result = (int)$jackpot;
            $result += 1;
            return 'JP'.$result;
        });
        $grid->column('coins', __('硬幣'));
        $grid->column('datetime', __('時間'))->sortable();
        $grid->column('mac', __('機台身分證'));

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
        $show = new Show(JackpotHistory::findOrFail($id));

        $show->field('id', __('Id'));
        $show->field('serial', __('Serial'));
        $show->field('mac', __('Mac'));
        $show->field('name', __('Name'));
        $show->field('location', __('Location'));
        $show->field('player', __('Player'));
        $show->field('jackpot', __('Jackpot'));
        $show->field('coins', __('Coins'));
        $show->field('datetime', __('Datetime'));
        $show->field('verified', __('Verified'));

        return $show;
    }

    /**
     * Make a form builder.
     *
     * @return Form
     */
    protected function form()
    {
        $form = new Form(new JackpotHistory());

        $form->number('serial', __('Serial'));
        $form->number('mac', __('Mac'));
        $form->text('name', __('Name'));
        $form->text('location', __('Location'));
        $form->number('player', __('Player'));
        $form->number('jackpot', __('Jackpot'));
        $form->number('coins', __('Coins'));
        $form->datetime('datetime', __('Datetime'))->default(date('Y-m-d H:i:s'));
        $form->number('verified', __('Verified'));

        return $form;
    }
}
