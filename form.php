<?php

/*
  Plugin Name: Form
  Plugin URI: http://pc-moon.net
  Description: Hello , This's Plugin Created By AL-Jazaeri Mohammed
  Version: 1.0.0
  Author URI: http://pc-moon.net
 */
if (!defined('ABSPATH')) {
    header('HTTP/1.0 403 Forbidden');
    exit;
}

//start : activation
function myplugin_activate() {
    global $wpdb;

    $table_name1 = $wpdb->prefix . "foodrequests";
    $table_name2 = $wpdb->prefix . "regions";
    $table_name3 = $wpdb->prefix . "regionperm";
    $charset_collate = $wpdb->get_charset_collate();
    $sql1 = "
		CREATE TABLE IF NOT EXISTS {$table_name1} (
		   id  bigint(20) NOT NULL AUTO_INCREMENT,
		   title  varchar(250) DEFAULT NULL,
		   details  text,
		   foods  text,
		   email  varchar(100)  ,
		   mobile  varchar(20)  ,
		   address  text,
		   region  int(5) DEFAULT NULL,
		   created  timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
		   userid  int(11) NOT NULL DEFAULT 0,
		   finished  int(11) NOT NULL,
		  PRIMARY KEY ( id )
		) {$charset_collate};
		";
    $sql2 = "
		CREATE TABLE IF NOT EXISTS {$table_name2} (
		      id  int(11) NOT NULL AUTO_INCREMENT COMMENT 'التسلسل',
			  title  varchar(250) NOT NULL COMMENT 'الاسم', 
			  PRIMARY KEY ( id ) 
            ) {$charset_collate};
            ";
    $sql3 = "
            CREATE TABLE IF NOT EXISTS {$table_name3} (
            id int(4) NOT NULL AUTO_INCREMENT,
            rid int(11) NOT NULL,
            uid int(11) NOT NULL,
            PRIMARY KEY ( id )
            ) {$charset_collate};
            ";
    require_once( ABSPATH . 'wp-admin/includes/upgrade.php' );

    dbDelta($sql1);
    dbDelta($sql2);
    dbDelta($sql3);
}

register_activation_hook(__FILE__, 'myplugin_activate');

//end : activation 
//start : uninstall 
function myplugin_uninstall() {
    global

    $wpdb;
    $table_name1 = $wpdb->prefix . "foodrequests";
    $table_name2 = $wpdb->prefix . "regions";
    $table_name3 = $wpdb->prefix . "regionperm";


    $wpdb->query("DROP TABLE IF EXISTS {$table_name1},{$table_name2},{$table_name3}");
}

register_uninstall_hook(__FILE__, 'myplugin_uninstall');

//End : uninstall 
function shortcode_form($atts) {
    ob_start();
    require_once 'script/mainform.php';
    $c = forn_controller();
    $v = form_view();
    return $c.$v ;
}

add_shortcode('lf', 'shortcode_form');

//add menu


add_action('admin_menu', 'my_admin_menu');

function my_admin_menu() {
    
    add_menu_page('Left Food', 'Left Food\'s',   'manage_options', 'foodleft', 'mainpage', 'dashicons-tickets', 2);
    add_submenu_page('foodleft','Regions', 'Region\'s', 'manage_options', 'regions', 'regions' );
}

function mainpage(){include_once 'script/mainpage.php';pagemain();}
function regions(){include_once 'script/regions.php';pageregions();}
?>
