<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Model\MachineBind;
use Validator;

class MachineController extends Controller
{
    public function getMachine(Request $request)
    {
        $rules = [
            'mac' => 'required',
            'player' => 'required',
        ];
        $validator = Validator::make($request->all(), $rules);

        if($validator->fails())
        {
            return response()->json($validator->errors(), 400);
        }
        $mac = $request->mac;
        $player = $request->player + 1;
        
        $Machine = new MachineBind;
        $Machine = MachineBind::where('bind_mac', '=', $mac)->first();

        echo header("Content-type:text/html;charset=utf-8");
        echo $Machine->state.'區'.$Machine->category.'-'.$player.'號玩家';

    }
}
