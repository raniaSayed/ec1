<div id="append-new-tag" class="content">
	<div class="alert alert-danger errors-section" role="alert"></div>
	<div class="form-group">
		<label for="tagName">{{ trans2("A363", "tag name") }}</label>
		<div class="input-group">
	      <input name="tag_name" type="text" class="form-control" id="tagName" placeholder='{{ trans2("A364", "please set a tag") }}' autofocus="true">
	      <span class="input-group-btn">
	        <button class="btn btn-success set-tagName" type="button">{{ trans2("A365", "Set") }}</button>
	      </span>
	    </div>
	</div>
	<p class="success-message text-success">{{ trans2("A366", "Tag is appended successfuly.") }}</p>
	<div class="tags-container"><div>
</div>

<script type="text/javascript">
	var parent = $("#append-new-tag");

	parent.keypress(function (e) {
		var key = e.which;
		
		if(key == 13){
			parent.find(".set-tagName").click();
			return false;  
		}
	});  

	parent.find(".set-tagName").on("click", function(e){

		var data = {
			tag_name: $('input[name="tag_name"]').val()
		};

		$.ajax({
			url: '/admin/products/tags',
			type: 'POST',
			data: data,
			success: function(data){
				parent.find('.errors-section').slideUp(250).text("");
				parent.find('.success-message').slideDown(250).delay(2500).slideUp(250);
				parent.find('.tags-container').append("<span>" + data.tag_name + "</span> ");
			},
			error: function(data){
				parent.find('.errors-section').text(data.responseJSON.message).slideDown(250);
			}
		});
	}); 
</script>