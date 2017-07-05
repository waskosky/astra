<?php 
	/**
	 * Upgrade to Astra Pro
	*/
	// Register custom section types.
	$wp_customize->register_section_type( 'Astra_Pro_Customizer' );

	// Register sections.
	$wp_customize->add_section(
	    new Astra_Pro_Customizer(
	        $wp_customize,
	        'astra-pro',
	        array(
	            'title'    => esc_html__( 'Get Astra Pro', 'astra' ),
	            'pro_url'  => 'https://wpastra.com/pro/',
	            'priority' => 1,
	        )
	    )
	);