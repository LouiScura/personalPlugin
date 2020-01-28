<div class="wrap">
	<h2>Plural Plugin</h2>
	<?php settings_errors(); ?>

	<form method="post" action="options.php">
		<?php 
			settings_fields( 'plural_plugin_group' );
			do_settings_sections( 'plural_plugin' );
			submit_button();
		?>
	</form>
</div>