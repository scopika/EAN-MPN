$(document).ready(function(){
	// submit du formulaire
	$('.eanmpn_valider').click(function() {
		$(this).parents('form:eq(0)').submit();
		return false;
	});
});
