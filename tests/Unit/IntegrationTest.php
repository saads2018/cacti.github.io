<?php

namespace Tests\Unit;

use App\Models\Product;
use App\Models\User;

use Tests\TestCase;

class IntegrationTests_Admin extends TestCase
{
    /**
     * A basic unit test example.
     *
     
     */
    public function test_deleteProduct()
    {
        $this->withoutExceptionHandling();

        $user = User::factory()->make([
            'email' => 'saadsultan2018@gmail.com',
            'password' => bcrypt('12345678'),
            'user_type' => 'super_admin',
            'name' => 'Saad Sultan'
        ]);

        $response=$this->actingAs($user)->json('post','/addProduct',
        ['name'=>"Cacti",'quantity'=>100,'Type'=>"Plant",'Desc'=>"Great!!!",
        'Price'=>10,'Supplier'=>"Supplier1",'file'=>new        
        \Illuminate\Http\UploadedFile(resource_path('download.png'), 
        'download.png', null, null, true)]);


        $response=$this->actingAs($user)->assertDatabaseHas('products',
        ['Product_Name'=>"Cacti",'Product_Quantity'=>100,
        'Product_Type'=>"Plant",'Product_Desc'=>"Great!!!",
        'Product_Price'=>10,'Product_Supplier'=>"Supplier1"]);

        $response=$this->get('/deleteProduct/52');

        $response=$this->get('/item/52');

        $response->assertStatus(200);

    }

    public function test_addProduct()
    {
        $this->withoutExceptionHandling();

        $user1 = User::factory()->make([
            'email' => 'sauddsultan2010@gmail.com',
            'password' => bcrypt('12345678'),
            'user_type' => 'super_admin',
            'name' => 'Saud Sultan'
        ]);

        $response=$this->actingAs($user1)->json('post','/addProduct',
        ['name'=>"Cacti",'quantity'=>100,'Type'=>"Plant",'Desc'=>"Great!!!",
        'Price'=>10,'Supplier'=>"Supplier1",'file'=>new        
        \Illuminate\Http\UploadedFile(resource_path('download.png'), 
        'download.png', null, null, true)]);


        $response=$this->get('/item/53');

        $response->assertStatus(200);

    }


    public function test_addSupplier()
    {
        $this->withoutExceptionHandling();

        $user = User::factory()->make([
            'email' => 'saadsultan2018@gmail.com',
            'password' => bcrypt('12345678'),
            'user_type' => 'super_admin',
            'name' => 'Saad Sultan'
        ]);

        $response=$this->actingAs($user)->json('post','/addSupplier/default',
        ['name'=>"Supplier3",'phoneno'=>"013593931",
        'email'=>"saad111@gmail.com",'Address'=>"Floridale"]);

        $response=$this->get('/editSupplier/51');

        $response->assertStatus(200);

    }
    
}
