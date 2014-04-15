@if ($user->id == $message->from->id)
<div id="{{$message->id}}" class="list-group-item">
@else
<div id="{{$message->id}}" class="list-group-item {{$message->status}} readable" data-href="{{route('mailbox.update', $message->id)}}">
@endif
	<div class="row">
		<div class="col-xs-6">
			<img src="{{$message->from->avatar}}" class="avatar">
			{{$fullname}}
		</div>
		<div class="col-xs-6">
			<div class="text-right"><small>{{$message->to_id == $user->id? 'Reçu':'Envoyé'}} le {{$message->created_at->format('d-m-Y H:i:s')}}</small></div>
		</div>
	</div>
	<br>
	<div class="row">
		<div class="col-sm-11 col-sm-offset-1">
			{{$message->content}}
		</div>
	</div>
</div>