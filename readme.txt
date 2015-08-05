=== Gallery Factory Lite ===
Contributors: Vilyon
Donate link: http://galleryfactory.vilyon.net/
Tags: gallery manager, album, folder, gallery, grid layout, image, lightbox, metro layout, photo, portfolio, responsive, thumbnail, visual editor
Requires at least: 3.9.0
Tested up to: 4.2.3
Stable tag: 1.1.2
License: GPLv3
License URI: http://www.gnu.org/licenses/gpl.html

Great tool for managing large image collections with user-friendly album manager interface and visual layout builder.



== Description ==

Gallery Factory Lite is a WordPress plugin for managing image collections, creating albums and presenting them to the website visitors in modern, responsive and attractive way.

The main feature of the plugin is Gallery Manager, the ajax-driven interface which keeps almost everything that you need to work with your WordPress image gallery in one place. It allows to organise albums in multi-level folder structure using simple and intuitive UI, like in your favourite file manager.

The plugin offers two layouts to choose from: Grid and Metro. Both layout types can be designed using WYSIWYG layout editor.

This is the Lite version of the full-featured premium Gallery Factory plugin, which is available at [CodeCanyon](http://codecanyon.net/item/gallery-factory/11219294). Lite version is 100% forward-compatible with the premium version, so you can upgrade at any time.

= Features =
* Tree-like albums structure allowing albums to be grouped in folders and subfolders (Lite version is limited to 3 levels of this hierarchy)*
* Dedicated file upload location (keeps Gallery Factory uploads separate from the WP Media files)
* Responsive Grid layout
* Metro layout with the unmatched customizing possibilities.
* WYSIWYG layout editor
* Importing of image EXIF metadata on upload
* Custom image thumbnail cropping
* Easy image import from WP Media and migration from NextGen Gallery
* Modern, fast & responsive
* Localization-ready (English and Russian languages included)



== Installation ==

= Using Wordpress plugin manager =
1. Go to the WordPress `Plugins` menu
2. Press `Add New`
3. Find the `Gallery Factory` plugin
4. Click `Install Now`
5. Click `Activate plugin`


= Manual upload =
1. Upload `gallery-factory` folder and all its contents to the `/wp-content/plugins/` directory
2. Activate the plugin through the `Plugins` menu in WordPress


== Frequently Asked Questions ==

= Where does Gallery Factory store images? =

GF uses its own folder located at `/wp-content/gf-uploads`

= Does Gallery Factory use custom database tables? =

GF does not create any custom table in the WordPress database. Instead it uses WordPress native tables and custom post types for storing its data. So any tool used for WordPress database import, export and migration should work for Gallery Factory as well.

= How can I be sure that WordPress has the needed permission to create and write to `/wp-content/gf-uploads` folder? =

GF checks if it can create the `/wp-content/gf-uploads` folder and write to it. If this check fails, you will see the warning notice at the top of the page when you navigate to Gallery Manager.



== Screenshots ==

1. Gallery Manager page, `Unsorted images` folder activated.
2. Albums panel in edit mode, allowing to add, rename, delete and move your folders and albums.
3. Overview tab shows all images in the current album.
4. Layout tab features interactive WYSIWYG layout editor for the current album.
5. Album details edit tab allows to edit details and settings for the current album.
6. Image details dialog, including image metadata obtained from EXIF and custom thumbnail cropping.



== Changelog ==

= 1.1.2 =
* Feature: added customizable cropping of image thumbnails.
* Feature: added localization support, English & Russian included
* Feature: data import from NextGen Gallery

= 1.1.1 =
* Fix: a bug with Metro layout display.

= 1.1.0 =
* First release of the Lite version.