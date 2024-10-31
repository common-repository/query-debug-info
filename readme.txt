=== Query debug info ===
Contributors: carlosmendoza
Donate link: https://www.paypal.com/cgi-bin/webscr?cmd=_s-xclick&hosted_button_id=8245725
Tags: debug, query, queries, sql, wp_query, development
Requires at least: 2.8
Tested up to: 2.8.x
Stable tag: 0.5

Adds information about the loop query and custom queries in the frontend

== Description ==

Adds information about the query to the front end, including page type, post count, query vars, the query string and the
wordpress sites constants

You can track up to 3 queries with this plugin, usefull to debug custom loops.

== Installation ==

* Upload the file to your server and extract it in the `/wp-content/plugins/` directory
* Activate the plugin through the 'Plugins' menu in WordPress

= Usage =

* Add the function call `<?php if (function_exists('debuginfo')) { debuginfo("Main"); }?>` in your template to display information about the main query
* Add additional calls `<?php if (function_exists('debuginfo')) { debuginfo("Secondary",2); }?>` after creating a new WP_Query object,
if you want to track a specific variable you can pass it to the function, example:
    <?php $my_query = new WP_Query("showposts=3&category_name=Featured&order=DESC"); ?>
    <?php if (function_exists('debuginfo')) { debuginfo("Secondary",2,$my_query); }?>
* The information is only displayed if you are logged in as an administrator.

== Screenshots ==

1. Displaying the information of the default query for the homepage
2. Displaying the query information for a custom query

== Changelog ==

= 0.5 =
* Initial release of the plugin.

