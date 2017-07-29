<?php 
    use Hashids\Hashids;
    $hashids  = new Hashids('', 2,  '0123456789ABCDEF');
?>

<nav id="navbar-1" class="navbar navbar-inverse">
    <div class="container-fluid">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar-collapse-1" aria-expanded="false">
                <span class="sr-only">{{ trans2("A9", "Toggle navigation") }}</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="/" onclick="{{ Request::path() == '/' ? 'return false;' : '' }}" title="{{ trans2('A10', 'Home page') }}">
                <img alt="Brand" src="./assets/icons/logo-icon.png" width="24px">
                <b>{{ $global_setting->site_name }}</b>
            </a>
        </div>

        <div class="collapse navbar-collapse" id="navbar-collapse-1">
            <ul class="nav navbar-nav">
                <li><a href="/products">{{ trans2("A11", "all ::products", ["products"=>"products"]) }}</a></li>
                @include("front.$frontendNumber.add-ons.nested-categories-navbar-section")
                <li><a href="/contact-us">{{ trans2("A12", "contact us") }}</a></li>
                <li><a href="/about-us">{{ trans2("A13", "about us") }}</a></li>
            </ul>

            <div class="navbar-right">
                <ul class="nav navbar-nav">
                    @if(!Auth::check())
                        <li class="btn-style">
                            <a href="/register">{{ trans2("A14", "sign up") }}</a>
                        </li>
                        <li class="btn-style">
                            <a href="/login">{{ trans2("A15", "login") }}</a>
                        </li>
                    @else
                        <li class="dropdown">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
                                {{  Auth::user()->name  }}  
                                <span class="caret"></span>
                            </a>
                            <ul class="dropdown-menu">
                                @if($personType ==  'user')
                                    <li><a href="/profile">{{ trans2("A16", "profile") }}</a></li>
                                @else
                                    <li><a href="/admin">{{ trans2("A17", "admin panel") }}</a></li>
                                @endif
                                <li><a href="/my-cart">{{ trans2("A18", "my cart") }} <span class="cart-value">({{ $cart_count }})</span></a></li>
                                <li><a href="/logout">{{ trans2("A19", "logout") }}</a></li>
                            </ul>
                        </li>
                    @endif
                    <li class="dropdown">
                        <a  href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
                            {{ trans2("A20", "language") }} ({{ $supported_trans->$main_lang->content }})
                            <span class="caret"></span>
                        </a>
                        <ul class="dropdown-menu">
                            @foreach($supported_trans as $key => $value)
                                <li><a href="/locale/set-locale/{{ $key }}">{{ $value->content }}</a></li>
                            @endforeach
                        </ul>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</nav>