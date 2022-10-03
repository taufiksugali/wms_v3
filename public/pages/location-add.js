
$("#blockType").select2().change(function(){
	let blockType = $("#blockType").val();
	if(blockType == 'rack'){

		$("#rackField").css('display','block');
	}else{
		$("#rackField").css('display','none');
		$("#rackNumber").val('');
	}
})