<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class ConstantsTest extends TestCase
{
    use DatabaseTransactions;

    public function testTitleAboutPage()
    {
        $this->visit('/about')
            ->see(Config::get('constants.site.title'));
    }

}
