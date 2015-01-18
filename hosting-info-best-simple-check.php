<?php
/**
 Plugin Name: Best Wordpress Hosting - Check
 Plugin URI:
 Description: Information on your WordPress hosting
 Version: 1.0
 Author: <a href="http://www.seo101.net">Seo101</a>
 */

function wordpress_hosting_info_page() {
?>
<h4>Wordpress Hosting Information</h4>
<BR><BR>
<?php
		global $wpdb;
		$php_version = PHP_VERSION;
		$mysql_version = $wpdb->db_version();
		echo 'MYSQL VERSION = ' . $mysql_version . '<BR><BR>';
		echo 'PHP VERSION = ' . $php_version . '<BR><BR>';
		echo 'PHP INFO:' . '<BR>';
ob_start();
phpinfo();
preg_match ('%<style type="text/css">(.*?)</style>.*?(<body>.*</body>)%s', ob_get_clean(), $matches);
echo "<div class='classforinfodispl'><style type='text/css'>\n",
    join( "\n",
        array_map(
            create_function(
                '$i',
                'return ".classforinfodispl " . preg_replace( "/,/", ",.classforinfodispl ", $i );'
                ),
            preg_split( '/\n/', $matches[1] )
            )
        ),
    "</style>\n",
    $matches[2],
    "\n</div>\n";
}


function wordpress_hosting_info_menu() {
	if (is_admin()) {
		add_options_page('WP Hosting Info', 'WP Hosting Info', 'administrator','wordpress_hosting_info', 'wordpress_hosting_info_page');
	}
}

// Admin menu items
add_action('admin_menu', 'wordpress_hosting_info_menu');

?>