@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Questionaire</div>

                <div class="well panel-body">

                    @include('layouts.errors')
            
                    <form method="POST" action="/questionaire">

                        {{ csrf_field() }}

                        @if ($questions)
                            <ol class="list-group">
                                @foreach ($questions as $q)
                                    <?php $x = $loop->iteration ?>
                                    <li>
                                        @include('questionaire.question')
                                    </li>
                                @endforeach
                            </ol>
                        @endif

                        <button type="submit" class="btn btn-primary">Submit</button>

                    </form>    
                </div>
            </div>
        </div>
    </div>
</div>
@endsection