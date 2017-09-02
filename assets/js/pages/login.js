$(document).ready(function () {

	$('#submit').click(function () {

		var data = {
			'acc_user': $('#acc_user').val(),
			'acc_pass': $('#acc_pass').val()
		}
		var url = APP_PATH + 'index.php/ajax_login';

		$.post(url, data, function(result) {
			console.log(result);
			// console.log(result.result);
			if (result.result) {
				console.log('result is true');
			} else {
				console.log('result is false');
			}
		})
	})


})