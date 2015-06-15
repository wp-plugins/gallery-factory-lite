=== Gallery Factory Lite ===
Contributors: Vilyon
Donate link: http://galleryfactory.vilyon.net/
Tags: gallery manager, album, folder, gallery, grid layout, image, lightbox, metro layout, photo, portfolio, responsive, thumbnail, visual editor
Requires at least: 3.9.0
Tested up to: 4.2.2
Stable tag: 1.0.0
License: GPLv3
License URI: http://www.gnu.org/licenses/gpl.html

Great tool for managing large image collections with user-friendly album manager interface and visual layout builder.



== Description ==

Gallery Factory wordpress plugin is the new way to organize your image collection in WordPress. This plugin features the unique Gallery Manager interface, which combines all you need to work with your image galleries in one single place. It is easy to handle even for beginners, yet powerful enough for demanding users. Every piece of the plugin is built to be interactive and self-explaining – from organizing your albums in multi-level folder structure to creating unique layouts in WYSIWYG layout editor.

Gallery Factory stores uploaded images separate from the standard Wordpress location. So you can have huge image collections organized without bloating WP Media and leaving it for other purposes.

Images are organized in folders and albums only on logic level (not touching real folder structure on the disk), so any single image can be added to multiple albums while actually storing only one instance.

But Gallery Factory is not only about uploading and organizing you images: it features unique visual layout editor to help you create incredible galleries. You have two layout types to choose from: responsive grid layout and metro-style layout.

This is the Lite version of the full-featured Gallery Factory plugin, which is available at [CodeCanyon](http://codecanyon.net/item/gallery-factory/11219294).



Gallery Factory Lite is a plugin for managing image collections, creating albums and presenting them to the website visitors in a modern, responsive and good-looking layouts.
The main feature of a plugin is Gallery Manager, the ajax-driven interface for working with the plugin. It allows to organise albums in multi-level folder structure using simple and intuitive UI (this point most of existing gallery plugins are lacking).
The plugin offers two layouts to choose from Grid and Metro. Both layout types can be set up for an album using WYSIWYG layout editor.


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

GF do not create any custom table in the WordPress database. Instead it uses WordPress native tables and custom post types for storing its data. So any tool used for WordPress database import, export and migration should work for GF as well.

= How can I be sure that WordPress has the needed permission to create and write to `/wp-content/gf-uploads` folder? =

GF checks if it can create the `/wp-content/gf-uploads` folder and write to it. If this check fails, you will see the warning notice at the top of the page when you navigate to Gallery Manager.




== Screenshots ==

1. Gallery Manager page, `Unsorted images` folder activated.
2. Albums panel in edit mode, allowing to add, rename, delete and move your folders and albums.
3. Overview tab shows all images in the current album.
4. Layout tab features interactive WYSIWYG layout editor for the current album.
5. Album details edit tab allows to edit details and settings for the current album.
6. Image details dialog, including image metadata obtained from EXIF.




== Changelog ==

= 1.1.0 =
* First release of the Lite version.
