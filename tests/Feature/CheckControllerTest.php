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
                'created_at' => Carbon::now(),
            ]);

        $content = <<<CODE
        <html lang='en'>
            <head>
                <title>Awesome page</title>
                <meta name="description" content="Statements of great people">
                <title>Test page</title>
            </head>
            <body>
                <div>
                    <h1>Do not expect a miracle, miracles yourself!</h1>
                </div>
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