@if(count($members) > 0)
	@foreach($members as $member)
		<li>
		<!-- <a href="{{ url('member/'.$member->id) }}" style='color:red'>{{ $member->name }} {{ $member->type }}</a> -->
		<a data-id="{{ $member->id }}" class="btn btn-primary btnEdi">{{ $member->type }} {{ $member->mode }}</a>
		</li>
	@endforeach
@else
	<li>No Results Found</li>
@endif



