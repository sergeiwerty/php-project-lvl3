<?php

namespace Tests\Feature;

use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Tests\TestCase;

class UrlControllerTest extends TestCase
{
    /**
     * @var array<string>
     */
    protected $urlDataSet;

    public function setUp(): void
    {
        parent::setUp();

        $createdAt = Carbon::now();
        $this->urlDataSet = [
            'name' =>  'http://example.com/',
            'created_at' => $createdAt,
        ];

        $this->id = DB::table('urls')
                        ->insertGetId($this->urlDataSet);
    }

    public function testIndex(): void
    {
        $response = $this->get(route('urls.index'));
        $response->assertStatus(200);
    }

    public function testStore(): void
    {

        $this->assertDatabaseHas('urls', [
            'name' =>  'http://example.com/',
            'created_at' => $this->urlDataSet['created_at'],
        ]);

        $response = $this->post(
            route('urls.store'),
            ['_token' => csrf_token(), 'url' => ['name' => 'http://example2.com']]
        );

        $response->assertRedirect(route('urls.show', 2));
        $response->assertSessionHasNoErrors();
    }

    public function testShow(): void
    {
        /**
         * @var mixed $urlData
         */
        $urlData = DB::table('urls')
            ->where('id', '=', $this->id)
            ->first();

        $response = $this->get(route('urls.show', ['url' => $this->id]));
        $response->assertOk();

        $response->assertSee($urlData->name);
    }
}
