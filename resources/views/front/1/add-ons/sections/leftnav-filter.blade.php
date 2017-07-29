<?php

	use App\Models\Product\Category1;
	use App\Logic\Product\SearchFormat;
	use Hashids\Hashids;

	$searchFormat = new SearchFormat;
	$SF_price = $searchFormat->price();
	$SF_sales = $searchFormat->sales(.15, .70);

	$hashids = new Hashids('', 6, '0123456789CtNuoA');
	$main_categories = Category1::lists('name', 'id');
?>

<div id="filter-bar">
	<div class="panel panel-default">
		<div class="panel-heading">{{ trans2("A53", "Advanced ::products filter", ["products"=>"products"]) }}</div>
		<div class="panel-body">
			{!! Form::open(["url"=>"/products/search", "method"=>"get", "target"=>"_blank"]) !!}
				<div class="form-group" data-type="name" data-values="1">
					<label>{{ trans2("A54", "name") }}</label>
					{!! Form::text("", "", ["class"=>"form-control name1", "placeholder"=>""]) !!}
				</div>
				<div class="form-group" data-type="price" data-values="2">
					<label>{{ trans2("A55", "Price") }}</label>
					<div class="input-group">
						{!! Form::text("", "", ["class"=>"form-control price1 from", "placeholder" => trans2("A56", "From: ::price", ['price'=>$SF_price->min]) ]) !!}
						<span class="input-group-btn" style="width: 0px;"></span>
						{!! Form::text("", "", ["class"=>"form-control price2 to", "placeholder" => trans2("A57", "To: ::price", ['price'=>$SF_price->max]) ]) !!}
					</div>
					<span class="help-block opc-7">{{ trans2("A58", "search on discounted price") }}</span>
				</div>
				<div class="form-group" data-type="category">
					<label>{{ trans2("A59", "Main categories") }}</label>
					<select class="form-control">
						<option>{{ trans2("A60", "Show all") }}</option>
						@foreach($main_categories as $key => $cat)
							<option value="{{ $hashids->encode($key) }}">{{$cat}}</option>
						@endforeach
					</select>
				</div>
				<div class="form-group" data-type="sales_range">
					<label>{{ trans2("A61", "Sales") }}</label>
					<select class="form-control">
						<option value="0">Show all</option>
						@foreach($SF_sales as $key => $value)
							<option value="{{ $key }}">{{ $value['title'] }} {{ $value['salesCount'] > 0 ? " - ".$value['salesCount'] : '' }}</option>
						@endforeach
					</select>
				</div>
				<div>
					<span class="help-block opc-7">{{ trans2("A62", "You can search by multi inputs") }}</span>
					{!! Form::submit(trans2("A63", "Filter"), ["class"=>"btn btn-default"]) !!}
				</div>
			{!! Form::close() !!}
		</div>
	</div>
</div>
	