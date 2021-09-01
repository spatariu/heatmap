<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\User;


class LinkTest extends TestCase {
    
    use WithFaker;

    /**
     * Login test.
     *
     * @return void
     */
    public function testLogin() {
        $userData = [
            'email' => 'api@gmail.com',
            'password' => 'emag1234',
        ];

        $this->json('POST', 'api/login', $userData, ['Accept' => 'application/json'])
                ->assertStatus(200)
                ->assertJsonStructure([
                    "access_token"
        ]);
    }
    
    /**
     * Add link test.
     *
     * @return void
     */
//    public function testCreateLink() {
//        $user = User::factory()->create();
//        $this->actingAs($user, 'api');
//        $userData = [
//            'link' => 'htttps:/www.emag.ro',
//            'link_type' => 'homepage',
//            'user_id' => 1
//        ];
//
//        $this->json('POST', 'api/links', $userData, ['Accept' => 'application/json'])
//                ->assertStatus(201)
//                ->assertJsonStructure([
//                    "message"
//        ]);
//    }

}
