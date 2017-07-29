<?php
	use App\Logic\Product\SearchFormat;

	$searchFormat = new SearchFormat;
	$SF_price = $searchFormat->price();
	$SF_sales = $searchFormat->sales(.15, .70);
?>

<div id="filter-bar" class="container-fluid">
	<div class="panel panel-default">
		<div class="panel-heading">
            {{ trans2("A272", "Filter ::products", ["products"=>"products"]) }}
            <a href="#" class="btn btn-default btn-sm pull-right slide-toggle" title="slide toggle" data-toggle="tooltip">
                <span class="glyphicon glyphicon-chevron-up"></span>
            </a>
        </div>
		<div class="panel-body">
			{!! Form::open(['url'=>'/admin/products/search', "method"=>"get", "target"=>"_blank"]) !!}
				<div class="form-group" data-type="name" data-values="1" data-status="0">
					<label>{{ trans2("A273", "Name") }}</label>
					{!! Form::text("", "", ["class"=>"form-control name1"]) !!}
				</div>
				<div class="form-group" data-type="price" data-values="2" data-status="0">
					<label>
						<b>{{ trans2("A274", "Price") }}</b>
					</label>
					<div class="input-group">
						{!! Form::text("", "", ["class"=>"form-control price1 from", "placeholder" => 
							trans2("A275", "From: ::price", ['price' => $SF_price->min])
						]) !!}
						<span class="input-group-btn" style="width: 0px;"></span>
						{!! Form::text("", "", ["class"=>"form-control price2 to", "placeholder" => 
							trans2("A276", "To: ::price", ['price' => $SF_price->max])
						]) !!}
					</div>
					<span class="help-block">{{ trans2("A277", "search on discounted price") }}</span>
				</div>
				<div class="form-group" data-type="sales_range" data-status="0">
					<label>
						<b>{{ trans2("A278", "Sales") }}</b>
					</label>
					<select class="form-control">
						<option value="0">{{ trans2("A279", "Show all") }}</option>
						@foreach($SF_sales as $key => $value)
							<option value="{{ $key }}">{{ $value['title'] }} {{ $value['salesCount'] > 0 ? " - ".$value['salesCount'] : '' }}</option>
						@endforeach
					</select>
				</div>
				<!-- checkboxes -->
				<div class="form-group" data-status="0">
					<div class="checkbox">
						<label>
							{!! Form::checkbox("isLive", 1, isset($_GET['isLive']) ? 1 : null, ["class"=>"checkbox"]) !!}
							<b>{{ trans2("A280", "Is live?") }}</b>
						</label>
					</div>
					<div class="checkbox">
						<label>
							{!! Form::checkbox("isDiscounted", 1, isset($_GET['isDiscounted']) ? 1 : null, ["class"=>"checkbox"]) !!}
							<b>{{ trans2("A281", "Is discounted?") }}</b>
						</label>
					</div>
				</div>
				<button type="submit" class="btn btn-default">
					{{ trans2("A282", "Filter") }} <span class="icomoon-arrow-10"></span>
				</button>

				@if(isset($redirectFrom) && $redirectFrom == 'tags')
					{!! Form::hidden("ids", $productsIds) !!}
				@endif
			{!! Form::close() !!}
		</div>
	</div>
</div>