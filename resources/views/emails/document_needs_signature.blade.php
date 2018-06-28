@extends('beautymail::templates.minty')

@section('content')

	@include('beautymail::templates.minty.contentStart')
		<tr>
			<td class="title">
				You Have A Document To Sign!
			</td>
		</tr>
		<tr>
			<td width="100%" height="10"></td>
		</tr>
		<tr>
			<td class="paragraph">
  			 <h3>Hey {{ucwords($model->name)}}!</h3>
				 <p>We wanted to let you know that there a document that requires your signature for {{ucwords($org_name)}}
           <br>
           You can do this from your phone or computer, whichever is easiet. One click and done!
					 <br>
					 <a href="{{$_ENV['SIGN_URL']}}"> Click Here to Login </a>
         </p>
				 	<a href="{{$_ENV['SIGN_URL']}}"> {{$_ENV['SIGN_URL']}} </a>
				 <br>
				 <p>Best, <br> IAGREEK Support Team </p>

			</td>
		</tr>

	@include('beautymail::templates.minty.contentEnd')

@stop
