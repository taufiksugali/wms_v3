
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
			clearInput()


			$("#MPInboundId").html("<option>Select-Inbound</option>");
			$("#MPMaterialName").html("<option data-qty=''>Select-Material</option>");

			let name= "Put Material to pallet "+data['row_alias']+' '+data['row_number']+" > Block "+data['block_number'] ;
			$("#modalPalletTitle").html(name);
		},
		success: function (datax) {
			let result = JSON.stringify(datax);
			console.log(datax);
			$("#maxCapacity").val(data['max_capacity']);
			$("#max_capacity2").val(data['max_capacity']);
			// $("#availableCapacity").val(datax[0][0]['stok']);

			// inboundID
			let row = 0;
			for (var i = 0; i < (datax.length-1) ; i++) {
				if(datax[i].length > 0){
					$("#MPInboundId").append("<option value='"+datax[i][0]['inbound_id']+"'>"+datax[i][0]['inbound_id']+"</option>");					
				}
				row++;
			}
			// row = row +1;

			// console.log(datax[row]['stok']);
			$("#availableCapacity").val(data['max_capacity'] - datax[row]['stok'])
			$("#availCap").val(data['max_capacity'] - datax[row]['stok'])

			// inbounsID change
			$("#MPInboundId").change(function(){
				$("#MPMaterialName").html("<option data-qty=''>Select-Material</option>");				
				$("#MPMaterialQty").val('');
				clearInput();

				let id_inbound = $(this).val();
				for (var i = 0; i < datax.length ; i++) {
					if(datax[i].length > 0){
						for (var b = 0; b < datax[i].length ; b++) {
							if(datax[i][b]['inbound_id'] == id_inbound){
								$("#MPMaterialName").append("<option value='"+datax[i][b]['material_id']+"' data-qty='"+datax[i][b]['good_stok']+"' data-owner_id='"+datax[i][b]['owner_id']+"' data-batch='"+datax[i][b]['batch_no']+"' data-reafun_id='"+datax[i][b]['reafun_id']+"'>"+datax[i][b]['material_name']+" ["+datax[i][b]['batch_no']+"]"+"</option>");
							}
						}				
					}
				}
			});

			$("#MPMaterialName").change(function(){
				let selected = $(this).find('option:selected');
				let qty = selected.data('qty');
				let owner = selected.data('owner_id');
				let batch = selected.data('batch');
				let reafun_id = selected.data('reafun_id');
				$("#MPMaterialQty").val(qty);
				$("#owner_id").val(owner);
				$("#batchNumber").val(batch);
				$("#reafunId").val(reafun_id);
				console.log(qty);
			})

			$("#palletModal").modal('toggle');

		},
		error: function(datax){
			console.log(datax);
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
	let selected = $("#MPMaterialName").find('option:selected');

	let datapalet = {
		row_alias : $("#rowAlias").val(),
		row_number : $("#rowNumber").val(),
		block_number : $("#blockNumber").val(),
		inbound_id : $("#MPInboundId").val(),
		material_id : $("#MPMaterialName").val(),
		quantity_put : $("#quantityPut").val(),
		owner_id : $("#owner_id").val(), // ganti ambil dari material
		batch_number : $("#batchNumber").val(), // ganti ambil dari material
		reafun_id : $("#reafunId").val(), // ganti ambil dari material
		quantity_before : selected.data('qty'),// ganti ambil dari material
		available_capacity : $("#availCap").val(),
		max_capacity:$("#max_capacity2").val()
		
	};

	let json = JSON.stringify(datapalet);
	
	let valid = validasi(datapalet);

	if(valid == 'true'){
		execute(json)
		console.log(valid);
	}
	
}


function clearInput(){
	$("#quantityPut").val('');
	$("#batchNumber").val('');
	$("#owner_id").val('');
	$("#reafunId").val('');
}

function validasi(data){
	console.log(data['quantity_before']);
	switch (true){
		case (data['quantity_before'] == ''):
			Swal.fire('Choose the material first');
			return 'false';
			break;
		case (data['quantity_put'] == ''):
			Swal.fire('Quantity has not been set');
			return 'false';
			break;
		case (parseInt(data['quantity_put']) > parseInt(data['quantity_before']) ):
			Swal.fire('The quantity entered exceeds the material limit');
			return 'false';
			break;
		case (parseInt(data['quantity_put']) > parseInt(data['available_capacity'])):
			Swal.fire('The quantity entered exceeds the capacity limit');
			return 'false';
			break;
	}

	return 'true';
}

function execute(json){
	// console.log($(this))
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
							updateButton(json);
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

function updateButton(data){
	let result = JSON.parse(data);
	console.log(JSON.parse(data));
	let new_total_capacity = parseInt(result['max_capacity'])-(parseInt(result['available_capacity'])-parseInt(result['quantity_put']));

	console.log(new_total_capacity);
	let new_persen = (new_total_capacity/parseInt(result['max_capacity'])) * 100;
	let id = result['row_alias']+result['row_number']+'_'+result['block_number'];
	console.log(new_persen);
	console.log(id);
	$("#"+id).removeClass();
	$("#"+id).css("width",new_persen+"%");
	if(new_persen <= 50){
		$("#"+id).addClass('btn-progress-50');
	}else if(new_persen > 50 && new_persen <= 75){
		$("#"+id).addClass('btn-progress-75');
	}else if(new_persen > 75){
		$("#"+id).addClass('btn-progress-100');
	}

	let parent = $("#"+id).parent();
	parent.prop('title', new_persen.toString()+'%');
}