( function( api ) {

	// Extends our custom "prolific" section.
	api.sectionConstructor['prolific'] = api.Section.extend( {

		// No events for this type of section.
		attachEvents: function () {},

		// Always make the section active.
		isContextuallyActive: function () {
			return true;
		}
	} );

} )( wp.customize );