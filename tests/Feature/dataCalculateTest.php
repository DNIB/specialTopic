<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\User;
use App\Models\Userinput;

class dataCalculateTest extends TestCase
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
    /**
     *  測試點擊後的導向
     * 
     * @return void
     */
    public function testIndex()
    {
        $this->demoUserLoginIn();

        $response = $this->get('/dataCalculate');
        $response->assertStatus(200);
    }
}
