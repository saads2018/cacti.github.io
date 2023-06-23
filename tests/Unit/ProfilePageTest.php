<?php

namespace Tests\Unit;

use Tests\TestCase;
use App\Models\User;

class ProfilePageTest extends TestCase
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

    public function test_if_user_edited()
    {

        $user1 = User::make([
            'name' => 'Aaron Riang Jose',
            'email' => 'Aaron.riang99@gmail.com'
        ]);
        $this->assertTrue($user1->email=='Aaron.riang99@gmail.com');

        $user1 = User::update([
            'name' => 'Aaron Riang Jose',
            'email' => 'aarontwilight@hotmail.com'
        ]);
        $this->assertTrue($user1->email=='aarontwilight@hotmail.com');
    }
}
