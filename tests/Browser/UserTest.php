<?php

namespace Tests\Browser;

use Tests\DuskTestCase;
use Laravel\Dusk\Browser;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Database\Seeds\DatabaseSeeder;

use App\User;
use App\Question;
use App\Choice;

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
     * Test user logging out
     *
     * @return void
    */ 
    public function testUserLogout()
    {
        $user = factory(User::class)->create();

        $this->browse(function ($browser) use ($user) {
            $browser->loginAs($user)
                    ->visit('/logout')
                    ->logout()
                    ->assertPathIs('/');
        });
    }

    /**
     * Test user login successfully
     *
     * @return void
     */
    public function testUserLoginSuccessfully()
    {
        $user = factory(User::class)->create();

        $this->browse(function ($browser) use ($user) {
            $browser->visit('/login')
                    ->type('email', $user->email)
                    ->type('password', 'secret')
                    ->press('Login')
                    ->assertPathIs('/questionaire')
                    ->logout();
        });
    }

    /**
     * Test user answering the question
     *
     * @return void
     */
    public function testUserLoginAndAnswerQuestions()
    {
        $user = factory(User::class)->create();
        $question = factory(Question::class, 3)->create()->each(function($q){
            factory(Choice::class, 3)->create(['question_id' => $q->id]);
        });

        $this->browse(function ($browser) use ($user) {

            $firstChoice = Question::find(1)->choices()->first();
            $secondChoice = Question::find(2)->choices()->first();
            $thirdChoice = Question::find(3)->choices()->first();

            $browser->visit('/login')
                    ->type('email', $user->email)
                    ->type('password', 'secret')
                    ->press('Login')
                    ->radio('question_1', $firstChoice->id)
                    ->radio('question_2', $secondChoice->id)
                    ->radio('question_3', $thirdChoice->id)
                    ->press('Submit')
                    ->assertSee('Answers');
        });
    }

}
