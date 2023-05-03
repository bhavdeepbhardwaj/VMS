<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Carbon\Carbon;

class ScriptController extends Controller
{
    public function updateCheckOut()
    {
        $checkOutData = \App\Models\Visitor::whereNull('updated_at')->get();

        foreach ($checkOutData as $data)
        {
            \App\Models\Visitor::where('id',$data->id)->update([
                'updated_at' =>  Carbon::now()
            ]);
        }

        dd('done');
    }
}
