@extends('back.master')
@section('title', "transLations")

@section('content')
    <div id="translations-view-page">
        @include('includes.flash-message')
        @include('includes.back-error')

        <div class="row">
            <div class="col-md-9">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        {{ trans2("A468", "Translations section") }}
                        <a href="/admin/translations/take-backup" class="btn btn-success btn-sm pull-right">
                            Take backup
                        </a>
                        <!--a href="/admin/translations/create" class="btn btn-info btn-sm pull-right" data-toggle="modal" data-target="#Modal" data-remote="false">
                            Add translation
                        </a-->
                    </div>
                    <div class="panel-body">
                        <div class="container-fluid">
                            @if(count($translations) == 0)
                                <div class="text-center empty-content">
                                    <h3>No translations yet</h3>
                                </div>
                            @else
                                <div id="response-table">
                                    <table class="table table-striped table-hover sortable ps-view">
                                        <thead>
                                            <tr>
                                                <th>Caller</th>
                                                @foreach($supported_trans as $key => $value)
                                                    @if(in_array($key, (array) $displayed_trans))
                                                        <th>
                                                            {{ $key }} ({{ $value->content }})
                                                            @if($personType == "super_admin")
                                                                {!! Form::open(['url'=>'/locale/remove-locale/'. $key]) !!}
                                                                    <button type="submit" class="btn btn-link btn-xs delete" title="Remove {{ $value->content }} translation" aria-hidden="true" data-toggle="tooltip" data-placement="top">
                                                                        <span class="glyphicon glyphicon-remove text-danger"></span>
                                                                    </button>
                                                                {!! Form::close() !!}
                                                            @endif
                                                        </th>
                                                    @endif
                                                @endforeach
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach($translations as $trans)
                                                <tr data-id="{{ $trans->id_num }}">
                                                    <td>{{ $trans->caller }}</td>
                                                    @foreach($supported_trans as $key => $value)
                                                        @if(in_array($key, (array) $displayed_trans))
                                                            <td data-key="{{ $key }}">
                                                                <a href="#" class="title" data-toggle="popover" data-trans-key="{{ $key }}" dir="auto">{{ $trans->$key }}</a>
                                                                @if($key != 'en')
                                                                    <button class="pull-right auto-trans" data-from="en" title="translation from (en) to ({{ $key }})" aria-hidden="true" data-toggle="tooltip" data-placement="top">(auto trans)</button>
                                                                @endif
                                                            </td>
                                                        @endif
                                                    @endforeach
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                {!! Form::open(['url'=>'/locale/create-locale', 'class'=>'create-locale']) !!}
                    <label>add translation</label>
                    <div class="form-group">
                        <select name="trans_key" class="form-control">
                            <option value="0" selected>Please choose translation</option>
                            @foreach($unsupportedTranslations as $key => $title)
                                <option value="{{ $key }}">{{ $title }}</option>
                            @endforeach
                        </select>
                    </div>
                    {!! Form::hidden('trans_title', "", ['class'=>'trans-title']) !!}
                    <button type="submit" class="btn btn-default disabled">Add Language</button>
                {!! Form::close() !!}
                <hr>
                    <div class="form-group trans-displaying">
                        <label>display of supported translations</label><br>
                        @foreach($supported_trans as $key => $value)
                            <label>
                                <input type="checkbox" name="{{ $key }}" {{ in_array($key, (array) $displayed_trans) ? "checked" : "" }}> {{ $key }}
                            </label> &nbsp;
                        @endforeach
                    </div>
                    <!-- checkbox langs view table -->
                <hr>
                <div class="form-group auto-trans-db-saving">
                    <label>
                        <input type="checkbox" name="auto_trans_db_saving" {{ $global_setting->auto_trans_db_saving == "true" ? 'checked' : '' }}>
                        automatic save translation when make (auto trans)
                    </label>
                </div>
            </div>
        </div>
              
        <div class="text-center">
            {!! $translations->render() !!}
        </div>
    </div>

    <div class="popoverContent" style="display: none !important">
        <div class="form-group">
            <textarea class="form-control input-lg" rows="3" placeholder="some translation" dir="auto"></textarea>
        </div>
        <button class="submit btn btn-primary btn-sm">update</button>
        <button class="cancel btn btn-default btn-sm">cancel</button>
    </div>

    <!-- Default bootstrap modal example -->
    @include('standers.modal')
