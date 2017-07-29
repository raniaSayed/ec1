@extends('back.master')
@section('title', trans2('A381', "edit ::product", ["product"=>"product"]))

@section('content')
	<div id="product-edit-page">
		@include('includes.flash-message')
		@include('includes.back-error')

		<div id="warning-alert" class="alert alert-warning alert-dismissible" role="alert" style="display: none">
		  	<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
		  	<span class="glyphicon glyphicon-info-sign"></span>
		  	<span class="body"></span>
		</div>

		<div class="panel panel-default">
			<div class="panel-heading">
				<span class="product-name">{{ $product->name }}</span>
				<a href="{{ route('admin.products..show', $product->id) }}" class="btn btn-default btn-sm pull-right">
					{{ trans2("A382", "show ::product", ["product"=>"product"]) }} &nbsp;
					<span class="glyphicon glyphicon-eye-open"></span>
				</a>
				@include('standers.add-ons.live-status-btn')
				@include('standers.add-ons.carousel-status-btn')
				@include('standers.add-ons.new-product-status-btn')
			</div>
			<div class="panel-body">
				<div id="product-edit">
					{!! Form::open(["url"=>"/admin/products/$product->id", "method"=>"PATCH", "files"=>"true"]) !!}
						<div class="form-group">
							{!! Form::label("productName", trans2("A383", "::product name", ["product"=>"product"])) !!}
							{!! Form::text("product_name", $product->name, ["class"=>"form-control input-xlg", "id"=>"productName"]) !!}
						</div>
						<div class="form-group">
							{!! Form::label("productDescription", trans2("A384", "::product description", ["product"=>"product"])) !!}
							{!! Form::textarea("product_description", $product->description, ["class"=>"form-control input-lg", "id"=>"productDescription", "rows"=>"5"]) !!}
						</div>
						<div class="form-group serial-number">
							{!! Form::label("", trans2("A385", "serial number")) !!}
							<div class="input-group">
								{!! Form::text("serial_number", $product->serial_number, ["class"=>"form-control serial-number"]) !!}
							    <span class="input-group-addon">
							    	<a href="#" class="generate">{{ trans2("A386", "generate") }}</a>
							    </span>
							</div>
						</div>
						<hr>
						<div class="form-group" id="categories" data-max-categories="{{ count($product_trueCats) }}">
							<label>{{ trans2("A387", "categories") }}</label>

								<?php $category_id = "" ?>

								@if($product_categories_list != "empty")
									<p>my list is: <?= implode('</span> -> <span>', $product_categories_list) ?></p>
								@endif

								<p><u>please choose new category tree:</u></p>

								<?php $i = 0; $counter = 1; ?>
								@foreach($product_trueCats as $arr)
									<select name="p_cat{{$counter}}" class="form-control p-cat" data-table-num="{{ $counter }}">
										<option value="0" selected>{{ trans2("A388", "choose something...") }}</option>
										@foreach($arr as $cat)
											<option value="{{ $cat->id }}"
												@if(isset($product_categories_list[$i]) && $product_categories_list[$i] == $cat->name)
													selected
													<?php $i++; $category_id = $cat->id ?>
												@endif>
												{{ $cat->name }}
											</option>
										@endforeach
									</select>
									<?php $counter++ ?>
								@endforeach

								{!! Form::hidden("category_id", $category_id, ["class"=>"category-id"]) !!}
								{!! Form::hidden("category_table_number", $i, ["class"=>"cat-table-number"]) !!}
						</div>
						<hr>
						<div class="row">
			        		<div class="col-md-5">
			        			<div class="form-group">
									{!! Form::label("productPrice", trans2("A389", "price")) !!}
									<span class="text-danger">*</span>
									<div class="input-group">
										{!! Form::text("product_price", $product->price . ".00", ["class"=>"form-control price input-xlg", "id"=>"productPrice", "style"=>"color: green"]) !!}
										<snap class="input-group-addon">trans2("A390", "USD")</snap>
									</div>				
								</div>
			        		</div>							        		
			        		<div class="col-md-3">
			        			<div class="form-group">
									{!! Form::label("priceDiscount", trans2("A391", "discount percenage of price")) !!}
									<div class="input-group">
								      {!! Form::text("discount_percentage", $product->discount_percentage, ["class"=>"form-control discount-percentage input-xlg", "id"=>"priceDiscount", "maxlength"=>"3", "style"=>"color: #EF6C00"]) !!}
								      <snap class="input-group-addon">%</snap>
								    </div>
								</div>
			        		</div>
			        		<div class="col-md-4">
			        			<div class="form-group">
									{!! Form::label("discountedPrice", trans2("A392", "discounted price")) !!}
								    {!! Form::text("", number_format($product->discountPrice, 2), ["class"=>"form-control discounted-price input-xlg", "id"=>"discountedPrice"]) !!}
								</div>
			        		</div>					
			        	</div>
						<div class="form-group start-at">
							{!! Form::label("productAmount", trans2("A393", "amount")) !!}
							{!! Form::text("product_amount", $product->amount, ["class"=>"form-control", "id"=>"productAmountText"]) !!}
							<div class="checkbox">
								<label>
									{!! Form::hidden("is_amount_unlimited", 0) !!}
									{!! Form::checkbox("is_amount_unlimited", $product->is_amount_unlimited, $product->is_amount_unlimited ? 'checked' : null, ["class"=>"checkbox", "id"=>"productAmountStatus"]) !!}
									<b>{{ trans2("A394", "is unlimited amount?") }}</b>
								</label>
							</div>
						</div>
						<hr>
						<div class="row">
							<div class="col-md-5">
								<div class="form-group start-at">
									{!! Form::label("startAtData", trans2("A395", "start viewing at")) !!}
									{!! Form::date("start_at", date("Y-m-d", $product->start_at), ["class"=>"form-control", "id"=>"startAtData"]) !!}
									<div class="checkbox">
										<label>
											{!! Form::hidden("is_start_view_now", 0) !!}
											{!! Form::checkbox("is_start_view_now", 1, "checked", ["class"=>"checkbox", "id"=>"startAtStatus"]) !!}
											<span>{{ trans2("A396", "or start now") }}</span>
										</label>
									</div>				
								</div>	
							</div>
							<div class="col-md-7">
								<?php 
									if($product->is_forever)
										$forever_activation = null;
									else
										$forever_activation = "active";
								?>
								<div class="form-group expires-condition">
									<label>{{ trans2("A397", "expires condition") }}</label>
									<div class="section">
										<div class="radio">
											<label>
												{!! Form::radio("expires_condition", "expires_at", $product->is_forever ? null : " checked", ["class"=>"checkbox"]) !!}
                                                <span>{{ trans2("A398", "expire viewing at") }}</span>
											</label>
										</div>
										{!! Form::date("expires_at", $product->is_forever ? null : date("Y-m-d", $product->expires_at), ["class"=>"form-control expires-at $forever_activation"]) !!}
									</div>
									<div class="section">
										<div class="radio">
											<label>
                                                {!! Form::radio("expires_condition", "by_days", null, ["class"=>"checkbox"]) !!}
                                                <span>
                                                    {{ trans2("A399", "or expires after") }}
                                                    <input class='wid-100 expires-days' name='expires_days' type='text' disabled>
                                                    {{ trans2("A400", "days from today ::today", ["today"=>date("d/m/Y", time())]) }}
                                                </span>
											</label>
										</div>
									</div>
									<div class="section">
										<div class="radio">
											<label>
												{!! Form::radio("expires_condition", "unlimited_expires", $product->is_forever ? "checked" : null, ["class"=>"checkbox"]) !!}
                                                <span>{{ trans2("A401", "or unlimited expires?") }}</span>
                                            </label>
										</div>
									</div>
								</div>
							</div>
						</div>
						<hr>
						<div id="tags">
				        	<div class="form-group">
								{!! Form::label("", trans2("A402", "Look for local tags")) !!} 
								&nbsp; [<a href="{{ route('APT.view-append-modal') }}" data-toggle="modal" data-target="#Modal" data-remote="false">{{ trans2("A403", "append new tags") }}</a>]
								{!! Form::text("", "", ["class"=>"form-control tags_searcher"]) !!}
							</div>
							{!! Form::label("", "current tags") !!} 
							<div class="well p-tags">
								@foreach($products_tags as $id => $tag)
									<button type="button" class="btn btn-default btn-sm static-tags-btn saved-tag" data-id="{{ $id }}">{{ $tag }}</button>
									<?php $tags_ids[] = $id ?>
								@endforeach
								{!! Form::hidden("product_tags_ids", isset($tags_ids) > 0 ? implode(",", $tags_ids) : '') !!}
							</div>
							<p class="loading-text" style="display: none">{{ trans2("A404", "loading...") }}</p>
						</div>
						<hr>
						<div class="images">
							<h3>{{ trans2("A405", "images") }} 
                                <small><a href="#" data-toggle="modal" data-target="#ImageModal" data-remote="false">{{ trans2("A406", "edit") }}</a></small>
                            </h3>
							<div id="zoomwall1" class="zoomwall images">
								@if(count($product->images) > 0)
									@foreach($product->images as $image)
										<img class="image-context" src='{{ asset("uploaded/products/images/full_size/$image") }}' data-name="{{ $image }}">
									@endforeach
								@else
									<img src='{{ asset("assets/images/no-image.png") }}'>
								@endif
							</div>
						</div>
                        <div class="carousels">
                            <h3>{{ trans2("A407", "carousel") }}  <small><a href="#" data-toggle="modal" data-target="#CarouselModal" data-remote="false">{{ trans2("A408", "edit") }} </a></small></h3>
                            <div id="zoomwall2" class="zoomwall carousels">
                                @if(count($product->carousels) > 0)
                                    @foreach($product->carousels as $carousel)
                                        <img class="carousel-context" src='{{ asset("uploaded/products/carousel_gallery/small/$carousel") }}' data-name="{{ $carousel }}">
                                    @endforeach
                                @else
                                    <img src='{{ asset("assets/images/no-image.png") }}'>
                                @endif
                            </div>
                        </div>
						<hr>
						<div class="form-group">
							<div class="checkbox">
								<label>
									{!! Form::hidden("is_payment_on_delivery", 0) !!}
									{!! Form::checkbox("is_payment_on_delivery", 1, $product->is_payment_on_delivery ? "checked" : null, ["class"=>"checkbox"]) !!}
									<b>{{ trans2("A409", "is support a payment on delivery?") }}</b>
								</label>
							</div>
							<div class="checkbox">
								<label>
									{!! Form::hidden("is_payment_by_paypal", 0) !!}
									{!! Form::checkbox("is_payment_by_paypal", 1, $product->is_payment_by_paypal ? "checked" : null, ["class"=>"checkbox"]) !!}
									<b>{{ trans2("A410", "is support a payment by paypal?") }}</b>
								</label>
							</div>
						</div>
						{!! Form::submit(trans2("A411", "update to database"), ["class"=>"btn btn-success"]) !!}
					{!! Form::close() !!}
				</div>
			</div>
		</div>

        <div id="product-images">
            <div class="modal fade" id="ImageModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
              <div class="modal-dialog">
                <div class="modal-content">
                  <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" id="myModalLabel">{{ trans2("A412", "Manage your images") }}</h4>
                  </div>
                  <div class="modal-body">
                    <div class="dropzone-image">
                        <label>{{ trans2("A413", "upload images") }} <span id="photoCounter-1"></span></label>
                        <div class="form-group">
                            <div class="droping">
                                {!! Form::open(['url' => route('image-upload'), 'class' => 'dropzone', 'files'=>true, 'id'=>'dropzone-1']) !!}
                                    {!! Form::hidden('upload_type', 'image') !!}
                                    {!! Form::hidden('parent_id', $product->id) !!}
                                    <div class="dz-message">
                                        <h3>{{ trans2("A414", "drop images in this area or click here") }}</h3>
                                    </div>
                                    <div class="fallback">
                                        <input name="file" type="file" multiple>
                                    </div>
                                    <div class="dropzone-previews" id="dropzonePreview-1"></div>
                                {!! Form::close() !!}
                            </div>
                            @include('standers.dropzone.preview-template')
                            <p class="help-block">{{ trans2("A415", "max images upload is ::max_images images", ['max_images' => config('sensorization.images.max_uploads')]) }}</p>
                        </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <div class="modal fade" id="CarouselModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
              <div class="modal-dialog">
                <div class="modal-content">
                  <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" id="myModalLabel">{{ trans2("A416", "Manage your carousels") }}</h4>
                  </div>
                  <div class="modal-body">
                    <div class="dropzone-image">
                        <label>{{ trans2("A417", "upload carousel") }} <span id="photoCounter-2"></span></label>
                        <div class="form-group">
                            <div class="droping">
                                {!! Form::open(['url' => route('carousel-upload'), 'class' => 'dropzone', 'files'=>true, 'id'=>'dropzone-2']) !!}
                                    {!! Form::hidden('upload_type', 'carousel') !!}
                                    {!! Form::hidden('parent_id', $product->id) !!}
                                    <div class="dz-message">
                                        <h3>{{ trans2("A418", "drop images in this area or click here") }}</h3>
                                    </div>
                                    <div class="fallback">
                                        <input name="file" type="file" multiple>
                                    </div>
                                    <div class="dropzone-previews" id="dropzonePreview-2"></div>
                                {!! Form::close() !!}
                            </div>
                            @include('standers.dropzone.preview-template')
                            <p class="help-block">{{ trans2("A419", "max carousel upload is ::max_carousel carousel", ['max_carousel' => config('sensorization.carousel.max_uploads')]) }}</p>
                        </div>
                    </div>  
                  </div>
                </div>
              </div>
            </div>
        </div>

        <div id="images-context-menu">
            <ul class="dropdown-menu" role="menu">
                <li><a tabindex="-1" data-method="set_primary">{{ trans2("A420", "set this image primary") }}</a></li>
                <li><a tabindex="-1" data-method="delete">{{ trans2("A421", "delete image") }}</a></li>
            </ul>
        </div>

        <div id="carousels-context-menu">
            <ul class="dropdown-menu" role="menu">
                <li><a tabindex="-1" data-method="set_primary">{{ trans2("A422", "set this carousel primary") }}</a></li>
                <li><a tabindex="-1" data-method="delete">{{ trans2("A423", "delete carousel") }}</a></li>
            </ul>
        </div>
	</div>

	<!-- Default bootstrap modal example -->
	@include('standers.modal')
