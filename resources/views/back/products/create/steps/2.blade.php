@extends('back.master')
@section('title', trans2("A332", "Admin c.p - Create ::product step 2", ["product"=>"product"]))

@section('content')
	<div id="product-create-page">
		@include('includes.flash-message')
		@include('includes.back-error')

		<div class="alert alert-warning alert-dismissible" role="alert">
			<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
			<span>
                <b>{{ trans2("A333", "Warning !!") }}</b>
                {{ trans2("A334", "you must complete this step, because your ::product creation is not finshed yet.", ["product"=>"product"]) }}
            </span>
		</div>

		<div class="panel panel-default">
			<div class="panel-heading">
				<b>{{ trans2("A335", "create a new ::product (step II)", ["product"=>"product"]) }}</b>
			</div>
			<div class="panel-body">
				<div class="container-fluid tabs-wrap">
				    <div class="draggable-container">
					    <ul class="nav nav-tabs draggable" role="tablist">
					        <li class="active">
					        	<a href="#product-images" aria-controls="upload-images-carousel" aria-expanded="true" role="tab" data-toggle="tab">
					        		<span class="icon-fontello-n4"></span>
					        		{{ trans2("A336", "upload images & carousel") }}
					        	</a>
					        </li>
					        <li>
					        	<a href="#tags" aria-controls="tags" aria-expanded="true" role="tab" data-toggle="tab">
					        		<span class="icon-fontello-n5"></span>
					        		{{ trans2("A337", "tags") }}
					        	</a>
					        </li>
					        <li>
					        	<a href="#options" aria-controls="options" aria-expanded="true" role="tab" data-toggle="tab">
					        		<span class="icon-fontello-n6"></span>
					        		{{ trans2("A338", "options") }}
					        	</a>
					        </li>
					    </ul>
				    </div>
				    <div id="create-product">
					    <div class="tab-content">
					        <div class="tab-pane active" id="product-images">
								<div class="dropzone-image">
									<label>{{ trans2("A339", "upload images") }} <span id="photoCounter-1"></span></label>
									<div class="form-group">
										<div class="droping">
									        {!! Form::open(['url' => route('image-upload'), 'class' => 'dropzone', 'files'=>true, 'id'=>'dropzone-1']) !!}
										        {!! Form::hidden('upload_type', 'image') !!}
										        {!! Form::hidden('parent_id', Session::get('products_step1')['product_id']) !!}
										        <div class="dz-message">
										        	<h3>{{ trans2("A340", "drop images in this area or click here") }}</h3>
										        </div>
										        <div class="fallback">
										            <input name="file" type="file" multiple>
										        </div>
										        <div class="dropzone-previews" id="dropzonePreview-1"></div>
									        {!! Form::close() !!}
										</div>
										@include('standers.dropzone.preview-template')
										<p class="help-block">{{ trans2("A341", "max images upload is ::max_images images", ['max_images' => config('sensorization.images.max_uploads')]) }}</p>
									</div>
								</div>
								<div class="dropzone-image">
									<label>{{ trans2("A342", "upload carousel") }} <span id="photoCounter-2"></span></label>
									<div class="form-group">
										<div class="droping">
									        {!! Form::open(['url' => route('carousel-upload'), 'class' => 'dropzone', 'files'=>true, 'id'=>'dropzone-2']) !!}
										        {!! Form::hidden('upload_type', 'carousel') !!}
										        {!! Form::hidden('parent_id', Session::get('products_step1')['product_id']) !!}
										        <div class="dz-message">
										        	<h3>{{ trans2("A343", "drop carousel in this area or click here") }}</h3>
										        </div>
										        <div class="fallback">
										            <input name="file" type="file" multiple>
										        </div>
										        <div class="dropzone-previews" id="dropzonePreview-2"></div>
									        {!! Form::close() !!}
										</div>
										@include('standers.dropzone.preview-template')
										<p class="help-block">{{ trans2("A344", "max carousel upload is ::max_carousel carousel", ['max_carousel' => config('sensorization.carousel.max_uploads')]) }}</p>
									</div>
								</div>	
								<button class="btn btn-default continue" type="button">
                                    {{ trans2("A345", "next") }} 
                                    <span class="icomoon-arrow-10"></span>
                                </button>	
					        </div>	   
					        <div class="tab-pane" id="tags">
					        	{!! Form::open(["url"=>route("admin.products..store")."/store/step/2"]) !!}
					        	{!! Form::hidden('product_id', Session::get('products_step1')['product_id']) !!}
					        	<div class="form-group">
									{!! Form::label("", trans2("A346", "Look for local tags")) !!} 
									&nbsp; [<a href="{{ route('APT.view-append-modal') }}" data-toggle="modal" data-target="#Modal" data-remote="false">{{ trans2("A347", "append new tags") }}</a>]
									{!! Form::text("", "", ["class"=>"form-control tags_searcher"]) !!}
								</div>
								<div class="well p-tags">
									{!! Form::hidden("product_tags") !!}
								</div>
								<p class="loading-text" style="display: none">{{ trans2("A348", "Loading...") }}</p>
								<button type="button" class="btn btn-default back">
									<span class="icomoon-arrow-10 flipped col-flip-180"></span> 
									{{ trans2("A349", "back") }}
								</button>
					    		<button type="button" class="btn btn-default continue">
				    				{{ trans2("A350", "continue") }} 
				    				<span class="icomoon-arrow-10"></span>
				    			</button>
					        </div>
					        <div class="tab-pane" id="options">
					        	<div class="form-group">
									<div class="checkbox">
										<label>
											{!! Form::hidden("is_new", 0) !!}
											{!! Form::checkbox("is_new", 1, null, ["class"=>"checkbox"]) !!}
											<b>{{ trans2("A351", "Are it's new ::product", ["product"=>"product"]) }}</b>
										</label>
									</div>
									<div class="checkbox">
										<label>
											{!! Form::hidden("is_live", 0) !!}
											{!! Form::checkbox("is_live", 1, "checked", ["class"=>"checkbox"]) !!}
											<b>{{ trans2("A352", "set this product on live", ["product"=>"product"]) }}</b>
										</label>
									</div>
									<div class="checkbox">
										<label>
											{!! Form::hidden("is_carousel_live", 0) !!}
											{!! Form::checkbox("is_carousel_live", 1, "checked", ["class"=>"checkbox"]) !!}
											<b>{{ trans2("A353", "set carousel images live?") }}</b>
										</label>
									</div>
									<div class="checkbox">
										<label>
											{!! Form::hidden("is_payment_on_delivery", 0) !!}
											{!! Form::checkbox("is_payment_on_delivery", 1, null, ["class"=>"checkbox"]) !!}
											<b>{{ trans2("A354", "is support a payment on delivery?") }}</b>
										</label>
									</div>
                                    @if($global_setting->is_support_paypal_payment)
    									<div class="checkbox">
    										<label>
    											{!! Form::hidden("is_payment_by_paypal", 0) !!}
    											{!! Form::checkbox("is_payment_by_paypal", 1, "checked", ["class"=>"checkbox", "disabled"=>"disabled"]) !!}
    											<b>{{ trans2("A355", "is support a payment by paypal?") }}</b>
    										</label>
                                            <div class="help-block">
                                                {{ trans2("A356", "you can change paypal status from") }}
                                                <a href="/admin/site-setting">{{ trans2("A357", "main setting") }}</a>
                                                {{ trans2("A358", "section") }}
                                            </div>
    									</div>
                                    @else
                                        {!! Form::hidden("is_payment_by_paypal", 0) !!}
                                    @endif
                                    <hr>
									<div class="checkbox">
										<label>
											{!! Form::hidden("create_again", 0) !!}
											{!! Form::checkbox("create_again", 1, "checked", ["class"=>"checkbox"]) !!}
											<b>{{ trans2("A359", "create another ::product?", ["product"=>"product"]) }}</b>
										</label>
									</div>
								</div>
								{!! Form::hidden("primary_image_id", 1) !!}
								{!! Form::hidden("primary_carousel_id", 1) !!}
								<button type="button" class="btn btn-default back">
									<span class="icomoon-arrow-10 col-flip-180 flipped"></span>
									{{ trans2("A360", "back") }}
								</button>
					    		<button type="submit" class="btn btn-default continue">
					    			{{ trans2("A361", "finish") }} 
					    			<span class="icomoon-arrow-10"></span>
					    		</button>
								{!! Form::close() !!}
					        </div>
					    </div>
					</div>
				</div>
			</div>
		</div>
	</div>
		
	<!-- Default bootstrap modal example -->
	@include('standers.modal')
