<?php
/*
 * Plugin Name: buddybadges
 * Version: 1.0.0
 * Description: This is a badge OS plugin.
 * Author: techspawn1,jayesh pansare,kishor malji
 * Author URI: techspawn.com
 * Plugin URI: techspawn.com
 * Text Domain: buddybadges
 * License: GPL2
*/
/*  Copyright 2016-2017  Techspawn  (email : sales@techspawn.com)

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
    Foundation, Inc., 51 Franklin St, Fifth Floor, Boston, MA  02110-1301  USA
*/
/**
*
* Add a menu on setting 
*
**/
function ts_badgeos_menu() {
	add_options_page( 'buddybadge', 'buddybadge', 'manage_options', 'buddybadge', 'ts_badgeosaction' );
}
add_action( 'admin_menu', 'ts_badgeos_menu' );

/**
*
* Include a style and js on frendend as well as backend
*
**/
function ts_bb_enqueue_styles() {
  wp_enqueue_style( 'boostrap css', 'https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css' );
  wp_enqueue_script( 'boostrap js','https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js');
}
add_action( 'wp_enqueue_scripts', 'ts_bb_enqueue_styles' );
add_action('admin_enqueue_scripts', 'ts_bb_enqueue_styles');

/**
*
* Added a database 
* @Name is : buddybadge
* @version : 1.0.0
*
**/
function ts_bbadge_install() {
	global $bbadges_db_version;
	global $wpdb;
	$bbadges_db_version = '1.0';
	$table_name = $wpdb->prefix . 'buddybadge';
	$charset_collate = $wpdb->get_charset_collate();
	$sql = "CREATE TABLE $table_name (
		bbsrno mediumint(9) NOT NULL AUTO_INCREMENT,
		badgename varchar(255) DEFAULT '' NOT NULL,
		bbcount int(10) NOT NULL,
		bbImgUrl varchar(255) DEFAULT '' NOT NULL,
		bbtype varchar(255) DEFAULT '' NOT NULL,
		addedon datetime DEFAULT '0000-00-00 00:00:00' NOT NULL,
		UNIQUE KEY bbsrno (bbsrno)
	) $charset_collate;";
	require_once( ABSPATH . 'wp-admin/includes/upgrade.php' );
	dbDelta( $sql );
	add_option( 'bbadges_db_version', $bbadges_db_version );
}
register_activation_hook( __FILE__, 'ts_bbadge_install' );
/**
*
* Delete a table when deactivate a plugin.
*  
**/
function buddybadge_uninstall_plugin(){
    global $wpdb;
    $table_name = $wpdb->prefix . 'buddybadge';
    $wpdb->query("DROP TABLE IF EXISTS $table_name");
    delete_option( 'bbadges_db_version' );
}
register_uninstall_hook(__FILE__,'buddybadge_uninstall_plugin');

/**
*
* Include a backend file.
* When clicking on buddybadge from admin panel then only this page will call.  
**/
function ts_badgeosaction(){
	include('buddybadge.php');
	//plugin path required
}
/**
*
* getting all data in buddybadge table
* @not recently used
**/
function getAdminbadge(){
   global $wpdb;
   $tablename = $wpdb->prefix . 'buddybadge';
   $getAdminbadgedata = $wpdb->get_results( "SELECT * from $tablename Order by bbsrno" );
   return $getAdminbadgedata;
}

/**
*
* getting particular value in buddybadge table.
* @Used to edit from admin value.
**/
function getuniquevalue($userid){
   global $wpdb;
   $tablename = $wpdb->prefix . 'buddybadge';
   $getUniqueUserInfo = $wpdb->get_results( "SELECT * from $tablename Where bbsrno=".$userid." Order by bbsrno" );
   return $getUniqueUserInfo;
}

/**
*
* Create a short cut and manage a field.
* @ used for shortcode for all/post/comment/only one user.
**/
function displayAllBadgeUser($attr) {
   global $wpdb;
$attr = shortcode_atts( array(
		'bbuserid' => 'No user id',
		'bbtype'=>'post'
	), $attr, 'displayAllBadgeUser' );

$getuserinfobyname = get_userdatabylogin($attr['bbuserid']);
if(isset($getuserinfobyname->ID) && $getuserinfobyname->ID!=''){
$userid = $getuserinfobyname->ID; 
}else{
$userid = 1;
}

if(isset($attr['bbtype']) && trim($attr['bbtype'])=='No any type' || $attr['bbtype']=="" || trim($attr['bbtype'])=="post"){
	if(isset($attr['bbuserid']) && trim($attr['bbuserid'])=='No user id' || trim($attr['bbuserid'])==""){
		$objPostInfo = getPostInfo();
	}else{
		$objPostInfo = getUserPostInfo($userid);
	}
}else{
	if(isset($attr['bbuserid']) && trim($attr['bbuserid'])=='No user id' || trim($attr['bbuserid'])==""){
		$objPostInfo = getCommentInfo();
	}else{
		$objPostInfo = getUserCommentInfo($userid);
	}
	
}
$objBBInfo = getAdminbadgetype($attr['bbtype']);
?>
<div class="row">
<div class="col-sm-12 col-md-12">
<h4 class="text-center text-success"> Badges for <?php echo esc_html($attr['bbtype']); ?> </h4>
<?php foreach($objPostInfo as $resultPostInfo){ ?>
  <div class="col-sm-6 col-md-4 col-xs-12">
    <div class="thumbnail">
	<?php echo get_avatar($resultPostInfo->post_author); ?>
      <div class="caption text-center">
        <h3><?php $user_info = get_userdata($resultPostInfo->post_author); echo $user_info->user_login; ?></h3>
        <p style="height:35px;">
<?php foreach($objBBInfo as $resultbbInfo){
if($resultbbInfo->bbcount <= $resultPostInfo->postcount ){
echo '<img src="'.esc_url($resultbbInfo->bbImgUrl).'" width="35px" title="'.esc_html($resultbbInfo->badgename).'">';
} } ?>
</p>
      </div>
    </div>
  </div>
<?php } ?>
</div>
</div>
<?php
}
add_shortcode( 'displayAllBadgeUser', 'displayAllBadgeUser' );
/**
*
* getting all post count.
* @default is used or used for added a post type.
**/
function getPostInfo(){
global $wpdb;
$posttable = $wpdb->prefix.'posts';
$resultPostSql = $wpdb->get_results( 'select count(ID) as postcount, post_author from '.$posttable.' where post_status = "publish" AND post_type="post" group by post_author Order by postcount DESC' );
return $resultPostSql;
}