@stop

@section('head-css')
    <link rel="stylesheet" type="text/css" href="./packages/bootstrap-sortable/Contents/bootstrap-sortable.css">
@stop

@section('footer-js')
    <script type="text/javascript" src="./packages/bootstrap-sortable/Scripts/bootstrap-sortable.js"></script>
    <script type="text/javascript" src="./packages/bootstrap-sortable/Scripts/moment.min.js"></script>
    <script type="text/javascript" src="./assets/js/links-optimization.js"></script>

    <script type="text/javascript">
        $(document).ready(function(){
            tagModal([
                'Create translations'
            ], null, 'GET', null)
        })
    </script>

    <script type="text/javascript" data-des="locale selecting">
        $('.create-locale select').change(function(){
            var val = $(this).val();
            var title = $(this).find(':selected').text();

            var submit_btn = $(this).parents('.create-locale').find(':submit');
            var hidden_title = $(this).parents('.create-locale').find(':hidden.trans-title');

            if(val != 0){
                submit_btn.removeClass('disabled');
                hidden_title.val(title);
            } else {
                submit_btn.addClass('disabled');
                hidden_title.val("");
            }
        })
    </script>

    <script type="text/javascript" data-des="popover">
        $(document).ready(function(){
            $('[data-toggle="popover"]').each(function( index ) {
                var that = $(this);

                $(this).popover({
                    html: true,
                    placement: 'top',
                    trigger: 'click',
                    delay: {
                        "hide": 350 
                    },
                    content: function () {
                          return $('.popoverContent').html();
                    }       
                })
            }).on('shown.bs.popover', function(){
                var _this = $(this);
                var parent = _this.find('+ div .popover-content');
                var textarea = parent.find('textarea');

                // default translation
                textarea.val(_this.text());

                parent.delegate('.submit', 'click', function(){
                    var trans_id = _this.parents('tr').attr('data-id');
                    var trans_key = _this.attr('data-trans-key');
                    var trans_content = textarea.val();

                    $.ajax({
                        url: '/admin/translations/' + trans_id,
                        type: 'post',
                        data: {
                            _method: 'patch',
                            key: trans_key,
                            content: trans_content
                        },
                        success: function(data){
                            // new translation
                            _this.text(data.content);

                            _this.popover('hide');
                        }
                    })
                })

                parent.delegate('.cancel', 'click', function(){
                    _this.popover('hide');
                })

            }).on('hide.bs.popover', function(){
                $('.popoverContent textarea').text('');
            });
        })
    </script>

    <script type="text/javascript" data-des="auto trans options">
        $(document).ready(function(){
            $('.auto-trans').click(function(){
                var _this = $(this);
                var id = _this.parents('tr').attr('data-id');
                var content = _this.parents('tr').find('td[data-key="en"] a.title').text();
                var trans_from = _this.attr('data-from');
                var trans_to = _this.parent().find('a.title').attr('data-trans-key');

                if(confirm('Are you sure to make auto translation to "' + content + '"')){
                    $.ajax({
                        url: '/locale/auto-trans',
                        type: 'post',
                        data: {
                            id: id,
                            key: trans_to,
                            content: content,
                            trans_from: trans_from,
                            trans_to: trans_to
                        },
                        success: function(data){
                            _this.parent().find('a.title').text(data.new_content);
                        }
                    })
                }
            })

            $('.auto-trans-db-saving :checkbox').change(function(){
                var value = $(this).is(':checked');

                $.ajax({
                    url: '/locale/auto-trans-db-saving/' + value,
                    type: 'post'
                })
            })
        });
    </script>

    <script type="text/javascript" data-des="displaying of translations">
        $(document).ready(function(){
            $('.trans-displaying :checkbox').change(function(){
                var key = $(this).attr('name');
                var value = $(this).is(':checked') ? 1 : 0;

                $.ajax({
                    url: '/locale/trans-displaying/' + key + "/" + value,
                    type: 'post'
                })
            });
        })
    </script>
@stop
