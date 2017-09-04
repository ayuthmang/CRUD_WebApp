$(document).ready(function () {

	$('#submit').click(function () {

		var data = {
			'acc_user': $('#acc_user').val(),
			'acc_pass': $('#acc_pass').val()
		}
		var url = APP_PATH + 'ajax_login';

		$.post(url, data, function(result) {
			console.log(result);

			if (result.result) {
				location.assign(result.redirect);				
			} else {
				swal(result.status_message, '', 'error');
			}
		}).fail(function (result) {
			console.log("ERROR: " + result);
		});
	})

})
