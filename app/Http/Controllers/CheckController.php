<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;
use DiDom\Document;
use DiDom\Query;

class CheckController extends Controller
{
    public function store(Request $request, $id)
    {
        try {
            $urlName = DB::table('urls')
                ->select('name')
                ->where('id', '=', $id)
                ->get()
                ->first();

            $status = Http::get($urlName->name)->status();

            $document = new Document($urlName->name, true);

            if ($document->has('h1')) {
                $h1 = $document->first('h1');
            } else {
                $h1 = null;
            }

            if ($document->has('title')) {
                $title = $document->first('title');
            } else {
                $title = null;
            }

            if ($document->has('meta[name="description"][content]')) {
                $metaContent = $document->first('meta[name="description"][content]');
            } else {
                $metaContent = null;
            }

            $h1Text = optional($h1)->text();
            $titleText = optional($title)->text();
            $metaContentText = optional($metaContent)->getAttribute('content');

            DB::table('url_checks')
                ->insert([
                    'url_id' =>  $id,
                    'status_code' => $status,
                    'h1' => $h1Text,
                    'title' => $titleText,
                    'description' => $metaContentText,
                    'created_at' => Carbon::now('+03:00'),
                ]);
        } catch (\Exception $exception) {
            flash($exception->getMessage())->error();
            return back();
        }


//        $checkData = DB::table('url_checks')
//            ->select('*')
//            ->where('url_id', '=', $id)
//            ->get();

//        $urlData = DB::table('urls')
//            ->select('*')
//            ->where('id', '=', $id)
//            ->get();

//        return view('url.show', ['urlData' => $urlData->first(), 'checks' => $checkData->all()]);
        return redirect()->route('urls.show', ['url' => $id]);
    }
}
