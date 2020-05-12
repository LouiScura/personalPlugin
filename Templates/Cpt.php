<div class="wrap">

    <h1>CPT Manager</h1>
    <?php settings_errors(); ?>

    <form method="post" action="options.php">
            <?php
                settings_fields( 'plural_plugin_cpt_settings' ); //option_group from settings
                do_settings_sections( 'plural_cpt' ); //page from section/menu_slug
                submit_button();
            ?>
    </form>

</div>
