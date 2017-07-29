@extends('back.master')
@section('title', trans2('A481', "Admin c.p - amain setting (by superadmin)"))

@section('content')
	<div id="site-setting-page">
		@include('includes.back-error')
		@include('includes.flash-message')

		<div class="panel panel-default">
			<div class="panel-heading">{{ trans2("A482", "modify site setting") }}</div>
			<div class="panel-body">
				{!! Form::open(["url"=>"/admin/site-setting"]) !!}
                    <div class="main-setting">
    					<p class="base-title"><u>{{ trans2("A483", "main setting") }}</u></p>
                        <div class="primary">
        					<div class="row">
        						<div class="item">
        							<div class="form-group">
        								{!! Form::label("", trans2("A484", "site name")) !!}
        								{!! Form::text("site_name", $site_setting->site_name, ["class"=>"form-control"]) !!}
        							</div>
        						</div>
        						<div class="item">
        							<div class="form-group">
        								{!! Form::label("", trans2("A485", "category")) !!}
        								{!! Form::text("site_category", $site_setting->site_category, ["class"=>"form-control"]) !!}
        							</div>
        						</div>
        						<div class="item">
        							<div class="form-group">
        								{!! Form::label("", trans2("A486", "customer service number")) !!}
        								{!! Form::text("customer_service_number", $site_setting->customer_service_number, ["class"=>"form-control"]) !!}
        							</div>
        						</div>
                                <div class="item">
                                    <div class="form-group">
                                        {!! Form::label("", trans2("A487", "currency auto update after")) !!}
                                        {!! Form::number("currencies_auto_update_duration", $site_setting->currencies_auto_update->duration, ["class"=>"form-control"]) !!}
                                        <div class="help-block">{{ trans2("A488", "by minutes") }}</div>
                                    </div>
                                </div>
        					</div>
                        </div>
                    </div>
					
                    <div class="product-setting">
                        <p class="base-title"><u>{{ trans2("A489", "product setting") }}</u></p>
                        <div class="primary">
                            <div class="row">
                                <div class="item">
                                    <div class="form-group">
                                        {!! Form::label("", trans2("A490", "currency")) !!}
                                        {!! Form::select("main_currency", $currencies, $site_setting->main_currency, ["class"=>"form-control"]) !!}
                                    </div>
                                </div>
                                <div class="item">
                                    <div class="form-group">
                                        {!! Form::label("", trans2("A491", "product 'new status' will turn off after")) !!}
                                        {!! Form::select("newStatusTimeOff", $newStatusTimeOff, $site_setting->newStatusTimeOff, ["class"=>"form-control"]) !!}
                                        <div class="help-block">{{ trans2("A511", "from creation product date") }}</div>
                                    </div>
                                </div>
                            </div>     
                        </div>
                        <div class="secondry">
                            <div class="row">
                                <div class="item">
                                    <div class="form-group">
                                        <label>
                                            {!! Form::hidden("auto_generage_serial_number", 0) !!}
                                            {!! Form::checkbox("auto_generage_serial_number", 1, $global_setting->is_auto_generage_product_serial_number ? 'checked' : null) !!}
                                            {{ trans2("A492", "Make auto generage for serial number of product?") }}
                                        </label>
                                    </div>
                                </div>
                                <div class="item">
                                    <div class="form-group">
                                        <label>
                                            {!! Form::hidden("is_support_paypal_payment", 0) !!}
                                            {!! Form::checkbox("is_support_paypal_payment", 1, $global_setting->is_support_paypal_payment ? 'checked' : null) !!}
                                            {{ trans2("A493", "support paypal payment?") }}
                                        </label>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="cart-setting">
                        <p class="base-title"><u>{{ trans2("A495", "MCart setting") }}</u></p>
                        <div class="primary">
                            <div class="row">
                                <div class="item">
                                    <div class="form-group">
                                        <label>
                                            {!! Form::hidden("clear_cart_when_logout", 0) !!}
                                            {!! Form::checkbox("clear_cart_when_logout", 1, $global_setting->is_clear_cart_when_logout ? 'checked' : null) !!}
                                            {{ trans2("A494", "Make clear for cart when user logout?") }}
                                        </label>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
					{!! Form::submit(trans2("A496", "update setting"), ["class"=>"btn btn-default pull-right"]) !!}
				{!! Form::close() !!}
			</div>
		</div>
	</div>
@stop