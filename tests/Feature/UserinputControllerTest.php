<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Http\Request;
use Tests\TestCase;

class UserinputControllerTest extends TestCase
{   
    use DatabaseMigrations;
    /**
     * test user get route Userinput.index
     *
     * @return view
     */
    public function testSuccessIndex()
    {
        $this->demoUserLoginIn();

        $response = $this->get(route('Userinput.index'));
        $response->assertViewIs('index');
    }
    /**
     * test notUser get route Userinput.index
     *
     * @return view
     */
    public function testFailIndex()
    {
        $response = $this->get(route('Userinput.index'));
        $response->assertStatus(302);
    }
    /**
     * test user get route Userinput.create
     *
     * @return view
     */
    public function testSuccessCreate()
    {
        $this->demoUserLoginIn();

        $response = $this->get(route('Userinput.create'));
        $response->assertViewIs('create');
    }
    /**
     * test notUser get route Userinput.create
     *
     * @return view
     */
    public function testFailCreate()
    {
        $response = $this->get(route('Userinput.create'));
        $response->assertRedirect('/login');
    }
    /**
     * test User get route Userinput.create
     *
     * @return void
     */
    public function testSuccessStore()
    {   
        $this->demoUserLoginIn();

        $response = $this->get(route('Userinput.store'));
        $response->assertStatus(200);
    }

    public function testFailStore()
    {
        $this->demoUserLoginIn();
        
    }

    public function testSuccessEdit()
    {
        $this->demoUserLoginIn();

    }

    public function testFailEdit()
    {
        $this->demoUserLoginIn();

    }

    public function testSuccessUpdate()
    {
        $this->demoUserLoginIn();

    }

    public function testFailUpdate()
    {
        $this->demoUserLoginIn();

    }

}
