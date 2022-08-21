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
        DB::table('urls')
            ->insertGetId([
                'name' =>  'http://example.com/',
                'created_at' => Carbon::now('+03:00'),
            ]);

        Http::fake([

        ]);
    }
}