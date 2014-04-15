<div class="modal-header">
	<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
		<h4 class="modal-title">
			<img src="{{asset($current->avatar)}}" alt="{{{$fullname}}}">
			{{{$fullname}}}
		</h4>
</div>
<div class="modal-body">
	<textarea name="text-{{$current->id}}" id="text-{{$current->id}}" rows="10" class="form-control"></textarea>
	<br>
	<div class="message-list">
		<div class="list-group">
		@if (count($messages))
		@foreach ($messages as $message)
			@include('message::mailbox.partials.message')
		@endforeach
		@endif
		</div>
	</div>
</div>
<div class="modal-footer">
	<button type="button" class="btn btn-default" data-dismiss="modal">Annuler</button>
	<a href="{{URL::route('message.send', $current->id)}}" type="button" class="btn btn-primary message" data-action="send" data-target="#text-{{$current->id}}">Envoyer</a>
</div>
<script>
	$('.message').message({'token' : '{{csrf_token()}}'});
</script>