<?php

namespace Tests\Unit;

use Tests\TestCase;

class ProductPageTest extends TestCase
{
    /**
     * A basic unit test example.
     *
     * @return void
     */
    public function test_routeToProduct()
    {
        $response = $this->get('/product');
        $response->assertStatus(200); 
        
    }

    public function test_routeToCart()
    {
        $response = $this->get('/cart');
        $response->assertStatus(200); 
        
    }




}
