@extends("front.$frontendNumber.master")
@section("title", trans2("A72", "Done request"))

@section("content")
    <div class="container">
        <h3 class="text-center">
            {{ trans2("A73", "Your product was added successflly, wait to review it") }} <br><br>
            <a href='/'>{{ trans2("A74", "back to home") }}</a><br>
            <a href='/my-cart'>{{ trans2("A75", "back to my cart") }}</a>
        </h3>
    </div>
@stop