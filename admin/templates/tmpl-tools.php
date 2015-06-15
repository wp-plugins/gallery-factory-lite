<div class="wrap">
    <h2>Gallery Factory Tools</h2>

    <?php
    if (isset($_GET["status"]) && $_GET["status"] == 'done') {
        echo "<div class=\"updated\"><p>" . __('Images are successfully imported', VLS_GF_TEXTDOMAIN) . "</p></div>";
    }
    ?>

    <h3>Import from Wordpress Media</h3>

    <form id="vls-gf-form" action="admin-post.php" method="post">

        <input type="hidden" name="action" value="vls_gf_import_wp_media"/>

        <p>This feature imports all your Wordpress Media images to the Gallery Factory. All other
            attachment file types are ignored. The imported images will be added to the "Unsorted images" folder within
            Gallery Factory. The WP Media content is just copied during the import and remains untouched.</p>

        <p>Please note, that Gallery Factory uses its own uploads folder on server, so physical image files will be
            copied there from the original WP location. Make sure that you have enough disk space before proceeding with
            the import. The import
            procedure may take time, depending on your WP Media content size. Import can't be canceled once started, and
            the result is not undoable.</p>

        <?php submit_button("Import images from WP Media"); ?>

    </form>

    <script type="application/javascript">
        jQuery(function () {
            jQuery('#vls-gf-form input.button-primary').on('click', function () {
                var $this = jQuery(this);
                if (!$this.hasClass('button-disabled')) {
                    $this.addClass('button-disabled');
                    $this.val('<?php _e('Importing... Please do not reload this page until import is finished.', VLS_GF_TEXTDOMAIN) ?>');
                    jQuery('#vls-gf-form')[0].submit();
                }
                return false;
            });
        });
    </script>
</div>