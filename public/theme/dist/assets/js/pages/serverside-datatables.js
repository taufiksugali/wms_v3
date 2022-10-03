var handleDataTableServerSide = function() {
	"use strict";
    
	if ($('#data-table-server-side').length !== 0) {
		var protocol = $(location).attr('protocol');
		var host = $(location).attr('host');
		var url = $(location).attr('href').split('/');
        var value = url[3].split('?');

		$.getJSON(protocol + '//' + host + '/' + value[0] + '/getColumns',function(column){
			console.log(protocol + '//' + host + '/' + value[0] + '/getColumns');
			$('#data-table-server-side').DataTable({
				processing: true,
				serverSide: true,
				ajax: {
					type: "POST",
					url: protocol + '//' + host + '/' + value[0] + '/getData',
					dataType: "json"
				},
				columns: column
			});
        });
	}
};

var TableManageServerSide = function () {
	"use strict";
	return {
		//main function
		init: function () {
			handleDataTableServerSide();
		}
	};
}();

$(document).ready(function() {
	TableManageServerSide.init();
});

var handleDataTableServerSideScrollX = function() {
	"use strict";
    
	if ($('#data-table-server-side-scrollx').length !== 0) {
		var protocol = $(location).attr('protocol');
		var host = $(location).attr('host');
		var url = $(location).attr('href').split('/');
        var value = url[3].split('?');

		$.getJSON(protocol + '//' + host + '/' + value[0] + '/getColumns',function(column){
			// console.log(column);
			$('#data-table-server-side-scrollx').DataTable({
				processing: true,
				serverSide: true,
				scrollX: true,
				ajax: {
					type: "POST",
					url: protocol + '//' + host + '/' + value[0] + '/getData',
					dataType: "json"
					// ,
					// success: function(data){
					// 	console.log(data);
					// },error: function(data){
					// 	console.log(data);
					// }
				},
				columns: column
			});
        });
	}
};

var TableManageServerSideScrollX = function () {
	"use strict";
	return {
		//main function
		init: function () {
			handleDataTableServerSideScrollX();
		}
	};
}();

$(document).ready(function() {
	TableManageServerSideScrollX.init();
});