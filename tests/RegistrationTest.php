<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class RegistrationTest extends TestCase
{
    use DatabaseTransactions;

    public function testNewUserRegistration()
    {
        $this->visit('/users/register')
            ->type('John Doe', 'name')
            ->type('john_doe@email.com', 'email')
            ->type('secret', 'password')
            ->type('secret', 'password_confirmation')
            ->press('Submit')
            ->seePageIs('/about');
    }

}
