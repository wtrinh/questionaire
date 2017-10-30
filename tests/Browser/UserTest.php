<?php

namespace Tests\Browser;

use Tests\DuskTestCase;
use Laravel\Dusk\Browser;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use App\User;

class UserTest extends DuskTestCase
{
    use DatabaseMigrations;

    /**
     * Test home page
     *
     * @return void
     */
    public function testHomePage()
    {
        $this->browse(function (Browser $browser) {
            $browser->visit('/')
                    ->assertSee('Behavior Questionaire');
        });
    }

    /**
     * Test user login successfully
     *
     * @return void
     */
    public function testUserLoginSuccessfully()
    {
        $user = factory(User::class)->create(['email' => 'taylor@laravel.com']);

        $this->browse(function ($browser) use ($user) {
            $browser->visit('/login')
                    ->type('email', $user->email)
                    ->type('password', 'secret')
                    ->press('Login')
                    ->assertPathIs('/questionaire');
        });
    }

    /**
     * Test user registration
     *
     * @return void
     */
    public function testUserRegistration()
    {
        $user = factory(User::class)->create();

        $this->browse(function ($browser) use ($user) {
            $browser->visit('/register')
                    ->type('first_name', $user->first_name)
                    ->type('last_name', $user->last_name)
                    ->type('email', $user->email)
                    ->type('password', 'secret')
                    ->type('password_confirmation', 'secret')
                    ->press('Register')
                    ->assertPathIs('/questionaire');
        });
    }

}
