@extends('beautymail::templates.minty')

@section('content')

	@include('beautymail::templates.minty.contentStart')
		<tr>
			<td class="title">
				There's a Document Awaiting Your Signature!
			</td>
		</tr>
		<tr>
			<td width="100%" height="10"></td>
		</tr>
		<tr>
			<td class="paragraph">
  			 <h3>Hey {{ucwords($model->name)}}!</h3>
				 <p>We wanted to let you know that there is still document that requires your signature for {{ucwords($org_name)}}
           <br>
           You can do this from your phone or computer, whichever is easiet. Once click and done!
         </p>
				 <br>
				 <p>Best, <br> IAGREEK Support Team </p>

			</td>
		</tr>

	@include('beautymail::templates.minty.contentEnd')

@stop
