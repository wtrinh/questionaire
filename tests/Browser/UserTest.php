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
    // public function testHomePage()
    // {
    //     $this->browse(function (Browser $browser) {
    //         $browser->visit('/')
    //                 ->assertSee('Behavior Questionaire');
    //     });
    // }

    /**
     * Test user registration
     *
     * @return void
     */
    public function testUserRegistration()
    {
        $this->browse(function ($browser) {
            $browser->visit('/register')
                    ->type('first_name', 'John')
                    ->type('last_name', 'Doe')
                    ->type('email', 'jdoe@example.com')
                    ->type('password', 'secret')
                    ->type('password_confirmation', 'secret')
                    ->press('Register')
                    ->assertPathIs('/questionaire');
        });
    }

    /**
     * Test user login successfully
     *
     * @return void
     */
    public function testUserLoginSuccessfully()
    {
        $user = User::first();

        $this->browse(function ($browser) use ($user) {
            $browser->visit('/login')
                    ->type('email', $user->email)
                    ->type('password', 'secret')
                    ->press('Login')
                    ->assertPathIs('/questionaire');
        });
    }

    // /**
    //  * Test user logging out
    //  *
    //  * @return void
    //  */
    // public function testUserLogout()
    // {
    //     $user = factory(User::class)->create();

    //     $this->browse(function ($browser) use ($user) {
    //         $browser->loginAs($user)
    //                 ->visit('/logout')
    //                 ->logout()
    //                 ->assertPathIs('/');
    //     });
    // }

    // /**
    //  * Test user answering the question
    //  *
    //  * @return void
    //  */
    // public function testUserAnsweringQuestions()
    // {
    //     $user = factory(User::class)->create();

    //     $this->browse(function ($browser) use ($user) {
    //         $browser->loginAs($user)
    //                 ->radio('question_1', '1')
    //                 ->radio('question_2', '4')
    //                 ->radio('question_3', '7')
    //                 ->press('Submit')
    //                 ->assertSee('Answers');
    //     });
    // }

}
