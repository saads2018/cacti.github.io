<?php

namespace Tests\Unit;

use Tests\TestCase;
use App\Models\User;


class UserLoginTest extends TestCase
{
    /**
     * A basic unit test example.
     *
     * @return void
     */
    public function test_check_login_route()
    {
        $response = $this->get('/login');

        $response->assertStatus(200);
    }

    public function test_check_register_route()
    {
        //$this->withoutExceptionHandling();
        $response = $this->get('/register');

        $response->assertStatus(200);
    }

    public function test_check_checkout_route()
    {
        //$this->withoutExceptionHandling();
        $response = $this->get('/checkout');

        $response->assertStatus(200);
    }

    public function test_user_duplication(){
        
        $user1 = User::make([
            'name' => 'Nirodha',
            'email' => 'niro@gmail.com'
        ]);

        $user2 = User::make([
            'name' => 'John',
            'email' => 'john@gmail.com'
        ]);

        $this->assertTrue($user1->email != $user2->email);
    }

    public function test_if_new_user_added(){
        
        $response = $this->post('/register', [
            'name' => 'Mary',
            'email' => 'mary@gmail.com',
            'password' => 'abcd1111',
            'password_confirmation' => 'abcd1111'
        ]);

        $response->assertRedirect('/homepage');
    }

    public function test_if_user_can_login(){

        $user = User::factory()->make([
            'email' => 'testemail@test.com',
            'password' => bcrypt('test123'),
        ]);

        $response = $this->actingAs($user)->get('/login');

        $response->assertRedirect('/home');
    }
    
}
