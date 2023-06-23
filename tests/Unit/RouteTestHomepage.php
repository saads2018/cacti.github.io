<?php

namespace Tests\Unit;

use Tests\TestCase;
use App\Models\Product;

class RouteTestHomepage extends TestCase
{
    /**
     * A basic unit test example.
     *
     * @return void
     */
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

    public function test_IncreaseCartProducts(){
        $response = $this->get('cart/increaseCartQuantity/{Product_ID}');
        $response->assertStatus(200);   
    }

    public function test_DecreaseCartProducts(){
        $response = $this->get('cart/decreaseCartQuantity/{Product_ID}');
        $response->assertStatus(200);
    }

}
