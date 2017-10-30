{{ $q->question }}

<ul class="list-unstyled">
	@foreach ($q->choices as $choice) 
		<li>	
			<div class="form-group"> 
				{!! Form::radio('question_'.$x ,$choice->id) !!} {{ $choice->choice }}
			</div>
		</li>	
	@endforeach
</ul>
