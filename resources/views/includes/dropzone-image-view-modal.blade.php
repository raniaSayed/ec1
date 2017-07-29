<div id="product-images">
	<div class="dropzone-image">
		<label>{{ trans2("A507", "upload images") }} <span id="photoCounter-1"></span></label>
		<div class="form-group">
			<div class="droping">
		        {!! Form::open(['url' => route('image-upload'), 'class' => 'dropzone', 'files'=>true, 'id'=>'dropzone-1']) !!}
			        {!! Form::hidden('upload_type', 'image') !!}
			        {!! Form::hidden('parent_id', 1) !!}
			        <div class="dz-message">
			        	<h3>{{ trans2("A508", "drop images in this area or click here") }}</h3>
			        </div>
			        <div class="fallback">
			            <input name="file" type="file" multiple>
			        </div>
			        <div class="dropzone-previews" id="dropzonePreview-1"></div>
		        {!! Form::close() !!}
			</div>
			@include('standers.dropzone.preview-template')
			<p class="help-block">{{ trans2("A509", "max images upload is ::max_images images", ['max_images' => config('sensorization.images.max_uploads')]) }}</p>
		</div>
	</div>
	<div class="dropzone-image">
		<label>{{ trans2("A510", "upload carousel") }} <span id="photoCounter-2"></span></label>
		<div class="form-group">
			<div class="droping">
		        {!! Form::open(['url' => route('carousel-upload'), 'class' => 'dropzone', 'files'=>true, 'id'=>'dropzone-2']) !!}
			        {!! Form::hidden('upload_type', 'carousel') !!}
			        {!! Form::hidden('parent_id', 2) !!}
			        <div class="dz-message">
			        	<h3>{{ trans2("A511", "drop carousel in this area or click here") }}</h3>
			        </div>
			        <div class="fallback">
			            <input name="file" type="file" multiple>
			        </div>
			        <div class="dropzone-previews" id="dropzonePreview-2"></div>
		        {!! Form::close() !!}
			</div>
			@include('standers.dropzone.preview-template')
			<p class="help-block">{{ trans2("A512", "max carousel upload is ::max_carousel carousel", ['max_carousel' => config('sensorization.carousel.max_uploads')]) }}</p>
		</div>
	</div>	
</div>	

<script type="text/javascript" src="./packages/dropzone/dropzone.js"></script>	
<script type="text/javascript" src="./assets/js/dropzone-config.js"></script>