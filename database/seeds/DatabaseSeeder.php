<?php

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
use App\Question;
use App\Choice;

class DatabaseSeeder extends Seeder
{

	protected $questionaire = [['question' => 'What did you eat today for breakfast?',
	    						'choices' => ['Egg', 'Cereal', 'Toast']],
	    						['question' => 'What did you eat today for lunch?',
	    						'choices' => ['Sandwich', 'Salad', 'Pizza']],
	    						['question' => 'What did you eat today for dinner?',
	    						'choices' => ['Steak', 'Pasta', 'Burrito']]];

					
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        foreach ($this->questionaire as $q) {
        	$question = Question::create(['question' => $q['question']]);
        	foreach ($q['choices'] as $c) {
        		$choice = new Choice();
        		$choice->choice = $c;
        		$question->choices()->save($choice);
        	}
        }
    }
}
