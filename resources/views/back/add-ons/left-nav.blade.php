<?php
	$pendingRequestsCount = App\Models\CartItem::where('status', 0)->count();
	$acceptedRequestsCount = App\Models\CartItem::where('status', 2)->count();
?>

<div class="list-group">
	<button class="resize-btn btn expanded">resize</button>
	
	<div class="panel panel-default">
		<div class="panel-heading">
			<span class="icomoon-gears"></span>
			<span class="des">{{ trans2("A181", "::products setting", ["products"=>"products"]) }}</span>
            <a href="#" class="btn btn-default btn-xs pull-right slide-toggle" title="slide toggle">
                <span class="glyphicon glyphicon-chevron-up"></span>
            </a>
		</div>
		<div class="panel-body">
			<a href="/admin" class="list-group-item" data-toggle="tooltip" data-placement="right" title='{{ trans2("A182", "dashboard") }}'> 
				<span class="icomoon-dashboard"></span> 
				<span class="des">{{ trans2("A182") }}</span>
			</a>
			<a href="/admin/products" class="list-group-item" data-toggle="tooltip" data-placement="right" title='{{ trans2("A183", "all ::products (backend)", ["products"=>"products"]) }}'>
				<span class="icomoon-items"></span>
				<span class="des">{{ trans2("A183", null, ["products"=>"products"]) }}</span>
			</a>
			<a href="/admin/products/create/step/1" class="list-group-item" data-toggle="tooltip" data-placement="right" title='{{ trans2("A184", "Create a new ::product", ["product"=>"product"]) }}'>
				<span class="icomoon-paper-add"></span>
				<span class="des">{{ trans2("A184", null, ["product"=>"product"]) }}</span>
			</a>
			<a href="/admin/products/categories" class="list-group-item" data-toggle="tooltip" data-placement="right" title='{{ trans2("A185", "categories (CRUD)") }}'>
				<span class="icomoon-branch"></span>
				<span class="des">{{ trans2("A185") }}</span>
			</a>
			<a href="/admin/products/carousel" class="list-group-item" data-toggle="tooltip" data-placement="right" title='{{ trans2("A186", "carousel (CRUD)") }}'>
				<span class="icomoon-gallery"></span>
				<span class="des">{{ trans2("A186") }}</span>
			</a>
			<a href="/admin/products/tags" class="list-group-item" data-toggle="tooltip" data-placement="right" title='{{ trans2("A187", "tags (CRUD)") }}'>
				<span class="icomoon-tags"></span>
				<span class="des">{{ trans2("A187") }}</span>
			</a>
		</div>
	</div>
	<div class="panel panel-default">
		<div class="panel-heading">
			<span class="icomoon-gears"></span>
			<span class="des">{{ trans2("A188", "clients setting") }}</span>
            <a href="#" class="btn btn-default btn-xs pull-right slide-toggle" title="slide toggle">
                <span class="glyphicon glyphicon-chevron-up"></span>
            </a>
		</div>
		<div class="panel-body">
			<a href="/admin/review-cart/pending-requests" class="list-group-item" data-toggle="tooltip" data-placement="right" title='{{ trans2("A189", "pending requests") }}'>
				<span class="icomoon-cart pending"></span>
				<span class="des">
					{{ trans2("A190", "cart items") }} ({{ trans2("A189") }})
					<span class="badge pull-right">{{ $pendingRequestsCount }}</span>
				</span>
			</a>
			<a href="/admin/review-cart/accepting-requests" class="list-group-item" data-toggle="tooltip" data-placement="right" title='{{ trans2("A191", "accepted requests") }}'>
				<span class="icomoon-cart accepted"></span>
				<span class="des">
					{{ trans2("A190") }} ({{ trans2("A191") }})
					<span class="badge pull-right">{{ $acceptedRequestsCount }}</span>
				</span>
			</a>
			<a href="/admin/clients/users/accounts" class="list-group-item" data-toggle="tooltip" data-placement="right" title='{{ trans2("A192", "users accounts") }}'>
				<span class="icomoon-users-crowd"></span>
				<span class="des">{{ trans2("A192") }}</span>
			</a>
			<a href="/admin/clients/admins/accounts" class="list-group-item" data-toggle="tooltip" data-placement="right" title='{{ trans2("A193", "admins accounts") }}'>
				<span class="icomoon-admin"></span>
				<span class="des">{{ trans2("A193") }}</span>
			</a>
		</div>
	</div>
    <div class="panel panel-default">
        <div class="panel-heading">
            <span class="icomoon-gears"></span>
            <span class="des">{{ trans2("A194", "Multiple control") }}</span>
            <a href="#" class="btn btn-default btn-xs pull-right slide-toggle" title="slide toggle">
                <span class="glyphicon glyphicon-chevron-up"></span>
            </a>
        </div>
        <div class="panel-body">
            <a href="/admin/translations" class="list-group-item" data-toggle="tooltip" data-placement="right" title='{{ trans2("A195", "Translations (CRUD)") }}'>
                <span class="icomoon-translation"></span>
                <span class="des">{{ trans2("A195") }}</span>
            </a>
        </div>
    </div>
	@if($personType == "super_admin")
		<div class="panel panel-default">
			<div class="panel-heading">
				<span class="icomoon-gears"></span>
				<span class="des">{{ trans2("A196", "super admin setting") }}</span>
                <a href="#" class="btn btn-default btn-xs pull-right slide-toggle" title="slide toggle">
                    <span class="glyphicon glyphicon-chevron-up"></span>
                </a>
			</div>
		  	<div class="panel-body">
		  		<a href="/admin/super-admin/edit" class="list-group-item" data-toggle="tooltip" data-placement="right" title='{{ trans2("A197", "edit my information") }}'>
		  			<span class="icomoon-paper-edit"></span>
		  			<span class="des">{{ trans2("A197") }}</span>
		  		</a>
		    	<a href="/admin/clients/admins/accounts/create" class="list-group-item" data-toggle="tooltip" data-placement="right" title='{{ trans2("A198", "add & set admins with permissions") }}'>
		    		<span class="icomoon-lock"></span>
		    		<span class="des">{{ trans2("A198") }}</span>
		    	</a>
				<a href="/admin/site-setting" class="list-group-item" data-toggle="tooltip" data-placement="right" title='{{ trans2("A199", "site setting") }}'>
					<span class="icomoon-gears"></span>
					<span class="des">{{ trans2("A199") }}</span>
				</a>
		  	</div>
		</div>
	@endif
