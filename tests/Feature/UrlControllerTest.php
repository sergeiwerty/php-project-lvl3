<?php

namespace Tests\Feature;

use Carbon\Carbon;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\DB;
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
                'created_at' => Carbon::now(),
            ]);

        $urlData = DB::table('urls')
            ->select('*')
            ->where('id', '=', $id)
            ->get()
            ->first();

        $response = $this->post(
            route('urls.store'),
            ['_token' => csrf_token(), 'url' => ['name' => 'http://example2.com']]
        );
        $response->assertRedirect(route('urls.show', 2));
        $response->assertSessionHasNoErrors();

        $this->assertDatabaseHas('urls', (array)$urlData);
        $this->assertTrue(true);
    }

    public function testShow()
    {
        $id = DB::table('urls')
            ->insertGetId([
                'name' =>  'http://example.com/',
                'created_at' => Carbon::now(),
            ]);

        $urlData = DB::table('urls')
            ->select('*')
            ->where('id', '=', $id)
            ->get()
            ->first();

        $response = $this->get(route('urls.show', ['url' => $urlData->id]));
        $response->assertOk();
        $response->assertSee($urlData->name);
    }
}
