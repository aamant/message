@extends('layouts.master')

@section('title', 'Ma boite de réception')

@section('head')
	<link rel="stylesheet" href="{{asset('packages/aamant/message/css/message.css')}}">
	<meta http-equiv="cache-control" content="max-age=0" />
	<meta http-equiv="cache-control" content="no-cache" />
	<meta http-equiv="expires" content="0" />
	<meta http-equiv="expires" content="Tue, 01 Jan 1980 1:00:00 GMT" />
	<meta http-equiv="pragma" content="no-cache" />
	<meta name="robots" content="noindex,nofollow" />
@stop

@section('content')
	<div class="container container-white">
		<div class="row mailbox">
			<div class="col-sm-3 user-list">
				<div class="list-group">
					@foreach ($senders as $sender)
					@include('message::mailbox.partials.user', array('sender' => $sender))
					@endforeach
				</div>
			</div>
			<div class="col-sm-9 message-list">
				@if ($current)
				<div class="row">
					<div class="col-sm-12">
						<div class="">
							<textarea id="text-{{$user->id}}" rows="10" class="form-control"></textarea>
						</div>
						<div class="text-right">
							<br><a href="{{URL::route('message.send', $current->id)}}" type="button" class="btn btn-primary message" data-action="send" data-target="#text-{{$user->id}}">Envoyer</a>
						</div>
					</div>
				</div>
				<br>
				@endif
				<div class="list-group">
				@if (count($messages))
				@foreach ($messages as $message)
					@include('message::mailbox.partials.message')
				@endforeach
				@else
					<br><br><p class="font-big text-info">Vous n'avez reçu aucun messages</p>
				@endif
				</div>
			</div>
		</div>
	</div>
@stop

@section('bottom')
	<script src="{{asset('packages/aamant/message/message.js')}}"></script>
	<script>
		(function($){
			$('.message').message({'token' : '{{csrf_token()}}'})

			$('.readable').click( function() {

				var $this = $(this)
				var id = $this.attr('id');
				var url = $this.attr('data-href');

				$.ajax({
					method: 'POST',
					url: url,
					data: {'_token' : '{{csrf_token()}}'}
				})
				.done(function() {
					$this.removeClass("new")
				});
			});

		})(jQuery);
	</script>
@stop