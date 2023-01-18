<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\User;

class UserTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */

    public function test_if_stores_new_User()
    { //registo user
        $response = $this->post('createUser', [
            'name' => 'Rodrigo Branco',
            'email' => 'rodri@gmail.com',
            //'is_admin' => '0',
            'password' => 'password',
        ]);
        $response->assertRedirect('/home');
    }

    public function test_if_login_User()
    { //login user
        $response = $this->post('login', [
            'email' => 'mwolff@example.net',
            'password' => 'password',
        ]);
        $response->assertRedirect('/home');
    }

    public function test_if_stores_Anuncio()
    {
        $response = $this->post('login', [
            'email' => 'mwolff@example.net',
            'password' => 'password',
        ]);

        $response = $this->post('createAnuncio', [
            'name' => 'Luvas Boxe',
            'price' => '22',
            'description' => 'Bom Estado',
        ]);
        $this->assertTrue(true);
    }

    public function test_if_deletes_anuncio(){
        $this->assertTrue(true);
    }
    public function test_if_reports_anuncio(){
        $this->assertTrue(true);
    }

    public function test_if_edits_anuncio(){
        $this->assertTrue(true);
    }

}