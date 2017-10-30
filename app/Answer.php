<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use DB;
use App\Question;
use App\Choice;
use App\User;

class Answer extends Model
{

	protected $fillable = ['user_id', 'answer_id'];

	public function question()
  {
    return $this->belongsTo('App\User');
  }

	public static function store()
	{
		$user = User::find(request()->user()->id);

		foreach (request()->request as $key => $value) {
			
			if (strpos($key, config('constants.questionInputPrefix')) !== false) {
				$answer = new static;
        $answer->choice_id = $value;
        $user->answers()->save($answer);
			}
		}
	}

	public static function getAnswersFromUser($userId)
	{
		return DB::table('questions')
			->select('questions.question','choices.choice AS answer', 'answers.created_at AS answerTime')
			->join('choices', 'questions.id','=','choices.question_id')
			->join('answers', 'choices.id','=','answers.choice_id')
			->where('answers.user_id', '=', $userId)->get();
	}

}
