<div id="create-new-translation" class="content">
    <div class="alert alert-danger errors-section" role="alert"></div>
    {!! Form::open(['url' => '/admin/translations']) !!}
        <div class="form-group">
            <label>(en) translation</label>
            <textarea name="en" class="form-control input-lg" autofocus="true" rows="3"></textarea>
        </div>
        <div class="form-group">
            <label>(ar) translation</label>
            <textarea name="ar" class="form-control input-lg" autofocus="true" dir="auto" rows="3"></textarea>
        </div>
        <button type="submit" class="btn btn-primary">Add</button>
    {!! Form::close() !!}
    <p class="success-message text-success"></p>
</div>

<script type="text/javascript">
    var parent = $('#create-new-translation');

    parent.find(':submit').on('click', function(e){

        // stop form submitting
        e.preventDefault();

        var datastring = parent.find('form').serialize();

        $.ajax({
            url: '/admin/translations',
            type: 'post',
            data: datastring,
            success: function(data){
                parent.find('.success-message').show
                parent.find('.success-message')
                    .slideDown(250).text(data.message)
                    .delay(2500).slideUp(250)
                    .text();
            }, 
            error: function(data){
                $.each(data.responseJSON, function(i, item) {
                    parent.find('.errors-section').html(item.join('<br>')).slideDown(250);
                })
            }
        })
    });
</script>