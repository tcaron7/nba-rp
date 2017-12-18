jQuery(document).ready(function(){

	// Initialisation
	$('[id^="total"]').each(function() {
		var totalId    = $(this).attr( 'id' );
		var total      = 0;
		var inputClass = totalId.replace( /total/, '.player' );

		$(inputClass).each(function() {
			var value = $(this).val();
			if ($.isNumeric( value )) {
				total = parseInt(total) + parseInt(value);
			}
		});

		$('#' + totalId).text( "(" + total + ")" );
	});

	// When one input is changed, update total
	$('section.gameSheet input').change(function(){
		var inputClasses = $(this).attr( 'class' );
		var inputClass   = inputClasses.replace( /size2 /, '.' );
		var total        = 0;
		
		$(inputClass).each(function() {
			var value = $(this).val();
			if ($.isNumeric( value )) {
				total = parseInt(total) + parseInt(value);
			}
		});
		
		var totalId = inputClass.replace( /\.player/, '#total' );
		$(totalId).text( "(" + total + ")" );
	});

    $('section.preGameSheet input').change(function(){
		var inputClasses = $(this).attr( 'class' );
		var inputClass   = inputClasses.replace( /size2 /, '.' );
		var total        = 0;
		
		$(inputClass).each(function() {
			var value = $(this).val();
			if ($.isNumeric( value )) {
				total = parseInt(total) + parseInt(value);
			}
		});
		
		var totalId = inputClass.replace( /\.player/, '#total' );
		$(totalId).text( "(" + total + ")" );
	});


});