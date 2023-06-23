<?php

namespace Tests\Unit;

use App\Models\Product;
use Tests\TestCase;

class HomepageTest extends TestCase
{
    /**
     * A basic unit test example.
     *
     * @return void
     */
    public function test_example()
    {
        $this->assertTrue(true);
    }

    public function test_routeToHomepage()
    {
        $response = $this->get('/');
        $response->assertStatus(200); 
    }

    public function test_routeToProductPage()
    {
        $response = $this->get('/product');
        $response->assertStatus(200);
    } 

    public function test_routeToCartPage()
    {
        $response = $this->get('/cart');
        $response->assertStatus(200);
    }

    public function test_routeToRegister()
    {
        $response = $this->get('/register');
        $response->assertStatus(200);
    }
}
