<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\User;
use App\Models\Userdata;

class UserSelfControllerTest extends TestCase
{   
    use DatabaseMigrations;
    use RefreshDatabase;
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function testExample()
    {
        $response = $this->get('/');

        $response->assertStatus(200);
    }

    public function testEdit()
    {   
        $this->demoAdminLoginIn();

        $response = $this->get('/userself/1/edit');

        $response->assertViewIs('userSelfDataEdit');
    }

    public function testUpdate()
    {
        $this->demoAdminLoginIn();
        $data = [
            'id' => 1,
            'name' => '123',
            'role' => 'admin',
            'email' => 'qwe@qwe.com',
            'password' => '123123123',
        ];
        $response = $this->put('userself/1', $data);
        $response->assertStatus(302);
    }

    public function testDelete()
    {
        $this->demoAdminLoginIn();

        $response = $this->delete('userself/1');
        $response->assertStatus(302);
    }
}
