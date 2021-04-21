<?php

namespace Tests;

use Illuminate\Foundation\Testing\TestCase as BaseTestCase;
use App\User;
use App\Userdata;

abstract class TestCase extends BaseTestCase
{
    use CreatesApplication;

    protected function demoUserLoginIn()
    {
        $user = User::create([
            'id' => 999,
            'name' => 'qwe',
            'email' => 'qwe@qwe.com',
            'password' => '123123123',
        ]);
        // Use model in tests...
        // 登入 user
        $this->be($user);
    }
}
