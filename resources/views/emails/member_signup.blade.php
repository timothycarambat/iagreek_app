@extends('beautymail::templates.minty')

@section('content')

	@include('beautymail::templates.minty.contentStart')
		<tr>
			<td class="title">
				You were signed up for IAGREEK!
			</td>
		</tr>
		<tr>
			<td width="100%" height="10"></td>
		</tr>
		<tr>
			<td class="paragraph">
  			 <h3>Hey There!</h3>
				 <p>We wanted to let you know that you were signed up by the account admin for <b>{{$org_name}}</b>.</p>
				 <p>This means that now instead of having to manually print and copy and send any signed documents is old news - using our service.
				 You can just <a>Sign In</a> and now sign these doucments online! </p>
				 <p>To get started you can <a>Click this link</a> and set your account password!</p>
				 <br>
				 <p>Now anytime you need to sign a document we will let you know via email and you can sign online!</p>

				 <br>
				 <p>Best, <br> IAGREEK Support Team </p>

			</td>
		</tr>

	@include('beautymail::templates.minty.contentEnd')

@stop
