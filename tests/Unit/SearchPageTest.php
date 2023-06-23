<?php

namespace Tests\Unit;

use Tests\TestCase;

class SearchPageTest extends TestCase
{
    /**
     * A basic unit test example.
     *
     * @return void
     */
    public function test_routeToSearch()
    {
        $response = $this->get('/search/brightmoonbakery');
        $response->assertStatus(200); 
    }

    public function test_httpResponseSearch()
    {
        $response = $this->json('get','/search/{search}',['name'=>'brightmoonbakery']);
        $response->assertStatus(200);
    }
}
