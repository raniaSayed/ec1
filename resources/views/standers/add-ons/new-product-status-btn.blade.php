<button class="is-new-status btn-{{ $product->is_new == 1 ? 'success' : 'danger'}} btn btn-sm pull-right" product-id="{{ $product->id }}" data-status="{{ $product->is_new }}" title='{{ trans2("A173", "::products new status", ["products"=>"products"]) }}' aria-hidden="true" data-toggle="tooltip" data-placement="top">
	<span class="glyphicon glyphicon-star"></span>
	&nbsp;
	@if($product->is_new == 1)
		<span class="glyphicon glyphicon-ok-sign switch"></span>
	@else
		<span class="glyphicon glyphicon-remove-sign switch"></span>
	@endif
</button>

<script type="text/javascript">
	$(document).ready(function(){	
		onOff_status('.is-new-status', '/admin/products/is-new-status');
	});
</script>