@stop


@section('head-css')
	<link rel="stylesheet" type="text/css" href="./packages/zoomwall.js/zoomwall.css">
    <link rel="stylesheet" type="text/css" href="./packages/dropzone/dropzone.css">
@stop

@section('head-js')
	<script type="text/javascript" src="./packages/zoomwall.js/zoomwall.js"></script>
	<script>
		window.onload = function() {
			zoomwall.create(document.getElementById('zoomwall1'), true);
			zoomwall.create(document.getElementById('zoomwall2'), true);
		};
	</script>
@stop

@section('footer-js')
	<script type="text/javascript" src="./packages/Jquery-Price-Format/jquery.priceformat.min.js"></script>
	<script type="text/javascript">
		$(document).ready(function(){
			optimizeCategories();

			enable_disable_input($("#productAmountStatus"), $("#productAmountText"));
			enable_disable_input($("#startAtStatus"), $("#startAtData"));

			/* reapeted in create product step 1, please modify it later */

			$("#product-edit .form-group.expires-condition :input:not(:radio):not(.active)").attr("disabled", "disabled");

			$("#product-edit .form-group.expires-condition :radio").on("change", function(){
				var current_value = $(this).val();

				$(this).parents(".form-group").find(":input:not(:radio)").attr("disabled", "disabled");

				switch(current_value){
					case "expires_at":
						$(this).parents('.form-group').find(":input.expires-at").removeAttr("disabled");
					break;
					case "by_days":
						$(this).parents('.form-group').find(":input.expires-days").removeAttr("disabled");
					break;
					default:
						return false;
				}
			});

			$('#product-edit .serial-number a.generate').on("click", function(e){
				var _this = $(this);
				e.preventDefault();
				$.ajax({
					url: "/admin/products/create/generate-serial-number",
					type: "post",
					success: function(result){
						_this.parents('.form-group.serial-number').find("input.serial-number").val(result);
					}
				})
			});

			$('#product-edit input.price, #product-edit .discounted-price').priceFormat({
				prefix: ""
			});

			$("#product-edit .price, #product-edit .discount-percentage").on("keyup change", function(){
				var result;
				var price = $("#product-edit .price").unmask() / 100;
				var discount = $("#product-edit .discount-percentage").val() || 0;

				if(discount != 0){
					result = price - (price * (discount/100));
					result = result.toFixed(2);
				} else {
					result = price;
					result = result.toFixed(2);
				}

				$("#product-edit .discounted-price").val(result);
				$("#product-edit .discounted-price").priceFormat({
					prefix: ""
				});
			});

			$("#product-edit .discounted-price").on("keyup", function(){
				var discount;
				var discountedPrice = $(this).unmask() / 100;
				var price = $("#product-edit .price").unmask() / 100;

				if(price > 0){
					if(discountedPrice < price){
						discount = 100 * ( 1 - (discountedPrice/price));
						discount = discount.toFixed(2);
						$("#product-edit .discount-percentage").val(discount);
						$("#warning-alert").slideUp(300);
					} else {
						$("#warning-alert").slideDown(300).find(".body").html("<b>Warning !!</b>, Current price is less than discounted price!");
					}
				}
			});

			/* --------- */

			tags_searcher();

			tagModal([
				'{{ trans2("A424", "append new tag") }}'
			], null, null, null);
		})
	</script>

    <script type="text/javascript" src="./packages/bootstrap-contextmenu/bootstrap-contextmenu.js"></script>
    <script type="text/javascript">
        function contextmenu(selector, target, deleteRoutePath, type){
            $(selector).contextmenu({
                target: target, 
                onItem: function(context, e) {
                    var method = $(e.target).attr('data-method');
                    var filename = context.attr('data-name');

                    switch(method){
                        case 'delete':
                            if(confirm('Are you sure to delete?')){
                                $.ajax({
                                    url: deleteRoutePath,
                                    type: 'post',
                                    data: {
                                        id: filename
                                    },
                                    success: function(data){
                                        context.remove();
                                    }
                                });
                            }
                        break;
                        case 'set_primary':
                            $.ajax({
                                url: '/admin/products/'+type+'/set-primary',
                                type: 'get',
                                data: {
                                    product_id: {{ $product->id }},
                                    filename: filename
                                },
                                success: function(data){
                                    console.log(data);
                                }
                            })
                        break;
                        default:
                            return false;
                    }
                }
            });
        }

        contextmenu('.image-context', '#images-context-menu', '{{ route("image-remove") }}', 'image');
        contextmenu('.carousel-context', '#carousels-context-menu', '{{ route("carousel-remove") }}', 'carousel');
    </script>

    <script type="text/javascript" src="./packages/dropzone/dropzone.js"></script>  
    <script type="text/javascript" src="./assets/js/packages/dropzone-config.js"></script>
    <script type="text/javascript">
        $(document).ready(function () {
            dropzone(1, 'image');
            dropzone(2, 'carousel');
        });
    </script>
@stop