@stop

@section('head-css')
	<link rel="stylesheet" type="text/css" href="./assets/css/packages/fontello/numbers/css/fontello.css">
	<link rel="stylesheet" type="text/css" href="./assets/css/packages/icomoon/arrows/style.css">
	<link rel="stylesheet" type="text/css" href="./assets/css/packages/draggable-taps/draggable-taps.css">
	<link rel="stylesheet" type="text/css" href="./packages/dropzone/dropzone.css">
@stop

@section('footer-js')
	<script type="text/javascript" src="./assets/js/packages/jquery-ui/widget.js"></script>
	<script type="text/javascript" src="./assets/js/packages/jquery-ui/mouse.js"></script>
	<script type="text/javascript" src="./assets/js/packages/jquery-ui/data.js"></script>
	<script type="text/javascript" src="./assets/js/packages/jquery-ui/plugin.js"></script>
	<script type="text/javascript" src="./assets/js/packages/jquery-ui/safe-active-element.js"></script>
	<script type="text/javascript" src="./assets/js/packages/jquery-ui/safe-blur.js"></script>
	<script type="text/javascript" src="./assets/js/packages/jquery-ui/scroll-parent.js"></script>
	<script type="text/javascript" src="./assets/js/packages/jquery-ui/widgets/draggable.min.js"></script>
	<script type="text/javascript" src="./assets/js/packages/draggable-taps.min.js"></script>
    
	<script type="text/javascript" src="./packages/dropzone/dropzone.js"></script>	
	<script type="text/javascript" src="./assets/js/packages/dropzone-config.js"></script>
    <script type="text/javascript">
        $(document).ready(function () {
            dropzone(1, 'image');
            dropzone(2, 'carousel'); 

            setPrimaryTargetId('.dropzone-image');
        });
    </script>

	<script type="text/javascript">
		$(document).ready(function(){
			tags_searcher();

			tagModal([
				'{{ trans2("A362", "append new tags") }}'
			], null, null, null);

			$('.tab-pane .continue').click(function(){
			  $('.nav-tabs > .active').next('li').find('a').trigger('click');
			});

			$('.tab-pane .back').click(function(){
			  $('.nav-tabs > .active').prev('li').find('a').trigger('click');
			});
		})
	</script>
@stop