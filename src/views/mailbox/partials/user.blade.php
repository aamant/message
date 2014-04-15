<a href="{{url('mailbox/view/' . $sender->id)}}" class="list-group-item {{$sender->id == $current->id ?'active':''}}">
	<div class="row">
		<div class="col-xs-10">
			<img src="{{$sender->avatar}}" class="avatar">
			{{$fullname}}
		</div>
		<div class="col-xs-2">
			@if ($counter)
			<span class="badge">{{$counter}}</span>
			@endif
		</div>
	</div>
</a>