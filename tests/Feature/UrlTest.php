<?php

namespace Tests\Feature;

use Illuminate\Support\Facades\Gate;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class UrlTest extends TestCase
{
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
    
    public function testHomeUrl()
    {
        $response = $this->get('/home');

        $response->assertStatus(302);
    }

    public function testUserinputUrl()
    {
        $response = $this->get('/Userinput');

        $response->assertStatus(302);
    }
}
