<div id="create-category" class="content">
	<div class="alert alert-danger errors-section" role="alert"></div>
	{!! Form::open(["url"=>"/admin/products/categories"]) !!}
		<div class="form-group">
	    	{!! Form::label("", trans2("A293", "category name"), ["class"=>"text-primary"]) !!}
	    	{!! Form::text('name', '', ['class'=>"form-control cat-name input-xlg", "dir"=>"auto"]) !!}
		</div>
		{!! Form::hidden('table_number', $_GET['table_number']) !!}
		{!! Form::hidden('related_id', $_GET['related_id']) !!}
		<button type="submit" class="btn btn-primary">{{ trans2("A294", "Save changes") }}</button>
	{!! Form::close() !!}
	<p class="success-message text-success">{{ trans2("A295", "category was created successfuly") }}</p>
</div>

<script type="text/javascript">
	var parent = $('#create-category');
	var input = parent.find('input.cat-name');

	parent.find(':submit').on('click', function(e){

		// stop form submitting
		e.preventDefault();

		var datastring = parent.find('form').serialize();

		$.ajax({
			url: '/admin/products/categories',
			type: 'post',
			data: datastring,
			success: function(data){
				parent.find('.errors-section').slideUp(250).text("");
				parent.find('.success-message').slideDown(250).delay(2500).slideUp(250);
				parent.find(':text[name="name"]').val('');

				data.table_number = parseInt(data.table_number) + 1;

				if(data.table_number < 5){
					$('<li>\
						<a href="#" onclick="return false">' + data.name + '</a>\
						<ul>\
							<a class="btn btn-default btn-xs" data-toggle="modal" data-target="#Modal" data-remote="false" data-cat-num="' + data.table_number + '" data-related-id="' + data.id + '">\
								<span class="glyphicon glyphicon-plus" aria-hidden="true"></span> {{ trans2("A296", "append new") }}\
							</a>\
						</ul>\
					').insertBefore(window.current_append_btn);
				} else {
					$('<li><a href="#" onclick="return false">' + data.name + '</a>\
					').insertBefore(window.current_append_btn);
				}	
			},
			error: function(data){
				$.each(data.responseJSON, function(i, item) {
				    parent.find('.errors-section').html(item.join('<br>')).slideDown(250);
				})
			}
		})
	});
</script>