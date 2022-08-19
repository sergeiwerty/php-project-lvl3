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
//        $urls = DB::table('urls')
//            ->select('*')
//            ->get();

        $urlChecks = DB::table('url_checks')
            ->select('*')
            ->get();

        return view('url.index', ['urls' => $urls->all(), 'url_checks' => $urlChecks->all()]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return RedirectResponse
     */
    public function store(Request $request)
    {

        $request->validate([
            'url.name' => 'url|required|max:255|unique:urls,name'
        ], [
            'url.name.url' => 'Введённый URL невалиден',
            'url.name.required' => 'Поле обязательно для заполнения',
            'url.name.unique' => 'Введённый URL уже существует',
            'url.name.max:255' => 'Превышена максимальная длина в 255 символов',
        ]);

        $uri = $request->input('url.name');
        $normalizedUrl = strtolower(parse_url($uri, PHP_URL_SCHEME) . '://' . parse_url($uri, PHP_URL_HOST));

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
//
        $urlData = DB::table('urls')
            ->select('*')
            ->where('id', '=', $id)
            ->get();

        return view('url.show', ['urlData' => $urlData->first()]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
