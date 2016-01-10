//--------------------------//
// THEME PART:	Dynamically fill repeater selection fields with data
//-----------------------------------------------------//
// ACF page for reference: http://www.advancedcustomfields.com/resources/dynamically-populate-a-select-fields-choices/
add_filter('acf/load_field/name=build_repeat_section_name', 'acf_load_builderOptions_field_choices');
function acf_load_builderOptions_field_choices( $field ) {
	
	// reset choices
	$field['choices'] = array();
	
	// get the textarea value from options page without any formatting
	$choices = get_field('field_build_add_textarea', 'option', false);
	
	// explode the value so that each line is a new array piece
	$choices = explode("\n", $choices);
	
	// remove any unwanted white space
	$choices = array_map('trim', $choices);
	
	// set default sub pages
	global $optionPage; // load default options page choices
	$field['choices']['Default Sections'] = $optionPage;
	
	// loop through array and add to field 'choices'
	if( is_array($choices) ) {
		foreach( $choices as $choice ) : if ($choice) :
			$field['choices']['Custom Sections'][ $choice ] = $choice;
		endif; endforeach;
	};


	// return the field
	return $field;
	
}
