<?php

namespace Tests\Unit;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Hash;
use Tests\TestCase;

class UserTest extends TestCase
{
    use RefreshDatabase; // Ensures a clean database for each test

    // Test for mass assignment
    public function test_user_can_be_created_with_fillable_attributes()
    {
        $user = User::create([
            'name' => 'John Doe',
            'email' => 'johndoe@example.com',
            'username' => 'johndoe123',
            'password' => 'password',
        ]);

        $this->assertEquals('John Doe', $user->name);
        $this->assertEquals('johndoe@example.com', $user->email);
        $this->assertEquals('johndoe123', $user->username);
        $this->assertTrue(Hash::check('password', $user->password));
    }

    // Test for hidden attributes
    public function test_password_and_remember_token_are_hidden_when_serializing()
    {
        $user = User::factory()->create();

        $serializedUser = $user->toArray();

        $this->assertArrayNotHasKey('password', $serializedUser);
        $this->assertArrayNotHasKey('remember_token', $serializedUser);
    }

    // Test for password hashing
    public function test_password_is_hashed_when_creating_user()
    {
        $user = User::factory()->create(['password' => 'password']);

        $this->assertTrue(Hash::check('password', $user->password));
        $this->assertNotEquals('password', $user->password);
    }
}
