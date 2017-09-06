var columns = [
	{id: 'prod_id', name: '#'},
	{id: 'name', name: 'Name'},
	{id: 'detail', name: 'Detail'},
	{id: 'picture', name: 'Picture'},
	{id: 'price', name: 'Price'},
	{id: 'piece', name: 'Piece'},
];

$('document').ready(function () {
	init_table();
	refresh_table();

	window.tb_content = $("#datatable-responsive tbody");

	$('#btn_refresh').click(function () {
		refresh_data();
	})

	$('#btn_delete').click(function () {
		del_product();
	})
})

function init_table() {
	var tb_parent = $('#datatable-responsive');
	tb_parent.html('');
	var str = '';
	str += ('<thead><tr>');
	for (var i = 0; i < columns.length; i++) {
		str += ('<th>' + columns[i]['name'] + '</th>');
	}
	str += ('</tr></thead>');
	str += ('<tbody></tbody>');
	tb_parent.append(str);
}

function add_data_to_table(data) {
	console.log(data);
	var str = '<tr>';
	for (var i = 0; i < columns.length; i++) {
		str += '<td>';
		str += data[columns[i]['id']];
		str += '</td>';
	}
	str += '</tr>';
	tb_content.append(str);
}

function refresh_data() {

	var url = APP_PATH + 'ajax_get_all_products';
	var data = {prod_id: 'all'};
	$.post(url, data, function (result) {
		console.log(result); // dbg
		if (result.result) {
			tb_content.html('');
			for (var i = 0; i < result.data.length; i++) {
				add_data_to_table(result.data[i]);
			}
		} else {
			swal(result.status_message, '', 'error');
		}

	}).fail(function (result) {
		console.log("ERROR: " + result);
	});
}

function refresh_table() {
	refresh_data();
}

/**
 * delete segment
 */
function del_product() {

	var url = APP_PATH + 'ajax_delete_product';
	var data = {
		prod_id: $('#prod_id').val(),
		// prod_name: $('#prod_name').val()	
	};
	console.log(data);
	$.post(url, data, function (result) {
		console.log(result); // dbg
		if (result.result) {
			swal('ทำการลบ Product สำเร็จ', '', 'success');
			refresh_table();
		} else {
			swal(result.status_message, '', 'error');
		}

	}).fail(function (result) {
		console.log("ERROR: " + result);
	});
}