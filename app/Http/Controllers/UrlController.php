<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\DB;

class UrlController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function index()
    {
        $urls = DB::table('urls')
            ->select('*')
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
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return RedirectResponse
     */
    public function store(Request $request)
    {
        $uri = $request->input('url.name');
        $normalizedUrl = strtolower(parse_url($uri, PHP_URL_SCHEME) . '://' . parse_url($uri, PHP_URL_HOST));

        if (DB::table('urls')->where('name', '=', $normalizedUrl)->exists()) {
            flash('Введённый URL уже существует.')->info();
            return redirect(
                route(
                    'urls.show',
                    DB::table('urls')
                    ->where('name', '=', $normalizedUrl)
                    ->get()
                    ->first()->id
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
                'created_at' => Carbon::now('+03:00'),
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
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function show($id)
    {
        $urlData = DB::table('urls')
            ->select('*')
            ->where('id', '=', $id)
            ->get();

        $checkData = DB::table('url_checks')
            ->select('*')
            ->where('url_id', '=', $id)
            ->get();

        return view('url.show', ['urlData' => $urlData->first(), 'checks' => $checkData->all()]);
    }
}
