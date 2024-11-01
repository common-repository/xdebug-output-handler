=== Xdebug Output Handler ===
Contributors: zerotop
Donate link: http://wordpress.zerotop.com/xdebug-output-handler
Tags: xdebug, debug
Requires at least: 3.0
Tested up to: 3.5-alpha-21751
Stable tag: 1.0

This WordPress Plugin collects the XDebug output and displayes it in the footer. Only use it with Xdebug extension for PHP activated

== Description ==

This WordPress Plugin collects the Xdebug output and displays it in the footer. It both works in the frontend and in the administrator interface of WordPress

Please make sure that you comply to the following dependencies:
*	have the Xdebug extension for PHP activated (zend_extension=/[path to libraries]/xdebug.so)
*	have defined your 'WP_DEBUG' as true (in wp_config.php) to see also Notices

This plugin does nothing with the profiler output of Xdebug. When Xdebug is enabled on your webserver, outputted errors will be expanded with a Call Stack which shows which calls led to the error. This plugin takes care of displaying these errors in a nice way.

== Installation ==

This section describes how to install the plugin and get it working.

1. Extract the `xdebug-outputhandler.zip` to the `/wp-content/plugins/` directory
2. Activate the plugin through the 'Plugins' menu in WordPress, its named `Xdebug Output Handler`
3. Enable the Xdebug extention on your webserver
4. Change define('WP_DEBUG', false) to define('WP_DEBUG', true) in wp-config.php to see also Notices

== Frequently Asked Questions ==

= Where can I find more information about Xdebug =

Please visit http://xdebug.org/index.php

= Where can I find more information about define('WP_DEBUG', false) =

Please visit http://codex.wordpress.org/Editing_wp-config.php#Debug

== Screenshots ==

1. This screen shot shows how the output of the plugin looks like. Please note that the output will be displayed on the bottom of your website

== Changelog ==

= 1.0 =
* First version
