<?php

namespace App\Admin\Controllers;

use App\Model\FishData;
use App\Model\MachineBind;
use App\Model\PlayerData;
use App\Model\JackpotHistory;
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
        $grid = new Grid(new FishData);

        $grid->model()->orderBy('update_time', 'DESC');

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
            $filter->equal('mac', __('機台身分證'));
        });

        $grid->column('Machine.state', __('機台區域'))->totalRow('合計');

        $Fish = new FishData;
        $grid->column('Machine.name', __('店家名稱'))->expand(function ($Fish) {

            $Players = $Fish->Player()->get()->map(function ($Player) {
                $seatNum = $Player['num'] + 1;
                $bet = $Player['bet'];
                $credits = $Player['credits'];
                $update_time = $Player['update_time'];
                return [$seatNum, $bet, $credits, $update_time];
            });
        
            return new Table(['座位編號','押分','餘分', '更新時間'], $Players->toArray());
        });
        
       
        $grid->column('Machine.category', __('機台種類'));
        $grid->column('coin_ratio', __('投幣比率'));
        $grid->column('player_count', __('玩家總計'));

        $open = '點開';
        $Machine = new MachineBind;
        $grid->column($open, '彩金紀錄')->modal('彩金狀態', function ($Machine) {

            $Machines = $Machine->JackpotHistory()->get()->map(function ($Machine) {

                $seatNum = $Machine['player'] + 1;
                $JP = $Machine['jackpot'];
                $coins = $Machine['coins'];
                $datetime = $Machine['datetime'];

                return [$seatNum, $JP, $coins, $datetime];
            });
        
            return new Table(['拉彩位子', 'JP', '硬幣', '時間'], $Machines->toArray());
        });
        $grid->column('income', __('收入'))->totalRow();
        $grid->column('payout', __('支出'))->totalRow();
        $grid->column('created_time', __('創建時間'))->sortable();
        $grid->column('update_time', __('更新時間'))->sortable();
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
        $show = new Show(FishData::findOrFail($id));

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
        $form = new Form(new FishData());

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
