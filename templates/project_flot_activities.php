<div class="content">
	<?php
	
	$result = $wpdb->get_results( '
		SELECT SUM(orbis_hours_registration.number_seconds) AS total_seconds, orbis_activities.name AS activity_name, orbis_activities.id AS activity_id, orbis_projects.* 
		FROM orbis_hours_registration 
		LEFT JOIN orbis_activities ON(orbis_hours_registration.activity_id = orbis_activities.id)
		LEFT JOIN orbis_projects ON(orbis_hours_registration.project_id = orbis_projects.id)
		WHERE orbis_projects.post_id = '. get_the_ID() .' 
		GROUP BY orbis_activities.id
	' );
	
	$flot_data = array();
	
	foreach ( $result as $row ) {
		$label = sprintf( 
			'<strong>%s</strong> - %s',
			orbis_time( $row->total_seconds ),
			$row->activity_name
		);

		$flot_data[] = array(
			'label' => $label,
			'data'  => array(
				array( 0, $row->total_seconds )
			)
		);
	}

	$flot_options = array(
		'series' => array(
			'pie' => array(
				'innerRadius' => 0.5,
				'show'        => true
			)
		)
	);
	
	?>
	<div id="donut" class="graph" style="height: 400px; width: 100%;"></div>

	<?php orbis_flot( 'donut', $flot_data, $flot_options ); ?>
</div>