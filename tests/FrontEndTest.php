<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class FrontEndTest extends TestCase
{
    /**
     * Test home page.
     *
     * @return void
     */
    public function testHomePage()
    {
        $this->visit('/')
             ->see('North London Yoga');
    }

    public function testMenu()
    {
        $this->visit('/')
            ->click('About Yoga Ground')
            ->see('About Kevin Saunders');

        $this->visit('/')
            ->click('Lessons')
            ->see('I run regular yoga classes on');

        $this->visit('/')
            ->click('Workshops')
            ->see('Workshops');

        $this->visit('/')
            ->click('Testimonials')
            ->see('Lorraine');

        $this->visit('/')
            ->click('One to ones')
            ->see('One to one lessons');
    }

    public function testContact()
    {
        $this->visit('/contact')
            ->see('Contact Me');

        $this->visit('/contact')
            ->press('Submit')
            ->see('The name field is required');

        $this->visit('/contact')
            ->type('Taylor', 'name')
            ->type('t@t.com', 'email')
            ->type('unit test', 'comments')
            ->press('Submit')
            ->see('Thanks for contacting me');
    }
}