/*Array.prototype.unique = function() {
    var arr = [];
    for(var i = 0; i < this.length; i++) {
        if(!arr.contains(this[i])) {
            arr.push(this[i]);
        }
    }
    return arr;
}*/

function navLinkActivation(path){
	var corrector = "";
	var path_split = path.split('/');
	var pop = path_split.pop();
	var detector = $.isNumeric(pop);

	if(detector && pop == 'step'){
		path = path_split.join('/');
		corrector = '^';
	}

	$('.list-group a[href'+corrector+'="'+path+'"]').addClass('active').click(function(e){
		e.preventDefault();
		return false;
	});
}

function tagModal(msg, url, method, data){
	$("#Modal").on("show.bs.modal", function(e) {
	    var link = $(e.relatedTarget);
	    var _this = $(this);

	    _this.find(".modal-title").html(msg[0]);
	    _this.find(".modal-footer button.save").hide(0);

	    $.ajax({
	    	url: link.attr("href") || url,
	    	type: method || "POST",
	    	data: data || [],
	    	success: function(data){
	    		_this.find(".modal-body").html(data);
	    	}
	    })
	});
}

function search_status(){
	var filter_bar = $('#filter-bar');

	function buttonDisabledstatus(){
		filter_bar.find('.form-group').each(function(){
			if($(this).attr('data-status') == 1){
				filter_bar.find('[type="submit"]').removeClass('disabled');
				return false;
			} else {
				filter_bar.find('[type="submit"]').addClass('disabled');
			}
		});
	}

	filter_bar.find('[type="text"]').keyup(function(e){
		e.preventDefault();

		var _this = $(this);
		var data_type = _this.parents('.form-group').attr('data-type');
		var data_values = _this.parents('.form-group').attr('data-values');

		if(_this.val().length > 0 && data_values == 2){
			filter_bar.find('[type="text"].'+data_type+'1').attr("name", data_type+"1");
			filter_bar.find('[type="text"].'+data_type+'2').attr("name", data_type+"2");

			var input1 = _this.parents('.form-group').find('[type="text"]:eq(0)').val().length;
			var input2 = _this.parents('.form-group').find('[type="text"]:eq(1)').val().length;

			if(input1 > 0 && input2 > 0) {
				_this.parents('.form-group').attr('data-status', 1);
			}
		} else if(_this.val().length > 0 && data_values == 1) {
			filter_bar.find('[type="text"].'+data_type+'1').attr("name", data_type);

			var input = _this.parents('.form-group').find('[type="text"]:eq(0)').val().length;

			if(input > 0) {
				_this.parents('.form-group').attr('data-status', 1);
			}
		} else {
			filter_bar.find('[type="text"].'+data_type+'1').attr("name", "");
			filter_bar.find('[type="text"].'+data_type+'2').attr("name", "");
			_this.parents('.form-group').attr('data-status', 0);
		}

		buttonDisabledstatus();
	})

	filter_bar.find('select').change(function(){
		var _this = $(this);
		var data_type = _this.parents('.form-group').attr('data-type');

		function condition1(){
			_this.attr('name', data_type);
			//filter_bar.find('[type="submit"]').removeClass('disabled');
			_this.parents('.form-group').attr('data-status', 1);
		}

		function condition2(){
			_this.removeAttr('name');
			//filter_bar.find('[type="submit"]').addClass('disabled');
			_this.parents('.form-group').attr('data-status', 0);
		}

		if(_this.val() == 0) {
			filter_bar.find('select').each(function(){
				if($(this).val() != 0) {
					condition1();
					return false;
				} else {
					condition2();
				}
			});
		} else {
			condition1();
		}

		buttonDisabledstatus();
	});

	filter_bar.find('[type="checkbox"]').change(function(){
		var _this = $(this);

		function condition1(){
			//filter_bar.find('[type="submit"]').removeClass('disabled');
			_this.parents('.form-group').attr('data-status', 1);
		}

		function condition2(){
			//filter_bar.find('[type="submit"]').addClass('disabled');
			_this.parents('.form-group').attr('data-status', 0);
		}

		if(!_this.is(":checked")) {
			filter_bar.find('[type="checkbox"]').each(function(){
				if($(this).is(":checked")) {
					condition1();
					return false;
				} else {
					condition2();
				}
			});
		} else {
			condition1();
		}

		buttonDisabledstatus();
	});

	filter_bar.find('[type="submit"]').addClass('disabled');
}

