<div class="list-group">
	<div class="panel panel-default">
		<div class="panel-heading">{{ trans2("A104", "Setting") }}</div>
		<div class="panel-body">
			<a href="/profile" class="list-group-item">{{ trans2("A105", "profile") }}</a>
			<a href="/my-cart" class="list-group-item">{{ trans2("A106", "cart items") }}</a>
            <a href="/profile/edit-my-information" class="list-group-item">{{ trans2("A107", "Update my information") }}</a>
			<a href="/pay-requests" class="list-group-item">{{ trans2("A108", "Pay requests") }}</a>
		</div>
	</div>
</div>

<script type="text/javascript">
	$(document).ready(function(){
		navLinkActivation('/{{Request::path()}}');
	});
</script>