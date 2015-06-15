<div class="vls-gf-page">
    <?php foreach ($page_data as $row_data) { ?>
        <div class="vls-gf-row">
            <?php foreach ($row_data as $image) { ?>
                <div class="vls-gf-item vls-gf-item-<?php echo $col_count ?>">
                    <div style="<?php echo $image->spacings_style ?>">
                        <a <?php echo 'href="' . $image->url . '"'; ?>
                           style="<?php echo $image->a_style ?>">
                            <img
                                class="<?php echo $image->img_class; ?>"
                                src="<?php echo $image->url_preview_m; ?>"
                                alt="<?php echo $image->alt_text; ?>"/>
                            <div class="vls-gf-info-back">
                                <h2 class="vls-gf-info-caption"><?php echo $image->caption ?></h2>
                                <div class="vls-gf-info-description"><?php echo $image->description ?></div>
                            </div>
                        </a>
                    </div>
                </div>
            <?php } ?>
        </div>
    <?php } ?>
</div>
