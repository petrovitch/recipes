<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class NewTicketTest extends TestCase
{
    use DatabaseTransactions;

    public function testSubmitNewTicket()
    {
//        $this->visit('/contact')
//            ->type('Title', 'title')
//            ->type('Sample Content', 'content')
//            ->press('SUBMIT')
//            ->see('Your ticket has been created!')
//            ->onPage('contact');
    }

}
