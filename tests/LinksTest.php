<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class LinksTest extends TestCase
{
    use DatabaseTransactions;

    public function testLinksAboutPage()
    {
        $this->visit('/about')
            ->click('Home')
            ->see('Building Practical Applications')
            ->onPage('/');

        $this->visit('/about')
            ->click('Blog');

        $this->visit('/about')
            ->click('Contact')
            ->see('Submit a new ticket')
            ->onPage('contact');

        $this->visit('/about')
            ->click('Dropdown')
            ->see('Login');
    }

}
