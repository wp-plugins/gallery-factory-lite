/* global ajaxurl */

"use strict";

var VLS_GF = VLS_GF || {};

/**
 * Module shows the quick-start tour
 */
VLS_GF.TourModule = (function ($) {

    var isActive = false,
        currentStep = 0,
        $wrap = $('#wpwrap'),
        $tour,
        $focus,
        blockNext = false;

    function start() {

        isActive = true;

        $('body').on('wheel.vls-gf mousewheel.vls-gf touchmove.vls-gf', function (e) {
            return false;
        });

        $tour = backdrop();
        $focus = $tour.find('.vls-gf-tour-focus');

        $wrap.append($tour);

        $tour.find('#vls-gf-tour-btn-close').on('click.vls-gf', close);
        $tour.find('#vls-gf-tour-btn-next').on('click.vls-gf', next);

        welcome();

    }

    function close() {

        isActive = false;

        $tour.remove();

        $('body').off('wheel.vls-gf mousewheel.vls-gf touchmove.vls-gf');

        //sending request to the server for disabling the tour
        $.post(
            ajaxurl,
            {
                action: 'vls_gf_disable_tour'
            }
        );

        //if we are closing on the last step, go to unsorted
        //if (currentStep < 0) {
        VLS_GF.AlbumsPanelModule.loadGalleryTree();
        $('.left-panel .fixed-items .unsorted a').trigger('click');
        //}
    }

    function next() {

        if (blockNext) return;

        currentStep++;
        $tour.find('.vls-gf-tour-progress span').eq(currentStep - 1).addClass('done');
        $tour.find('.vls-gf-tour-message').remove();

        switch (currentStep) {
            case 1:
                step1();
                break;
            case 2:
                step2();
                break;
            case 3:
                step3();
                break;
            case 4:
                step4();
                break;
            case 5:
                step5();
                break;
            case 6:
                step6();
                break;
            case 7:
                step7();
                break;
            case 8:
                step8();
                break;
            case 9:
                step9();
                break;
            case 10:
                step10();
                break;
            case 11:
                step11();
                break;
            case 12:
                step12();
                break;
            case 13:
                step13();
                break;
            case 14:
                step14();
                break;
            case 15:
                step15();
                break;
            case 16:
                step16();
                break;
            case 17:
                step17();
                break;
            case 18:
                step18();
                break;
            case 19:
                step19();
                break;
            case 20:
                step20();
                break;
        }
    }

    function welcome() {
        var $message = $('<div class="vls-gf-tour-welcome-message">');
        $message.append('<h1>Welcome to the Gallery Factory quick tour!</h1>');
        $message.append('<p>This tour will guide you through the basic plugin features.<br>To proceed to the next step press "Next" button at the bottom of the screen.</p>');
        $tour.append($message);
        $message.css({
            top: (Math.floor($tour.height() / 2) - Math.floor($message.height() / 2) - 100) + 'px',
            left: (Math.floor($tour.width() / 2) - Math.floor($message.width() / 2)) + 'px'
        });
    }

    //album panel overview
    function step1() {

        $tour.find('.vls-gf-tour-welcome-message').remove();

        var text = 'This is the Albums Panel. Here you can navigate your image collection and manage albums';
        setTip('.vls-gf-gallery-manager-container .left-panel', 'r', 210, text);

        setFocusOnElement('.vls-gf-gallery-manager-container .left-panel', 0, 0, 0, 0);


    }

    //navigating folders and albums
    function step2() {

        var text = "Expand the folder's contents by clicking on the folder.";
        setTip('.vls-gf-gallery-manager-container .left-panel', 'r', 200, text);

        blockNext = true;

        setTimeout(function () {
            $('#vls-gf-gallery-tree .folder.level-1:eq(0)').trigger('click');
            setTimeout(function () {
                $('#vls-gf-gallery-tree .folder.level-2:eq(1)').trigger('click');
                setTimeout(function () {
                    setFocusOnElement('#vls-gf-gallery-tree', 56, 0, 0, 0);
                    blockNext = false;
                }, 500);
            }, 500);
        }, 1500);

    }

    //edit mode - enter
    function step3() {

        var text = 'Add, sort, move, rename or delete folders and albums by activating edit mode.';
        setTip('#vls-gf-btn-edit-gallery-tree', 'r', 200, text);

        setFocusOnElement('#vls-gf-btn-edit-gallery-tree', 4, 4, 4, 4);

    }

    //edit mode - drag
    function step4() {

        $('#vls-gf-btn-edit-gallery-tree').trigger('click');

        setTimeout(function () {

            var text = 'Sort folders and albums and move them between folders by simply dragging them to the desired position.';
            setTip('#vls-gf-gallery-tree', 'r', 200, text);

            setFocusOnElement('#vls-gf-gallery-tree', 0, 0, 0, 0);

        }, 100);

    }

    //edit mode - add
    function step5() {

        var text = 'Add a folder or an album by clicking these buttons';
        setTip('#vls-gf-btn-add-new-album', 'r', 210, text);

        setFocusOnElement('#vls-gf-btn-add-new-folder', 0, 120, 0, 0);

    }

    //edit mode - rename
    function step6() {

        var text = 'To rename a folder or an album click these buttons.';
        setTip('#vls-gf-gallery-tree', 'r', 200, text);

        setFocusOnElement('#vls-gf-gallery-tree', 0, -29, 0, -195);

    }

    //edit mode - delete
    function step7() {

        var text = 'To delete a folder or an album click these buttons.';
        setTip('#vls-gf-gallery-tree', 'r', 200, text);

        setFocusOnElement('#vls-gf-gallery-tree', 0, 0, 0, -214);

    }

    //activating album, right panel
    function step8() {

        blockNext = true;

        setFocusOnElement('#vls-gf-gallery-tree', 0, 0, 0, 0);

        $('#vls-gf-btn-gallery-tree-cancel').trigger('click');
        setTimeout(function () {

            $('#vls-gf-gallery-tree .folder.level-1:eq(0)').trigger('click');
            setTimeout(function () {
                $('#vls-gf-gallery-tree .folder.level-2:eq(1)').trigger('click');
                setTimeout(function () {
                    $('#vls-gf-gallery-tree .album.level-3:eq(0)').trigger('click');

                    setTimeout(function () {

                        var text = 'This is the Main Panel. It displays the currently activated album and provides access to all album-related features.';
                        setTip('.vls-gf-right-panel', 'l', 200, text, 100);

                        setFocusOnElement('.vls-gf-right-panel', 0, 0, 0, 0);

                        blockNext = false;

                    }, 1000);
                }, 600);
            }, 600);

        }, 600);

    }

    //tabs
    function step9() {

        var text = 'There are three tabs available. Overview tab opens by default when you switch the active album.';
        setTip('#vls-gf-tab-panel', 'l', 200, text);

        setFocusOnElement('#vls-gf-tab-panel', 0, 0, 0, 0);

    }

    //album overview
    function step10() {

        var text = "Overview tab shows all album's images. Here you can upload and delete images, move them between albums and edit image's details.";
        setTip('.vls-gf-right-panel .vls-gf-tab-view', 'l', 200, text, 100);

        setFocusOnElement('.vls-gf-right-panel .vls-gf-tab-view', 0, 0, 0, 0);

    }

    //click on image to edit or drag to move
    function step11() {

        var text = 'Click on a thumbnail to open the image details editing dialog. Drag thumbnail to the album in the Albums Panel to move it to another album or to the "Unsorted images" folder.';
        setTip('.vls-gf-right-panel .vls-gf-image-panel li:eq(0)', 'r', 200, text);

        setFocusOnElement('.vls-gf-right-panel .vls-gf-image-panel li:eq(0)', 0, 0, 0, 0);

    }

    //image upload
    function step12() {

        var text = 'Upload images to the active album';
        setTip('#vls-gf-upload-image-button:parent', 'r', 200, text);

        setFocusOnElement('#vls-gf-upload-image-button:parent', 0, 0, 0, 0);

    }

    //bulk select
    function step13() {

        var text = 'Activate bulk select mode to enable selecting multiple images and moving or deleting them at once.';
        setTip('#vls-gf-bulk-select-start-button:parent', 'l', 200, text);

        setFocusOnElement('#vls-gf-bulk-select-start-button:parent', 0, 0, 0, 0);

    }

    //bulk select
    function step14() {

        var text = 'Click this tab to switch to the layout editor for the current album.';
        setTip('#vls-gf-tab-panel li:eq(1)', 'l', 200, text);

        setFocusOnElement('#vls-gf-tab-panel li:eq(1)', 0, 0, 0, 0);

    }

    //layout tab
    function step15() {

        blockNext = true;

        $('#vls-gf-tab-panel li:eq(1) a').trigger('click');
        setTimeout(function () {

            var text = 'Layout tab contains WYSIWYG layout editor fot the current album.';
            setTip('.vls-gf-right-panel .vls-gf-tab-view', 'l', 200, text, 100);

            setFocusOnElement('.vls-gf-right-panel .vls-gf-tab-view', 0, 0, 0, 0);

            blockNext = false;

        }, 1500);

    }

    //options panel
    function step16() {

        var text = 'Here you can set the layout options. The layout view is updated immediately on the change so you can see the result.';
        setTip('.vls-gf-tab-view .vls-gf-tab-container-side', 'l', 200, text);

        setFocusOnElement('.vls-gf-tab-view .vls-gf-tab-container-side', 6, 6, 6, 6);

    }

    //layout editor panel
    function step17() {

        var text = "You can move every thumbnail to the desired position by dragging the thumbnail. If layout type 'Metro' is selected, you can also freely change the size of the thumbnail by dragging the resize helpers at the thumbnails' edges";
        setTip('.vls-gf-tab-view .vls-gf-tab-container-layout', 'l', 200, text, 100);

        setFocusOnElement('.vls-gf-tab-view .vls-gf-tab-container-layout', 10, 10, 10, 10);

    }

    function step18() {

        var text = 'To switch to the album details click this tab.';
        setTip('#vls-gf-tab-panel li:eq(2)', 'l', 200, text);

        setFocusOnElement('#vls-gf-tab-panel li:eq(2)', 0, 0, 0, 0);

    }

    //album edit tab
    function step19() {

        blockNext = true;

        //setFocusOnElement('#vls-gf-tab-panel', 0, 0, 0, 0);

        $('#vls-gf-tab-panel li:eq(2) a').trigger('click');
        setTimeout(function () {

            var text = 'Edit tab contains albums details edit form.';
            setTip('.vls-gf-right-panel .vls-gf-tab-view', 'l', 200, text, 100);

            setFocusOnElement('.vls-gf-right-panel .vls-gf-tab-view', 0, 0, 0, 0);

            blockNext = false;

        }, 1500);

    }


    //shortcode
    function step20() {

        var text = "To insert an album to your post or page use the displayed shortcode.";
        setTip('.vls-gf-right-panel .vls-gf-shortcode', 'l', 200, text);

        setFocusOnElement('.vls-gf-right-panel .vls-gf-shortcode', 6, 6, 6, 6);

        lastStep();

    }

    function lastStep() {
        $tour.find('#vls-gf-tour-btn-close').remove();
        $tour.find('#vls-gf-tour-btn-next').text('Done').off().on('click.vls-gf', close);
        currentStep = -1;
    }

    function backdrop() {
        var $el = $('<div id="vls-gf-tour-backdrop">' +
        '<div class="vls-gf-tour-focus"></div>' +
        '<div class="vls-gf-tour-controls">' +
        '<div class="vls-gf-tour-progress"></div>' +
        '<button id="vls-gf-tour-btn-close">Skip the tour</button>' +
        '<button id="vls-gf-tour-btn-next">next</button>' +
        '</div></div>');


        var $progr = $el.find('.vls-gf-tour-progress');
        for (var i = 1; i <= 20; i++) {
            $progr.append('<span class="vls-gf-tour-step-' + i + '">');
        }

        return $el;
    }

    function setFocusOnElement(selector, offsetTop, offsetRight, offsetBottom, offsetLeft) {
        var $el = $(selector);
        var x = $el.offset().left;
        var y = $el.offset().top;
        var w = $el.outerWidth();
        var h = $el.outerHeight();
        $focus.css({
            left: (x - offsetLeft) + 'px',
            top: (y - offsetTop) + 'px',
            width: (w + offsetLeft + offsetRight) + 'px',
            height: (h + offsetTop + offsetBottom) + 'px'
        });
    }

    function setTip(target, pos, width, text, topOverride) {

        var $target = $(target);
        var $message = $('<div class="vls-gf-tour-message"></div>').text(text);
        if (pos === 'l') {
            $message.addClass('vls-gf-tour-message-left');
        } else if (pos === 'r') {
            $message.addClass('vls-gf-tour-message-right');
        }

        $message.css('width', width + 'px');
        $tour.append($message);

        if (topOverride > 0) {
            var top = $target.offset().top + topOverride;
        } else {
            var top = $target.offset().top + Math.ceil($target.outerHeight() / 2) - Math.ceil($message.outerHeight() / 2);
        }


        var left = 0;
        if (pos === 'l') {
            left = $target.offset().left - width - 40;
        } else if (pos === 'r') {
            left = $target.offset().left + $target.outerWidth() + 40;
        }

        $message.css({
            top: top + 'px',
            left: left + 'px'
        });
    }

    return {
        isActive: function () {
            return isActive;
        },
        start: start
    }

})(jQuery);