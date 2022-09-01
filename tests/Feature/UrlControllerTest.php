<?php

namespace Tests\Feature;

use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Tests\TestCase;

class UrlControllerTest extends TestCase
{
    public function testIndex(): void
    {
        $response = $this->get(route('urls.index'));
        $response->assertStatus(200);
    }

    public function testStore(): void
    {
        DB::table('urls')
            ->insert([
                'name' =>  'http://example.com/',
                'created_at' => Carbon::now(),
            ]);

        $this->assertDatabaseCount('urls', 1);

        $response = $this->post(
            route('urls.store'),
            ['_token' => csrf_token(), 'url' => ['name' => 'http://example2.com']]
        );

        $response->assertRedirect(route('urls.show', 2));
        $response->assertSessionHasNoErrors();
    }

    public function testShow(): void
    {
        $id = DB::table('urls')
            ->insertGetId([
                'name' =>  'http://example.com/',
                'created_at' => Carbon::now(),
            ]);

        /**
         * @var object $urlData
         */
        $urlData = DB::table('urls')
            ->where('id', '=', $id)
            ->first();

        $response = $this->get(route('urls.show', ['url' => $urlData->id]));
        $response->assertOk();

//        /**
//         * @var string $name
//         */
//        $name = $urlData->name;
//        $response->assertSee($name);
    }
}
