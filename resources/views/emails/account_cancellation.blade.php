@extends('beautymail::templates.minty')

@section('content')

	@include('beautymail::templates.minty.contentStart')
		<tr>
			<td class="title">
				Account Cancellation
			</td>
		</tr>
		<tr>
			<td width="100%" height="10"></td>
		</tr>
		<tr>
			<td class="paragraph">
  			 <p>An Account was cancelled for the following user:</p>
         <p><b>Name:</b> {{$user->name}}</p>
         <p><b>Organization:</b> {{$user->org_name}}</p>
         <p><b>Size:</b> {{$user->org_size}}</p>
         <p><b>Contact Email:</b> <a href='mailto:{{$user->email}}'>{{$user->email}}</a></p>
         <p><b>Cancellation Comments:</b> {{empty($comments) ? 'None':$comments}}</p>
			</td>
		</tr>

	@include('beautymail::templates.minty.contentEnd')

@stop
