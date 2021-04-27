<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class HomeControllerTest extends TestCase
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

    public function testAdminIndex()
    {
        $this->demoAdminLoginIn();

        $response = $this->get('/home');
        $response->assertViewIs('home');
    }

    public function testUserIndex()
    {
        $this->demoUserLoginIn();

        $response = $this->get('/home');
        $response->assertViewIs('home');
    }
}
