<div class="wrap">
	<h2>Plural Plugin</h2>
	<?php settings_errors(); ?>

	<div class="tab-content">

		<ul class="nav-tabs">
			<li class="tab-pane active"><a href="#tab-1">Manage options</a></li>
			<li class="tab-pane"><a href="#tab-2">Updates</a></li>
			<li class="tab-pane"><a href="#tab-3">About</a></li>
		</ul>

		<div id="tab-1" class="tab-pane active">
			<form method="post" action="options.php">
				<?php 
					settings_fields( 'plural_plugin_group' );
					do_settings_sections( 'plural_plugin' );
					submit_button();
				?>	
			</form>
		</div>

		<div id="tab-2" class="tab-pane">
			<h3>Updates</h3>
		</div>

		<div id="tab-3" class="tab-pane">
			<h3>About</h3>
		</div>
		
	</div>

</div>