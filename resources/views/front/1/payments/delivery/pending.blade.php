@extends("front.$frontendNumber.master")
@section("title", trans2("A79", "pending request"))

@section("content")
    <div class="container">
        <h3 class="text-center">
            {{ trans2("A76", "You must insert your accessing Information like country & address to can use delivery payment") }} <br><br>
            <a href='/profile/edit-my-information'>{{ trans2("A77", "Edit you profile now") }}</a><br>
            <a href='/my-cart'>{{ trans2("A78", "Back to cart") }}</a>
        </h3>
    </div>
@stop