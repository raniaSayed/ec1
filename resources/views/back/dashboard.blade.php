@extends('back.master')
@section('title', trans2('A469', "Admin c.p - dashboard"))

@section('content')
	<div id="dashboard-page">
		<div class="panel panel-default">
			<div class="panel-heading">
				<b>{{ trans2("A470", "dashboard") }}</b>
			</div>
			<div class="panel-body">
                <div class="row">
                    <div class="item">
                        <div class="title">{{ trans2("A471", "All ::products count", ["products"=>"products"]) }}</div>
                        <div class="content">{{ number_format($products_count) }}</div>
                    </div>
                    <div class="item">
                        <div class="title">{{ trans2("A472", "all live ::products count", ["products"=>"products"]) }}</div>
                        <div class="content">{{ number_format($live_products_count) }}</div>
                    </div>
                    <div class="item">
                        <div class="title">{{ trans2("A473", "all visitor count") }}</div>
                        <div class="content">{{ number_format($visitor_count) }}</div>
                    </div> 
                    <div class="item">
                        <div class="title">{{ trans2("A474", "visitor count last week") }}</div>
                        <div class="content">{{ number_format($visitor_count_lastWeek) }}</div>
                    </div>
                    <div class="item">
                        <div class="title">{{ trans2("A475", "Tags count") }}</div>
                        <div class="content">{{ number_format($tags_count) }}</div>
                    </div>
                    <div class="item">
                        <div class="title">{{ trans2("A476", "Translations count") }}</div>
                        <div class="content">{{ number_format($trans_count) }}</div>
                        <?php // <i class="text-warning">{{ trans2("A477", "When set new translation define id grater than:") }} <b>{{ number_format($last_trans_id) }}</b></i> ?>
                    </div>
                    <div class="item">
                        <div class="title">{{ trans2("A506", "::products live carousel count", ["products"=>"products"]) }}</div>
                        <div class="content">{{ number_format($products_carousel_count) }}</div>
                        <i class="text-warning">{{ trans2("A478", "recommended to don't add above 12 product in carousel gallery") }}</i>
                    </div>
				</div>
			</div>
		</div>
	</div>
@stop