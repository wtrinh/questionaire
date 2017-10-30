<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Question;
use App\Answer;

class QuestionaireController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
        $this->questions = Question::all();
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
    	$questions = $this->questions;

        return view('questionaire.index', compact('questions'));
    }

    /**
		* Saving user's answers to database, redirect to thank you page
    */

    public function store()
    {
    	/* making sure all questions are answered */
    	$this->validate(request(), $this->questionList());
    	Answer::store();
    	$questionsAndAnswers = Answer::getAnswersFromUser(request()->user()->id)->toArray();
    	//dd($questionsAndAnswers);
        return view('questionaire.result', compact('questionsAndAnswers'));
    }

    /* generate a list of required questions */
    private function questionList()
    {
    	$requiredQuestions = [];

    	for ($x = 1; $x <= count($this->questions); $x++) {
    		$requiredQuestions[ config('constants.questionInputPrefix') . $x] = 'required';
    	}

    	return $requiredQuestions;
    }
}
