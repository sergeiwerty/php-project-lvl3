<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;
use DiDom\Document;
use stdClass;

class CheckController extends Controller
{
    /**
     * @param  int  $id
     * @return RedirectResponse
     */
    public function store(int $id): RedirectResponse
    {
        /**
         * @var stdClass $urlName
         */
        $urlName = DB::table('urls')
            ->select('name')
            ->where('id', '=', $id)
            ->first();

        abort_unless(is_object($urlName), 404);

        try {
            $response = Http::get($urlName->name);
            $status = $response->status();
            $document = new Document($response->body());

            $h1 = $document->has('h1') ? $document->first('h1') : null;
            $title = $document->has('title') ? $title = $document->first('title') : null;
            $metaContent =
                $document->has('meta[name="description"][content]') ?
                    $document->first('meta[name="description"][content]') : null;

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
                    'created_at' => Carbon::now(),
                ]);
        } catch (\Exception $exception) {
            flash($exception->getMessage())->error();
            return back();
        }

        return redirect()->route('urls.show', ['url' => $id]);
    }
}
