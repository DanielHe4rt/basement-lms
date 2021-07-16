<?php


namespace Tests\Feature\LMS\Auth\Http\Controllers;


use Tests\TestCase;

class ViewControllerTest extends TestCase
{
    public function testGuestCanViewRegisterPage()
    {
        // Act
        $response = $this->get(route('register'));

        // Assert
        $response->assertOk();
        $response->assertSee('Register');
    }

    public function testGuestCanViewLoginPage()
    {
        // Act
        $response = $this->get(route('login'));
        // Assert

        $response->assertOk();
        $response->assertSee('Login');
    }
}
