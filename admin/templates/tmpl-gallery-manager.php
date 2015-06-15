<div class="wrap">
	<h2 class="vls-gf-gallery-manager-header"><?php _e( 'Gallery Manager', 'vls_gallery_factory' ) ?></h2>

	<div
		class="vls-gf-lite-notice"><?php _e( 'You are using the Lite version of the Gallery Factory plugin, offering just basic features.<br>The full-featured version is available at <a href="http://codecanyon.net/item/gallery-factory/11219294">CodeCanyon</a>.', 'vls_gallery_factory' ) ?></div>
	<div class="clear"></div>
    <div class="vls-gf-gallery-manager-container">

        <div class="left-panel">
            <div class="header">
                <span><?php _e('Albums', 'vls_gallery_factory') ?></span>
                <a class="fold-button" hter="#"></a>
            </div>

            <ul class="fixed-items">
                <li class="all"><a href="#all_images"><span class="icon"></span><span
                            class="label"><?php _e('All images', 'vls_gallery_factory') ?></span></a></span>
                </li>
                <li class="unsorted"><a href="#unsorted_images"><span class="icon"></span><span
                            class="label"><?php _e('Unsorted images', 'vls_gallery_factory') ?></span></a><span
                        class="wp-ui-highlight"></li>
            </ul>

            <ul id="vls-gf-gallery-tree">
                <div class="vls-gf-loading-overlay"><span></span></div>
            </ul>

            <a id="vls-gf-btn-edit-gallery-tree" href="#"><span
                    class="icon"></span><?php _e('Edit list', 'vls_gallery_factory') ?></a>

            <div id="vls-gf-panel-edit-gallery-tree">
                <div>
                    <button id="vls-gf-btn-add-new-folder" href="#"><span
                            class="icon"></span><?php _e('Add folder', 'vls_gallery_factory') ?></button>
                    <button id="vls-gf-btn-add-new-album" href="#"><span
                            class="icon"></span><?php _e('Add album', 'vls_gallery_factory') ?></button>
                </div>
                <div>
                    <button id="vls-gf-btn-gallery-tree-commit" class="button-primary"
                            href="#"><?php _e('Save changes', 'vls_gallery_factory') ?></button>
                    <button id="vls-gf-btn-gallery-tree-cancel"
                            href="#"><?php _e('Cancel', 'vls_gallery_factory') ?></button>
                </div>
            </div>

        </div>

        <div class="vls-gf-right-panel">
            <div class="vls-gf-window-title">
                <span><?php _e('Unsorted images', 'vls_gallery_factory') ?></span>
                <span class="vls-gf-shortcode">shortcode:&nbsp;<input type="text" readonly="" value=""/>
                </span>
            </div>
            <div id="vls-gf-tab-panel">
                <ul>
                    <li>
                        <a href="#album_overview"><?php _e('Overview', 'vls_gallery_factory') ?></a>
                        <span class="wp-ui-highlight"></span>
                    </li>
                    <li>
                        <a href="#album_layout"><?php _e('Layout', 'vls_gallery_factory') ?></a>
                        <span class="wp-ui-highlight"></span>
                    </li>
                    <li>
                        <a href="#album_edit"><?php _e('Edit', 'vls_gallery_factory') ?></a>
                        <span class="wp-ui-highlight"></span>
                    </li>
                </ul>
            </div>
            <div class="vls-gf-tab-view">

            </div>
        </div>

    </div>
</div>