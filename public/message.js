(function($){

	var Message = function(el){

		var action = $(el).attr('data-action')

		if (action == 'send'){
			$(el).click(this.send)
		}
	}

	Message.DEFAULTS = {}

	Message.prototype.send = function(e){
		e.stopPropagation();

		var $this = $(this);
		var target = $this.attr('data-target');
		var message = $(target).val();

		if (message == ''){
			return;
		}

		$.ajax({
			type: "PUT",
			accepts: "application/json; charset=utf-8",
			url: $this.attr('href'),
			data: {'_token' : Message.DEFAULTS.token, 'message' : message}
		})
		.done(function(response){
			if (response.error){
				var message = '<div class="alert alert-warning">';
				message += '<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>'
				message += '<p>'+response.message+'</p></div>'

				$('messages').html(message)
			}
			else {
				$('.message-list .list-group').prepend(response.message)

			}

			$(target).val('');

			window.setTimeout(function() {
				$(".alert").alert('close')
			}, 10000);
		})

		//$('#message-modal').modal('hide')
		return false;
	}

	$.fn.message = function(options){
		Message.DEFAULTS = options

		this.each(function(){
			new Message($(this))
		})
	}

})(jQuery);