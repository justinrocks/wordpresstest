<?php 
/**
* Plugin Name: Online Exam Module
* Plugin URI: https://simpleintelligentsystems.com/
* Description: This plugin will help to perform online exams.
* Version: 1.0.0
* Author: Simple Intelligent Systems
* Author URI: https://simpleintelligentsystems.com/
*/

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

register_activation_hook( __FILE__, 'online_exam_module_activate' );
register_deactivation_hook( __FILE__, 'online_exam_module_deactivate' );

//function to perform some action when plugin is activated
function online_exam_module_activate(){
    global $wpdb;
    global $table_prefix;
    $table = $table_prefix.'exam_list';
    $sql = 'CREATE TABLE '.$table.' ( `exam_id` INT NOT NULL AUTO_INCREMENT , `exam_name` VARCHAR(500) NOT NULL , `date_created` DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP ,  PRIMARY KEY (`exam_id`)) ENGINE = InnoDB;';
    $wpdb->query($sql);
}

//function to delete plugin created tables when plugin is deactivated
function online_exam_module_deactivate(){
    global $wpdb;
    global $table_prefix;
    $table = $table_prefix.'exam_list';
    $sql = 'DROP table '.$table;
    $wpdb->query($sql);
}

//adding menu in the backend to identify the module sections
add_action( 'admin_menu', 'online_exam_admin_menu_setup' );
function online_exam_admin_menu_setup(){
    add_menu_page( 'Online Exam Module', 'Online Exam Module', 8, __FILE__, 'online_exam_dashobard' );
}

//function to display 
function online_exam_dashobard(){
    include('exam_list.php');
}

?>