<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CheckController extends Controller
{
    public function addCheck(Request $request, $id)
    {
        DB::table('url_checks')
            ->insertGetId([
                'url_id' =>  $id,
                'created_at' => Carbon::now('+03:00'),
            ]);

        $checkData = DB::table('url_checks')
            ->select('*')
            ->where('url_id', '=', $id)
            ->get();

        $urlData = DB::table('urls')
            ->select('*')
            ->where('id', '=', $id)
            ->get();

        return view('url.show', ['urlData' => $urlData->first(), 'checks' => $checkData->all()]);
    }
}
