<?php

namespace Tests\Feature;

use Carbon\Carbon;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;
use Tests\TestCase;

class CheckControllerTest extends TestCase
{
    use RefreshDatabase;



    public function testAddCheck()
    {
        $id = DB::table('urls')
            ->insertGetId([
                'name' =>  'http://laravel.com',
                'created_at' => Carbon::now('+03:00'),
            ]);

        $content = <<<CODE
        <html>
          <head>
            <title>Href Attribute Example</title>
          </head>
          <body>
            <h1>Href Attribute Example</h1>
            <p>
              <a href="https://www.freecodecamp.org/contribute/">The freeCodeCamp Contribution Page</a> shows you how and where you can contribute to freeCodeCamp's community and growth.
            </p>
          </body>
        </html>
        CODE;

        Http::fake([
            'http://laravel.com' => Http::response($content, 200),
        ]);

        $response = $this->post("urls/{$id}/checks", [$id]);
        $response->assertStatus(302);
    }
}