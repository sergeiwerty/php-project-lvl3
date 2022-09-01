<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\Routing\Redirector;
use Illuminate\Support\Facades\DB;

class UrlController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Application|Factory|View
     */
    public function index(): Application|Factory|View
    {
        $urls = DB::table('urls')
            ->get();

        foreach ($urls as $url) {
            $url->check = DB::table('url_checks')
                ->where('url_id', $url->id)
                ->orderByDesc('created_at')
                ->limit(1)
                ->first();
        }

        return view('url.index', ['urls' => $urls->all()]);
    }


    /**
     * @param  Request  $request
     * @return Application|RedirectResponse|Redirector|void
     */
    public function store(Request $request)
    {
        $uri = $request->input('url.name');
        $normalizedUrl = strtolower(parse_url($uri, PHP_URL_SCHEME) . '://' . parse_url($uri, PHP_URL_HOST));

        if (DB::table('urls')->where('name', '=', $normalizedUrl)->exists()) {
            flash('Введённый URL уже существует.')->info();

            /**
             * @var object $id
             */
            $id = DB::table('urls')
                ->where('name', '=', $normalizedUrl)
                ->first();
            return redirect(
                route(
                    'urls.show',
                    $id->id
                )
            );
        }

        $request->validate([
            'url.name' => 'url|required|max:255|unique:urls,name'
        ], [
            'url.name.url' => 'Введённый URL невалиден',
            'url.name.required' => 'Поле обязательно для заполнения',
            'url.name.max:255' => 'Превышена максимальная длина в 255 символов',
        ]);

        $id = DB::table('urls')
            ->insertGetId([
                'name' =>  $normalizedUrl,
                'created_at' => Carbon::now(),
            ]);

        if ($id !== null) {
            flash('URL успешно добавлен')->success();
            return redirect()->route('urls.show', $id);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return Application|Factory|View
     */
    public function show($id)
    {
        /**
         * @var object $urlData
         */
        $urlData = DB::table('urls')
            ->where('id', '=', $id)
            ->get()
            ->first();

        $checkData = DB::table('url_checks')
            ->where('url_id', '=', $id)
            ->get();

        return view('url.show', ['urlData' => $urlData, 'checks' => $checkData->all()]);
    }
}
