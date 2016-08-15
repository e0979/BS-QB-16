define(['globals', 'functions'], function(globals, Functions) {

	function buttonRender(actions, element, id){

		var buttons ='';
		actions.forEach(function(entry) {
		   	switch(entry){
		   		case "edit":
		   			buttons +='<button class="btn btn-sm btn-blue edit" data-element="'+element+'-'+id+'" title="Editar"><i class=\'fa fa-pencil\'></i></button> ';
		   			break;
		   		default: //view
		   			buttons +='<button class="btn btn-sm btn-info view" data-element="'+element+'-'+id+'" title="Ver"><i class=\'fa fa-search\'></i></button> ';
		   			break;
		   	}
		});
		return buttons;
	}

	return {
      buttonRender: buttonRender,
	}

});