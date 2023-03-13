<div class="wrap">
    <h1>CPT Manager</h1>
	<?php settings_errors(); ?>

    <form method="post" action="options.php">
		<?php
		settings_fields( "template_plugin_options_group" );
		do_settings_sections( "template_plugin_slug" );
		submit_button();
		?>
    </form>
</div>