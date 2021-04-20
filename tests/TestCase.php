<?php

namespace Tests;

use Illuminate\Foundation\Testing\TestCase as BaseTestCase;
use App\User;

abstract class TestCase extends BaseTestCase
{
    use CreatesApplication;

    protected function demoUserLoginIn()
    {
        $user = factory(User::class)->create();
        // Use model in tests...
        // 登入 user
        $this->be($user);
    }
}
