<?php
/*
Plugin Name: Query Debug Info
Plugin URI: http://onlinevortex.com/projects/query-debug-info/
Description: Adds information about the loop query and custom queries in the frontend
Version: 0.5
Author: Carlos Mendoza
Author URI: http://onlinevortex.com/

Copyright 2009 Carlos Mendoza (cmendoza@onlinevortex.com)

This program is free software; you can redistribute it and/or modify
it under the terms of the GNU General Public License as published by
the Free Software Foundation; either version 2 of the License, or
(at your option) any later version.

This program is distributed in the hope that it will be useful,
but WITHOUT ANY WARRANTY; without even the implied warranty of
MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
GNU General Public License for more details.

You should have received a copy of the GNU General Public License
along with this program; if not, write to the Free Software
Foundation, Inc., 59 Temple Place, Suite 330, Boston, MA  02111-1307  USA
*/


function debuginfo($label="Debug",$position=1,$query_object=NULL) {
if (!$query_object) {
global $wp_query;

$query_object = $wp_query;
$custom_query_object = 0;
}
if (current_user_can('level_8')) {
    if ($position == 1 ) {
    ?>
            <div class="constants panel">
                    <h3>Constants</h3>
                    <table>
                            <tbody>
    <?php
        foreach (array('WP_SITEURL', 'WP_HOME', 'WP_CONTENT_DIR', 'WP_CONTENT_URL', 'WP_PLUGIN_DIR', 'WP_PLUGIN_URL', 'PLUGINDIR', 'COOKIE_DOMAIN', 'TEMPLATEPATH', 'STYLESHEETPATH') as $const) {
                show_constant($const);
        }
    ?>
                            </tbody>
                    </table>
            </div>
    <a class="constants trigger" href="#">Constants</a>
    <?php

    }
    ?>
            <div class="<?= "pos-".$position; ?> panel">
                    <h2>Debug info for <?php echo $label; ?></h2>
                    <table>
                            <tbody>
    <?php
        echo "<tr><th colspan=\"2\"><h3>Page type</h3></th></tr>";
        foreach (array('is_single','is_preview','is_page','is_archive','is_date','is_year','is_month','is_day','is_time','is_author','is_category','is_tag','is_tax','is_search','is_feed','is_comment_feed','is_trackback','is_home','is_404','is_comments_popup','is_admin','is_attachment','is_singular','is_robots','is_posts_page','is_paged') as $is) {
                show_var($is, $query_object->$is, true);
        }
        if (is_array($query_object->query)) {
        echo "<tr><th colspan=\"2\"><h3>Query</h3></th></tr>";
        foreach ($query_object->query as $var => $val) {
                show_var($var, $val, true);
        }
        }
        if (isset($query_object->post_count))
                show_var('post_count', $query_object->post_count);
        if (isset($query_object->found_posts))
                show_var('found_posts', $query_object->found_posts);
        echo "<tr><th colspan=\"2\"><h3>Query vars</h3></th></tr>";
        foreach ($query_object->query_vars as $var => $val) {
                show_var($var, $val, true);
        }
        echo "<tr><th colspan=\"2\"><h3>SQL Query</h3></th></tr>
              <tr>
                <td colspan=\"2\">$query_object->request</td>
              </tr>";

    ?>
                            </tbody>
                    </table>
            </div>
    <a class="<?= "pos-".$position; ?> trigger" href="#"><?= $label; ?></a>
    <?php
}
}

function show_var($desc, $var, $onlytrue = false) {
	if ($onlytrue && !$var)
		return;
?>			<tr>
				<th><?php echo $desc; ?></th>
				<td><?php var_dump($var); ?></td>
			</tr>
<?php
}

function show_constant($constant) {
	if (!defined($constant)) {
?>			<tr>
				<th><?php echo $constant; ?></th>
				<td>Not defined</td>
			</tr>
<?php
	} else {
?>			<tr>
				<th><?php echo $constant; ?></th>
				<td><?php echo constant($constant); ?></td>
			</tr>
<?php
	}
}


wp_register_style('debuginfo', WP_PLUGIN_URL.'/querydebuginfo/debuginfo.css');
wp_enqueue_style( 'debuginfo');
wp_enqueue_script( 'debuginfojs', WP_PLUGIN_URL.'/querydebuginfo/debuginfo.js', array('jquery'));


?>
