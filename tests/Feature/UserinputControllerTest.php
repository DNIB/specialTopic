<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Http\Request;
use Tests\TestCase;
use App\User;
use App\Models\Userinput;
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
     * 測試admin進入
     * 
     * @return view
     */
    public function testSuccessIndexAdmin()
    {
        $this->demoAdminLoginIn();

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
     * @return viewIs
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

        $data = [
            'userID' => 1,
            'itemID' => 1,
            'describe' => 'test',
            'money' => 999,
        ];
        
        $response = $this->post(route('Userinput.store', $data));
        $response->assertStatus(302);
    }
    /**
     * test store not allow value
     * 
     * @return void
     */
    public function testFailStore()
    {
        $this->demoUserLoginIn();

        $data = [
            'userID' => 1,
            'itemID' => 1,
            'describe' => 'test',
            'money' => -1,
        ];
        
        $response = $this->post(route('Userinput.store'), $data);
        $response->assertStatus(302);
    }
    /**
     * test success edit data
     * 
     * @return void
     */
    public function testSuccessEdit()
    {
        $this->demoUserLoginIn();

        $data = Userinput::create([
            'userID' => 1,
            'itemID' => 1,
            'describe' => 'test',
            'money' => 999,
        ]);

        $response = $this->get(route('Userinput.edit', 1));
        $response->assertStatus(200);
    }
    /**
     * test fail edit data
     * 
     * @return void
     */
    public function testFailEdit()
    {
        $this->demoUserLoginIn();

        $data = Userinput::create([
            'userID' => 2,
            'itemID' => 1,
            'describe' => 'test',
            'money' => 999,
        ]);

        $response = $this->get(route('Userinput.edit', 1));
        $response->assertStatus(403);
    }
    /**
     * test admin edit data
     * 
     * @return void
     */
    public function testAdminEdit()
    {
        $this->demoAdminLoginIn();

        $data = Userinput::create([
            'userID' => 1,
            'itemID' => 1,
            'describe' => 'test',
            'money' => 999,
        ]);

        $response = $this->get(route('Userinput.edit', 1));
        $response->assertStatus(200);
    }
    /**
     * test success edit data
     * 
     * @return void
     */
    public function testSuccessUpdate()
    {
        $this->demoUserLoginIn();
        
        $set = Userinput::create([
            'userID' => 1,
            'itemID' => 1,
            'describe' => 'test',
            'money' => 999,
        ]);
        
        $data = [
            'userID' => 1,
            'itemID' => 1,
            'describe' => 'test',
            'money' => 99,
        ];

        $response = $this->put("Userinput/1", $data);

        $response->assertStatus(302);
    }
    /**
     * test success delete data
     * 
     * @return void
     */
    public function testSuccessDelete()
    {
        $this->demoUserLoginIn();

        $data = Userinput::create([
            'userID' => 999,
            'itemID' => 1,
            'describe' => 'test',
            'money' => 999,
        ]);
        
        $response = $this->delete(route('Userinput.destroy', 1));
        $response->assertStatus(302);
    }
    /**
     * test show user search items
     * 
     * @return void
     */
    public function testUserShowSearchItem()
    {
        $this->demoUserLoginIn();

        Userinput::create([
            'userID' => 1,
            'itemID' => 1,
            'describe' => 'test',
            'money' => 999,
        ]);
        
        $data = [
            'searchUser' => 1,
        ];

        $response = $this->post(route('Userinput.showSearchItem'), $data);
        $response->assertStatus(200);
    }
    /**
     * test admin search items then show them
     * 
     * @return void
     */
    public function testAdminShowSearchItem()
    {
        $this->demoAdminLoginIn();

        Userinput::create([
            'userID' => 999,
            'itemID' => 1,
            'describe' => 'test',
            'money' => 999,
        ]);
        
        $data = [
            'searchUser' => 1,
            'searchItem' => 1,
        ];

        $response = $this->post(route('Userinput.showSearchItem'), $data);
        $response->assertStatus(200);
    }
    /**
     * test admin search items if search equal zero
     * 
     * @return void
     */
    public function testAdminShowSearchItemZero()
    {
        $this->demoAdminLoginIn();

        Userinput::create([
            'userID' => 999,
            'itemID' => 1,
            'describe' => 'test',
            'money' => 999,
        ]);
        
        $data = [
            'searchUser' => 1,
            'searchItem' => 0,
        ];

        $response = $this->post(route('Userinput.showSearchItem'), $data);
        $response->assertStatus(200);
    }
}