function onOff_status(caller, $url){
	$(caller).on('click', function(){
		var _this = $(this);
		var product_id = $(this).attr('product-id');
		var status = $(this).attr('data-status');

		$.ajax({
			url: $url,
			type: "post",
			data: {
				product_id: product_id,
				status: status
			},
			success: function(status){
				_this.attr('data-status', status);

				if(status == 1){
					_this.removeClass('btn-danger').addClass('btn-success');
					_this.find('.switch').removeClass('glyphicon-remove-sign').addClass('glyphicon-ok-sign');
				} else {
					_this.removeClass('btn-success').addClass('btn-danger');
					_this.find('.switch').removeClass('glyphicon-ok-sign').addClass('glyphicon-remove-sign');
				}
			},
			error: function(result){
				if(result.status == 401) {
					alert('You haven\'t permission.');
				}
			}
		})
	});
}

function response_footer(){
	var selector = $('footer');
	var body_height = $('body').height();
	var window_height = $(window).height();

    if(body_height < window_height) {
        selector.addClass('fixed-footer');
    } else {
        selector.removeClass('fixed-footer');
    }
}

function enable_disable_input(checkbox_button, text_input, reversibility = 1){
	// by default when page start
	if(checkbox_button.is(':checked') == reversibility){
		text_input.attr('disabled', 'disabled');
	} else {
		text_input.removeAttr('disabled');
	}

	checkbox_button.change(function(){
		if(checkbox_button.is(':checked') == reversibility){
			text_input.attr('disabled', 'disabled');
		} else {
			text_input.removeAttr('disabled');
		}
	})
}

// stander
function addCommas(nStr)
{
    nStr += '';
    x = nStr.split('.');
    x1 = x[0];
    x2 = x.length > 1 ? '.' + x[1] : '';
    var rgx = /(\d+)(\d{3})/;
    while (rgx.test(x1)) {
        x1 = x1.replace(rgx, '$1' + ',' + '$2');
    }
    return x1 + x2;
}


function tooltip_status(status){
    $('#left-nav [data-toggle="tooltip"]').unbind('mouseenter').bind('mouseenter', function(e){
        $(this).tooltip(status);
    });
}

function leftnav_resize_status(_this, has_resize_status, get_resize_status){
    var basic_status = has_resize_status ? get_resize_status : 'false';
    var leftNav = $("#left-nav");
    var content = $("#content");

    // default apply resize
    var default_accepted_resize_pages = [
        '/admin/translations'
    ]

    if(jQuery.inArray(window.location.pathname, default_accepted_resize_pages) !== -1) {
        basic_status = "true";
        leftNav.removeClass('col-md-3').addClass('col-md-1');
        content.removeClass('col-md-9').addClass('col-md-11');
    }

    if(basic_status == "true") {
        leftNav.find(".des").hide();
        leftNav.find(".list-group-item").css("text-align", "center");
        leftNav.find(".panel-heading")
            .css("text-align", "center").end()
            .find('.slide-toggle').hide();
        tooltip_status('show');
    } else {
        leftNav.find(".des").fadeIn(200);
        leftNav.find(".list-group-item").css("text-align", "left");
        leftNav.find(".panel-heading")
            .css("text-align", "left").end()
            .find('.slide-toggle').show();
        tooltip_status('hide');
    }
}

$(document).ready(function(){
	$('[data-toggle="tooltip"]').tooltip();

	$(window).load(function(){
		response_footer();
	});

	$('form :submit.delete').click(function(e) {
		if(!confirm('Are you sure?'))
			e.preventDefault();
	});

    $('.slide-toggle').click(function(e){
        e.preventDefault();
        $(this).parents('.panel').find('.panel-body').slideToggle(200);
        $(this).find('span').toggleClass('glyphicon-chevron-down glyphicon-chevron-up');
    });
});
