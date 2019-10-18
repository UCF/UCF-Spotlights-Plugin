=== UCF Spotlights Plugin ===
Contributors: ucfwebcom
Tags: ucf, spotlights
Requires at least: 4.7.3
Tested up to: 5.2.4
Stable tag: 2.0.6
Requires PHP: 5.4
License: GPLv3 or later
License URI: http://www.gnu.org/copyleft/gpl-3.0.html

Provides a custom post type, shortcode and functions for displaying Spotlights.

== Description ==

Adds a new post type called Spotlights that can be added to pages using a `[ucf-spotlight]` shortcode. Spotlights may optionally contain a header, copy, link and featured image.

The `[ucf-spotlight]` shortcode has one option:
* slug - the slug of the spotlight to be displayed


== Installation ==

= Manual Installation =
1. Upload the plugin files (unzipped) to the `/wp-content/plugins` directory, or install the plugin through the WordPress plugins screen directly.
2. Activate the plugin through the "Plugins" screen in WordPress

= WP CLI Installation =
1. `$ wp plugin install --activate https://github.com/UCF/UCF-Spotlights-Plugin/archive/master.zip`.  See [WP-CLI Docs](http://wp-cli.org/commands/plugin/install/) for more command options.


== Changelog ==

= 2.0.6 =
Enhancements:
* Added Github Updater support.

Bug fixes:
* Added `d-block` class to links surrounding vertical and square Spotlights to ensure an appropriate outline is always visible when those links are focused via keyboard.

= 2.0.5 =
Enhancements:
* Added `role="note"` to `<aside>` elements in each Spotlight layout to remove ARIA landmark associations.

= 2.0.4 =
Bug Fixes:
* Disabled archives by default.

= 2.0.3 =
Bugfixes:
* Fixed output of `[ucf-spotlight]` when the requested spotlight post does not exist

= 2.0.2 =
Enhancements:
* Added minor accessibility improvements to square and vertical spotlight layouts
* Removed faux buttons from square spotlights if a Link URL isn't provided

Bug Fixes:
* Fixed issue with spotlight meta fields not allowing empty values to be saved

= 2.0.1 =
Enhancements:
* Added missing plugin description

= 2.0.0 =
This release contains breaking changes from v1.0.3 and older.  Please review notes below before upgrading:

Enhancements:
* Updates the plugin to remove all fallback styles.  The plugin now requires using a theme that loads the Athena Framework.
* The plugin options page in the WordPress admin has been removed, since there are no longer any configurable plugin-level settings.
* Adds a unique layout hook for each layout (`ucf_spotlight_display_square`, `ucf_spotlight_display_horizontal`, and `ucf_spotlight_display_vertical`), replacing the previous `ucf_spotlight_display` hook that handled all three.
* Adds new layout-specific thumbnail sizes that are sized appropriately for the given layout (`ucf-spotlight-square`, `ucf-spotlight-horizontal`, and `ucf-spotlight-vertical`).
* Adds minor markup adjustments to each spotlight for consistency across each layout, to take advantage of Athena classes, and to fix some minor bugs (e.g. hover states).  All spotlights are now wrapped in an `<aside>` tag, and the horizontal layout no longer includes top-level closing divs (these can be handled at the theme level if needed).

= 1.0.3 =
Bug Fixes:
* Debug log cleanup

= 1.0.2 =
Bug Fixes:
* Fixed shorthand PHP tag usage (thanks @strmtrpr83)

= 1.0.1 =
Bug Fixes:
* Fixes [#3](https://github.com/UCF/UCF-Spotlights-Plugin/issues/3) by adding necessary variables and making `UCF_Spotlight_Common::enqueue_styles` static.
* Added comments.

= 1.0.0 =
* Initial release


== Upgrade Notice ==

= 2.0.0 =
The UCF-Spotlights-Plugin now requires the Athena Framework to display Spotlight styles properly. Please see release notes for v2.0.0 for other breaking changes.


== Installation Requirements ==

* Any theme that loads the Athena Framework


== Development & Contributing ==

NOTE: this plugin's readme.md file is automatically generated.  Please only make modifications to the readme.txt file, and make sure the `gulp readme` command has been run before committing readme changes.
