@if(count($errors) > 0)
	@foreach($errors->all() as $error)
		<?php Flash::error($error); ?>
	@endforeach
@endif