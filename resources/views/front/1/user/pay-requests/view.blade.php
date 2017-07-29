@extends("front.$frontendNumber.user.master")
@section('title', trans2("A125", "Pay requests"))

@section('content')
    <div id="pay-requests-view-page">
        <div class="panel panel-default">
            <div class="panel-heading">
                <b>{{ trans2("A125") }}</b>
            </div>
            <div class="panel-body">
                <div class="container-fluid">
                    @if(count($requests) <= 0)
                        <div class="text-center empty-content">
                            <h3>{{ trans2("A126", "No pay requests yet") }}</h3>
                        </div>
                    @else
                        <div id="response-table">
                            <table class="table table-striped table-hover sortable ps-view">
                                <thead>
                                    <tr>
                                        <th>{{ trans2("A127", "Item name") }}</th>
                                        <th>{{ trans2("A128", "Price") }} </th>
                                        <th>{{ trans2("A129", "Quantity") }} </th>
                                        <th>{{ trans2("A130", "Payment method") }}</th>
                                        <th>{{ trans2("A131", "Status") }}</th>
                                        <th>{{ trans2("A132", " Created at") }}</th>
                                        <th>{{ trans2("A133", "Options") }}</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($requests as $request)
                                        <tr>
                                            <td data-title='{{ trans2("A127") }}'>
                                                {{ $request->product_name }}
                                            </td>
                                            <td data-title='{{ trans2("A128") }}'>
                                                {{ number_format($request->product_price) }} 
                                                {{ $request->product_currency }}
                                            </td>
                                            <td data-title='{{ trans2("A129") }}'>
                                                {{ $request->product_quantity }}
                                            </td>
                                            <td data-title='{{ trans2("A130") }}'>
                                                {{ $request->payment_method }}
                                            </td>
                                            <td data-title='{{ trans2("A131") }}'>
                                                @if($request->status == 2)
                                                    {{ trans2("A134", "Accepted") }}
                                                @elseif($request->status == 1)
                                                    {{ trans2("A135", "Rejected") }}
                                                @elseif($request->status == 0)
                                                    {{ trans2("A136", "Pending") }}
                                                @endif
                                            </td>
                                            <td data-title='{{ trans2("A132") }}'>
                                                {{ $request->created_at }}
                                            </td>
                                            <td data-title='{{ trans2("A133") }}'>
                                                {!! Form::open(["url"=>"pay-requests/$request->id", "method"=>"DELETE"]) !!}
                                                    <button type="submit" class="btn btn-default btn-sm">
                                                        <span class="glyphicon glyphicon-remove"></span> {{ trans2("A137", "remove") }}
                                                    </button>
                                                {!! Form::close() !!}
                                                <a href="/pay-requests/cancel/{{ $request->id }}" class="btn btn-default btn-sm">
                                                    <span class="glyphicon glyphicon-pause"></span> {{ trans2("A138", "cancel") }}
                                                </a>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    @endif
                </div>
            </div>
            <div class="text-center">
                {!! $requests->render() !!}
            </div>
        </div>
    </div>
@stop

@section('head-css')
    <link rel="stylesheet" type="text/css" href="./packages/bootstrap-sortable/Contents/bootstrap-sortable.css">
@stop

@section('footer-js')
    <script type="text/javascript" src="./packages/bootstrap-sortable/Scripts/bootstrap-sortable.js"></script>
    <script type="text/javascript" src="./packages/bootstrap-sortable/Scripts/moment.min.js"></script>
@stop