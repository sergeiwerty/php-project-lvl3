<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;

class CheckController extends Controller
{
    public function addCheck(Request $request, $id)
    {
        $urlName = DB::table('urls')
            ->select('name')
            ->where('id', '=', $id)
            ->get()
            ->first();

        $status = Http::get($urlName->name)->status();

        DB::table('url_checks')
            ->insertGetId([
                'url_id' =>  $id,
                'status_code' => $status,
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
