const formatAxeResults = ( a11yResults ) => {
	const { violations } = a11yResults;
	if ( violations.length === 0 ) {
		return;
	}

	return violations.map( ( violation ) => {
		const selectors = violation.nodes.map( ( node ) => `"${ node.target }"` ).join( ', ' );
		return `[a11y] ${ violation.id }: ${ violation.description } (elements ${ selectors })`;
	} );
};

module.exports = formatAxeResults;