/**
*
* getting particular user post count.
* @according to user id getting post info.
**/
function getUserPostInfo($userid){
global $wpdb;
$posttable = $wpdb->prefix.'posts';
$resultUserPostSql = $wpdb->get_results( 'select count(ID) as postcount, post_author from '.$posttable.' where post_status = "publish" AND post_type="post" AND post_author='.$userid.' group by post_author Order by postcount DESC' );
return $resultUserPostSql;
}

/**
*
* Getting all comment info
* 
**/
function getCommentInfo(){
global $wpdb;
$Commenttable = $wpdb->prefix.'comments';
$resultCommentPostSql = $wpdb->get_results( 'SELECT count(comment_ID) as postcount, user_id as post_author FROM '.$Commenttable.' Where comment_approved = 1 AND user_id!=0 group by user_id order by postcount DESC' );
return $resultCommentPostSql;
}

/**
*
* Getting only user comment info
* @according to a user getting comment count
**/
function getUserCommentInfo($userid){
global $wpdb;
$Commenttable = $wpdb->prefix.'comments';
$resultUserCommentPostSql = $wpdb->get_results( 'SELECT count(comment_ID) as postcount, user_id as post_author FROM '.$Commenttable.' Where comment_approved = 1 AND user_id!=0 AND user_id='.$userid.' group by user_id order by postcount DESC' );
return $resultUserCommentPostSql;
}

/**
*
* getting value form table buddybadge according to a type
* 
**/
function getAdminbadgetype($bbtype){
   global $wpdb;
   $tablename = $wpdb->prefix . 'buddybadge';
   $getAdminbadgedata = $wpdb->get_results( "SELECT * from $tablename where bbtype='$bbtype' Order by bbsrno" );
   return $getAdminbadgedata;
}

/**
*
* Getting post and comment count 
* @only a user related count also 
**/
function getPostComment($commlimit,$userid){
if(isset($userid) && $userid=='0'){
	$objPostInfo = getPostInfo();
	$objcommInfo = getCommentInfo();
}else{
	$objPostInfo = getUserPostInfo($userid);
	$objcommInfo = getUserCommentInfo($userid);
}
	foreach ($objPostInfo as $key => $level){
		foreach ($objcommInfo as $key => $level1){
			if($level1->post_author == $level->post_author){
				$getcommentcount = ($level1->postcount)/$commlimit;
				$variables[$level1->post_author]['postcount'] = $level->postcount+round($getcommentcount);
				$variables[$level1->post_author]['post_author'] = $level1->post_author;
			}
		}
	}
return $variables;
}
/**
*
* For only a post and comment
*
**/
function displayPCBadgeUser($attr) {
   global $wpdb;
$attr = shortcode_atts( array(
		'bbuserid' => 'No user',
		'bbcommentlimit' => '1',
	), $attr, 'displayPCBadgeUser' );

$getuserinfobyname = get_userdatabylogin($attr['bbuserid']);
if(isset($getuserinfobyname->ID) && $getuserinfobyname->ID!=''){
$userid = $getuserinfobyname->ID; 
}else{
$userid ='1';
}
$objPostInfo = getPostComment($attr['bbcommentlimit'],$userid);
$objBBInfo = getAdminbadgetype('post and comment');
?>
<div class="row">
<div class="col-sm-12 col-md-12">
<h4 class="text-center text-success">Badges for post and comment </h4>
<?php
if(!empty($objPostInfo)){
 foreach($objPostInfo as $resultPostInfo){ ?>
  <div class="col-sm-6 col-md-4 col-xs-12">
    <div class="thumbnail">
	<?php echo get_avatar($resultPostInfo['post_author']); ?>
      <div class="caption text-center">
        <h3><?php $user_info = get_userdata($resultPostInfo['post_author']); echo $user_info->user_login; ?></h3>
        <p style="height:35px;">
<?php foreach($objBBInfo as $resultbbInfo){
if($resultbbInfo->bbcount <= $resultPostInfo['postcount'] ){
echo '<img src="'.esc_url($resultbbInfo->bbImgUrl).'" width="35px" title="'.esc_html($resultbbInfo->badgename).'">';
} } ?>
</p>
      </div>
    </div>
  </div>
<?php } } ?>
</div>
</div>
<?php
}
add_shortcode( 'displayPostCommentBadge', 'displayPCBadgeUser' );