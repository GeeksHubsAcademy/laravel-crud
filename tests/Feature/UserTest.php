<?php

namespace Tests\Feature;

use App\UserDetail;
use App\User as User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Laravel\Passport\Passport;
use Tests\TestCase;

class UserTest extends TestCase
{
    use RefreshDatabase,WithFaker;
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
    public function testGetUserDetail()
    {
        // $this->withoutExceptionHandling();//log para errores
        $user = factory(User::class)->create();
        UserDetail::create([
            'field_shooting' => $this->faker->name,
            'licensed' => $this->faker->boolean,
            'user_id' => $user->id
        ]);
        Passport::actingAs($user);

        $response = $this->get('/api/user/detail');
        $response->assertStatus(200);
        $response->assertJson($user->load('user_detail')->toArray());
    }
}
