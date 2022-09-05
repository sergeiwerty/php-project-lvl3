<?php

namespace Tests\Feature;

use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;
use Tests\TestCase;

class CheckControllerTest extends TestCase
{
    public function testAddCheck(): void
    {
        $created_at = Carbon::now();
        $id = DB::table('urls')
            ->insertGetId([
                'name' =>  'http://laravel.com',
                'created_at' => $created_at,
            ]);

        $content = file_get_contents(__DIR__ . "/../fixtures/" . "example.html");

        Http::fake([
            '*' => Http::response($content, 200),
        ]);

        $response = $this->post(route('urls.checks.store', [$id]));
        $response->assertRedirect();

        $checkData = [
            'url_id' => $id,
            'status_code' => 200,
            'title' => 'Laravel - The PHP Framework For Web Artisans',
            'description' => 'Laravel is a PHP web application framework with expressive syntax.',
            'h1' => 'The PHP Framework for Web Artisans',
            'created_at' => $created_at
        ];

        $this->assertDatabaseHas('url_checks', $checkData);
    }
}
