acf.add_action('ready', function( $el ){
	var $field = $('#my-wrapper-id');
	acf.add_action('show_field', function( $field, context ){
		
		// context is a string of either 'tab' or 'conditional_logic'
		
		// do something to $field
		
	});
	
});

