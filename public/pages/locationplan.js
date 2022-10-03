
$(".modal-pallet").click(function(){

	let data = {
		loc_id : $(this).data('loc_id'),
		wh_id : $(this).data('wh_id'),
		block_type : $(this).data('block_type'),
		row_alias : $(this).data('row_alias'),
		row_number : $(this).data('row_number'),
		block_number : $(this).data('block_number'),
		uom_standard : $(this).data('uom_standard'),
		max_capacity : $(this).data('max_capacity')
	};

	let json = JSON.stringify(data);

	var protocol = $(location).attr('protocol');
	var host = $(location).attr('host');
	var url = $(location).attr('href').split('/');
	var value = url[3].split('?');

	$.ajax({
		url: protocol + '//' + host + '/' + value[0] + '/modalPallet',
		type: 'post',
		data: {'json': json},
		dataType: 'json',
		beforeSend: function(){
			$("#rowAlias").val(data['row_alias']);
			$("#rowNumber").val(data['row_number']);
			$("#blockNumber").val(data['block_number']);

			$("#MPInboundId").html("<option>Select-Inbound</option>");

			let name= "Put Material to pallet "+data['row_alias']+' '+data['row_number']+" > Block "+data['block_number'] ;
			$("#modalPalletTitle").html(name);
		},
		success: function (datax) {
			let result = JSON.stringify(datax);
			console.log(datax);
			$("#maxCapacity").val(data['max_capacity']);


			// inboundID
			for (var i = 0; i < datax.length ; i++) {
				if(datax[i].length > 0){
					$("#MPInboundId").append("<option value='"+datax[i][0]['inbound_id']+"'>"+datax[i][0]['inbound_id']+"</option>");					
				}
			}

			// inbounsID change
			$("#MPInboundId").change(function(){
				$("#MPMaterialName").html("<option data-qty='0'>Select-Material</option>");
				$("#MPMaterialQty").val('');

				let id_inbound = $(this).val();
				for (var i = 0; i < datax.length ; i++) {
					if(datax[i].length > 0){
						for (var b = 0; b < datax[i].length ; b++) {
							if(datax[i][b]['inbound_id'] == id_inbound){
								$("#MPMaterialName").append("<option value='"+datax[i][b]['material_id']+"' data-qty='"+datax[i][b]['good_stok']+"' data-owner_id='"+datax[i][b]['owner_id']+"'>"+datax[i][b]['material_name']+"</option>");
							}
						}				
					}
				}
			});

			$("#MPMaterialName").change(function(){
				let selected = $(this).find('option:selected');
				let qty = selected.data('qty');
				let owner = selected.data('owner_id');
				$("#MPMaterialQty").val(qty);
				$("#owner_id").val(owner);
				console.log(qty);
			})

			$("#palletModal").modal('toggle');

		}
	});
})

$(".modal-rack").click(function(){

	let data = {
		loc_id : $(this).data('loc_id'),
		wh_id : $(this).data('wh_id'),
		block_type : $(this).data('block_type'),
		row_alias : $(this).data('row_alias'),
		row_number : $(this).data('row_number'),
		block_number : $(this).data('block_number'),
		uom_standard : $(this).data('uom_standard')

	};
	let json = JSON.stringify(data);
	$("#rackModal").modal('toggle');
	console.log(data);
})


function closeModal(id){
	$(id).modal('toggle');
}


function savePalet(){
	let datapalet = {
		row_alias : $("#rowAlias").val(),
		row_number : $("#rowNumber").val(),
		block_number : $("#blockNumber").val(),
		inbound_id : $("#MPInboundId").val(),
		material_id : $("#MPMaterialName").val(),
		quantity_put : $("#quantityPut").val(),
		owner_id : $("#owner_id").val(),
	};

	let json = JSON.stringify(datapalet);
	console.log(json);
	Swal.fire({
		title: 'Do you want to save the changes ?',
		showDenyButton: true,
		showCancelButton: true,
		confirmButtonText: 'Save',
		denyButtonText: `Don't save`,
	}).then((result) => {
		/* Read more about isConfirmed, isDenied below */
		if (result.isConfirmed) {
			var protocol = $(location).attr('protocol');
			var host = $(location).attr('host');
			var url = $(location).attr('href').split('/');
			var value = url[3].split('?');
			$.ajax({
					url: protocol + '//' + host + '/' + value[0] + '/savePalet',
					type: 'post',
					data: {'json': json},
					dataType: 'json',
					success: function (data) {
						console.log(data);
						Swal.fire('Saved!', '', 'success').then((result) =>{
							if(result.isConfirmed){
								$("#palletModal").modal('toggle');
							}else{
								$("#palletModal").modal('toggle');
							}
						})
					},error: function(data){
						console.log(data);
					}
				});
		} else if (result.isDenied) {
			Swal.fire('Changes are not saved', '', 'info')
		}
	})
}