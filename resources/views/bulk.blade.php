@extends('layouts.app')

@section('content')


<body>
	
<div class="container" style="margin-bottom:50px;">
<div>
	@if (request()->page != 1)
	<a href="?page={{request()->page - 1}}">
	<button class="btn btn-secondary">Back</button>
	</a>
	@endif
	@if (request()->page != $res[1])
	<a href="?page={{request()->page + 1}}">
	<button class="btn btn-primary">Next</button>
	</a>
	@endif
	<div class="btn-group">
    <button type="button" class="btn btn-primary dropdown-toggle" data-toggle="dropdown">Go
	    <span class="caret"></span>
	</button>
    <div class="dropdown-menu">
    	@for ($i = 1; $i <= $res[1]; $i++)
    		<a class="dropdown-item" href="?page={{$i}}">Page {{$i}}</a>
		@endfor
	    
	</div>
</div>
<div id="root" />
{!!$res[0]!!}
</div>
<div>
	@if (request()->page != 1)
	<a href="?page={{request()->page - 1}}">
	<button class="btn btn-secondary">Back</button>
	</a>
	@endif
	@if (request()->page != $res[1])
	<a href="?page={{request()->page + 1}}">
	<button class="btn btn-primary">Next</button>
	</a>
	@endif
</div>


</div>
</body>
@endsection