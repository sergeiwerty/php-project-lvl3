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
        <!doctype html>
        <html lang='en'>
            <head>
                <meta name="description" content="Laravel is a PHP web application framework with expressive syntax.">
                <title>Laravel - The PHP Framework For Web Artisans</title>
            </head>
            <body>
                <div>
                    <h1>The PHP Framework for Web Artisans</h1>
                </div>
            </body>
        </html>
        CODE;

        Http::fake([
            '*' => Http::response($content, 200),
        ]);

        $response = $this->post("urls/{$id}/checks", [$id]);
        $response->assertStatus(302);

        $checkData = [
            'url_id' => $id,
            'status_code' => 200,
            'title' => 'Laravel - The PHP Framework For Web Artisans',
            'description' => 'Laravel is a PHP web application framework with expressive syntax.',
            'h1' => 'The PHP Framework for Web Artisans',
            'created_at' => Carbon::now()
        ];

        $this->assertDatabaseHas('url_checks', $checkData);
    }
}