<?php

namespace Tests\Unit;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Http\Controllers\UserController;
use App\User;
class UserTest extends TestCase
{
    /**
     * A basic unit test example.
     *
     * @return void
     */
    /** @test  */
    public function test_stores_user() {
        $response = $this->post('/register', [
            '_token'=> 'lO7kAtjfZt40Df5E69NdKqhH84F9OCNJd0A78uGD',
            'name'=> '123',
            'workspace'=> 'czxczx',
            'email'=> 'czxcxzcxzc@gmail.com',
            'password'=> 'zxczxczxc',
            'password_confirmation' => 'zxczxczxc'
        ]);
        $response->assertRedirect('/home');
    }
}
