<?php

namespace Tests\Feature;

use Carbon\Carbon;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class UrlControllerTest extends TestCase
{

    use RefreshDatabase;

    public function testIndex()
    {
        $response = $this->get(route('urls.index'));
        $response->assertStatus(200);
    }

    public function testStore()
    {
        $id = DB::table('urls')
            ->insertGetId([
                'name' =>  'http://example.com/',
                'created_at' => Carbon::now('+03:00'),
            ]);

        $urlData = DB::table('urls')
            ->select('*')
            ->where('id', '=', $id)
            ->get()
            ->first();

        $response = $this->post(route('urls.store'), (array)$urlData);
        dump(route('urls.show', $id));
        $response->assertRedirect(route('urls.show', $id));
        $response->assertSessionHasNoErrors();

        $this->assertDatabaseHas('urls', (array)$urlData);
        $this->assertTrue(true);


//        $data = Article::factory()->make()->only('name', 'body');
//        $response = $this->post(route('articles.store'), $data);
//        $response->assertRedirect(route('articles.index'));
//        $response->assertSessionHasNoErrors();
//
//        $this->assertDatabaseHas('urls', $data);
    }
}
