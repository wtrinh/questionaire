@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Questionaire</div>
                <div class="well panel-body">
                    Thanks for answering our questions. Below are your answers:

                    <ol>
                        @foreach ($questionsAndAnswers as $questionAndAnswer)
                            <li>
                                Question: {{ $questionAndAnswer->question }}
                                <br />
                                Answer: {{ $questionAndAnswer->answer }}
                            </li>
                        @endforeach
                    </ol>    
                </div>
            </div>
        </div>
    </div>
</div>
@endsection