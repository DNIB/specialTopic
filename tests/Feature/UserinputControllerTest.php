<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Http\Request;
use Tests\TestCase;
use App\User;
use App\Userinput;
use Illuminate\Support\Facades\Auth;

class UserinputControllerTest extends TestCase
{   
    use DatabaseMigrations;
    use RefreshDatabase;
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
    public function testCreateSuccess()
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
     * test User get route Userinput.store
     *
     * @return void
     */
    public function testStoreSuccess()
    {   
        $this->demoUserLoginIn();

        Userinput::create([
            'userID' => 999,
            'money' => 999,
            'itemID' => 1,
        ]);
        
        $response = $this->post(route('Userinput.store'));
        
        $response->assertStatus(302);
    }

    public function testFailStore()
    {
        $this->demoUserLoginIn();

        $response = ([
            'itemID' => '1',
            'money' => '-1',
        ]);

        $response = $this->get(route('Userinput.store'));
        $response->assertStatus(200);
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

    public function testSuccessDelete()
    {
        $this->demoUserLoginIn();

        $data = Userinput::create([
            'userID' => 999,
            'itemID' => 1,
            'describe' => 'test',
            'money' => 999,
            'created_at' => '2021-04-18',
            'updated_at' => '2021-04-18',
        ]);
        $response = $this->delete(route('Userinput.destroy', 1));
        
        $response->assertStatus(302);
    }

}