</div>

<script type="text/javascript">
	$(document).ready(function(){
		navLinkActivation('/{{Request::path()}}');
		leftnav_resize_status($('.resize-btn'), "{{ Session::has('leftnav_resize_status') }}", "{{ Session::get('leftnav_resize_status') }}");

		$('.resize-btn').click(function(){
			var _this = $(this);
			var leftNav = $("#left-nav");
			var content = $("#content");
			var status = leftNav.hasClass('col-md-3');

            console.log(status);

			leftNav.toggleClass('col-md-3 col-md-1');
			content.toggleClass('col-md-9 col-md-11');

			if(status) {
				leftNav.find(".des").hide();
				leftNav.find(".list-group-item").css("text-align", "center");
				leftNav.find(".panel-heading")
                    .css("text-align", "center").end()
                    .find('.slide-toggle').hide();
				tooltip_status('show');
			} else {
				leftNav.find(".des").fadeIn(200);
				leftNav.find(".list-group-item").css("text-align", "left");
				leftNav.find(".panel-heading")
                    .css("text-align", "left").end()
                    .find('.slide-toggle').show();
				tooltip_status('hide');
			}

			// send to controller to set new status ib session
			$.ajax({
				url: "/requesting/ajax/backend-leftnav-status",
				type: "post",
				data: { status: status }
			})
		});
	});
</script>
