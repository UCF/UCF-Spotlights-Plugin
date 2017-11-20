# UCF Spotlights Plugin #

Provides a shortcode, functions, and default styles for displaying Spotlights.

## Description ##

Adds a new post type called Spotlights that can be added to pages using a `[ucf-spotlight]` shortcode. Spotlights may optionally contain a header, copy, link and featured image.

The `[ucf-spotlight]` shortcode has one option:
* slug - the slug of the spotlight to be displayed


## Installation ##

### Manual Installation ###
1. Upload the plugin files (unzipped) to the `/wp-content/plugins` directory, or install the plugin through the WordPress plugins screen directly.
2. Activate the plugin through the "Plugins" screen in WordPress

### WP CLI Installation ###
1. `$ wp plugin install --activate https://github.com/UCF/UCF-Spotlights-Plugin/archive/master.zip`.  See [WP-CLI Docs](http://wp-cli.org/commands/plugin/install/) for more command options.


## Changelog ##

### 2.0.0 ###
Enhancements:
* The markup generated for each Spotlight type has been modified to utilize Athena Framework classes.  The plugin now requires the Athena Framework to display Spotlights properly.

### 1.0.3 ###
Bug Fixes:
* Debug log cleanup

### 1.0.2 ###
Bug Fixes:
* Fixed shorthand PHP tag usage (thanks @strmtrpr83)

### 1.0.1 ###
Bug Fixes:
* Fixes [#3](https://github.com/UCF/UCF-Spotlights-Plugin/issues/3) by adding necessary variables and making `UCF_Spotlight_Common::enqueue_styles` static.
* Added comments.

### 1.0.0 ###
* Initial release


## Upgrade Notice ##

### 2.0.0 ###
The UCF-Spotlights-Plugin now requires the Athena Framework to display Spotlight styles properly.


## Installation Requirements ##

* Any theme that loads the Athena Framework


## Development & Contributing ##

NOTE: this plugin's readme.md file is automatically generated.  Please only make modifications to the readme.txt file, and make sure the `gulp readme` command has been run before committing readme changes.
