<?php
/**
*
* Template Name :- admin added 
* @Created by jayesh
* @Date 22 feb 2015
* 
**/
?>
<div class="col-md-12 col-sm-12 col-xs-12" style="background: #fff;">
<div class="row">
<?php 
/**
*
* Admin badge added form 
* Include a badge name, img, count. 
**/
?>
<div class="col-md-6 col-sm-6 col-xs-12">
<?php if(!isset($_GET['edit']) && trim($_GET['edit'])==''){ ?>
<!--
-
- Add form
-
-->
<form action="#" method="POST" name="bb_add_badges" enctype="multipart/form-data" id="addform">
	<!--
	-
	- Title for form 
	-
	-->
	<h2> Add a badge </h2> 

	<?php if(wp_verify_nonce( $_REQUEST['successmeg'], 'success_badge')){ ?>        
		<p class="alert alert-success text-center"><?php _e('Your badge is submitted successfully.'); ?> </p>
	<?php } ?>
	<?php if(wp_verify_nonce( $_REQUEST['_wpsuccessedit'], 'success_edit')){ ?>        
	<p class="alert alert-success text-center"><?php _e('Your badge is updated successfully.'); ?> </p>
	<?php } ?>
	<?php if(wp_verify_nonce( $_REQUEST['_wpdelete'], 'success_delete')){ ?>        
	<p class="alert alert-success text-center"><?php _e('Your badge is deleted successfully.'); ?> </p>
	<?php } ?>
	<!--
	-
	- End of title for form 
	- Enter Badge name
	-->
	<div class="form-group">
	<label for="name"> <?php _e('Enter badge name'); ?> </label>
	<input type="text" name="bbname" placeholder="Enter badge name" class="form-control badgename">

	<!--
	-
	- error message 
	-
	-->
		<?php if(isset($_GET['errormessage']) && trim($_GET['errormessage'])=='10' && wp_verify_nonce( $_REQUEST['_wpaddname'], 'error_badge_name')){ ?>        
		<p class="alert alert-danger text-center"> <span class="glyphicon glyphicon-alert"></span> <?php _e('Please enter badge name.'); ?> </p>
		<?php } ?>
	<!--
	-
	- End of error message 
	-
	-->
	</div>
	<!--
	-
	- End Badge name
	- select a image
	- 
	-->

	<div class="form-group">
		<label for="badge name"> <?php _e('Select a badge image'); ?></label>
		<input type="file" name="bbimg" placeholder="Select your badge image" class="form-control">
		<!--
		-
		- Error message
		-
		-->
		<?php if(isset($_GET['errormessage']) && trim($_GET['errormessage'])=='11' && wp_verify_nonce( $_REQUEST['_wpaddimgname'], 'error_badge_img_name')){ ?>
		<p class="alert alert-danger text-center"> <span class="glyphicon glyphicon-alert"></span> <?php _e('Please select file.'); ?></p>
		<?php } ?>
		<!--
		-
		- Error message
		-
		-->
	</div>

	<!--
	-
	- End of select a image
	- Enter Badge point
	--> 
	<div class="form-group">
		<label for="Point"> <?php _e('Enter badge point'); ?> </label>
		<input type="text" name="bbcount" placeholder="Enter badge point" class="form-control">
			<!--
			-
			- Error message
			-
			-->
			<?php if(isset($_GET['errormessage']) && trim($_GET['errormessage'])=='12' && wp_verify_nonce( $_REQUEST['_wpaddcount'], 'error_badge_count')){ ?>
				<p class="alert alert-danger text-center"> <span class="glyphicon glyphicon-alert"></span> <?php _e('Please enter point.'); ?></p>
			<?php } ?>
			<!--
			-
			- End of error message
			-
			-->
	</div>
	<!--
	-
	- End of enter badge point
	- Select a badge type
	-->
	<div class="form-group">
	  <label for="sel1"><?php _e('Select badge type'); ?></label>
	  <select class="form-control" name="bbadgetype">
	    <option value="post"><?php _e('post'); ?></option>
	    <option value="comment"><?php _e('Comment'); ?></option>
	    <option value="Post and Comment"><?php _e('Post and Comment'); ?></option>
	  </select>
	</div>
	<!--
	-
	- end of select a badge type
	-
	-->
<?php wp_nonce_field( 'jaddform', 'j_add_form' ); ?>
<input type="submit" value="Added to" name="submit" class="btn btn-success" id="submitAddForm">
</form>
<!--
-
- End of add form
-
-->
<?php }else{ 
if ( wp_verify_nonce( $_REQUEST['_wpedit'], 'edit_badge' ) ) {
?>
<!--
-
- Edit form
-
-->
<?php 
$editUserInfo = getuniquevalue($_GET['edit']);
foreach($editUserInfo as $resultUserInfo){
?>

<form action="" method="POST" name="bb_add_badges" enctype="multipart/form-data">
	<!--
	-
	- Title
	-
	-->
	<h2> <?php _e('Edit a badge'); ?></h2>
	<!--
	-
	- End of title
	- Enter badge name
	-->
	<div class="form-group">
		<label for="name"> <?php _e('Enter badge name'); ?> </label>
		<input type="text" name="bbeditname" placeholder="Enter badge name" class="form-control" value="<?php echo esc_html($resultUserInfo->badgename); ?>">
		<!--
		-
		- Error Message
		-
		-->
		<?php if(isset($_GET['errormessage']) && trim($_GET['errormessage'])=='10' && wp_verify_nonce( $_REQUEST['_wpeditname'], 'error_edit_name')){ ?>        
		<p class="alert alert-danger text-center"> <span class="glyphicon glyphicon-alert"></span><?php _e('Please enter badge name'); ?></p>
		<?php } ?>
		<!--
		-
		- End of error Message
		-
		-->
	</div>
	<!--
	-
	- End of enter badge name
	- Select a file
	-->
	
	<div class="form-group">
		<label for="badge name"> <?php _e('Select a badge image'); ?></label>
		<input type="file" name="bbeditimg" placeholder="Select your badge image" class="form-control">
	<img src="<?php echo esc_url($resultUserInfo->bbImgUrl); ?>" width="25%">
	</div>

	<!--
	-
	- End of Select a file
	- Enter your point
	-->
	<div class="form-group">
		<label for="Point"> <?php _e('Enter your point'); ?> </label>
		<input type="text" name="bbeditcount" placeholder="Enter your point" class="form-control" value="<?php echo esc_html($resultUserInfo->bbcount); ?>">
		<!--
		-
		- Error Meassage
		-
		-->
		<?php if(isset($_GET['errormessage']) && trim($_GET['errormessage'])=='12' && wp_verify_nonce( $_REQUEST['_wpeditcount'], 'error_edit_count')){ ?>
			<p class="alert alert-danger text-center"> <span class="glyphicon glyphicon-alert"></span><?php _e('Please enter point.'); ?> </p>
		<?php } ?>
		<!--
		-
		- End of error Meassage
		-
		-->
	</div>
	<!--
	-
	- End of enter your point
	- Select post type 
	-->
	<div class="form-group">
	  <label><?php _e('Select badge type'); ?></label>
	  <select class="form-control" name="bbeditadgetype">
	    <option value="post" <?php echo ($resultUserInfo->bbtype=='post')? 'selected':''; ?>><?php _e('Post'); ?></option>
	    <option value="comment" <?php echo ($resultUserInfo->bbtype=='comment')? 'selected':''; ?>><?php _e('Comment'); ?></option>
<option value="Post and Comment" <?php echo ($resultUserInfo->bbtype=='Post and Comment')? 'selected':''; ?>><?php _e('Post and Comment'); ?></option>
	  </select>
	</div>
	<!--
	-
	- End of select post type
	- User id for update  
	-->
	<input type="hidden" value="<?php echo esc_html($resultUserInfo->bbsrno); ?>" name="userid">
	<!--
	-
	- End of user id for update
	- old Image url
	-->
	<?php if(isset($resultUserInfo->bbImgUrl) && $resultUserInfo->bbImgUrl!=''){ ?>
	<input type="hidden" value="<?php echo esc_url($resultUserInfo->bbImgUrl); ?>" name="editimgurl">
	<?php }else{ ?>
	<input type="hidden" value="" name="imgurl">
	<?php } ?>
	<!--
	-
	- End of old image url
	-
	-->
	<?php wp_nonce_field( 'jeditform', 'j_edit_form' ); ?>
	<input type="submit" value="edit" name="submit" class="btn btn-success">
</form>
<?php } ?>
<!--
-
- End of edit form
-
-->
<?php } } ?>

<!--
-
- Description of shortcode
-
-->
<br />
<br />
<br />
<div class="well well-sm">
<ul class="nav nav-tabs">
   <h3> <?php _e('Description of shortcode'); ?> </h3>
  <li class="active"><a data-toggle="tab" href="#all"><?php _e('All shortcode'); ?></a></li>
  <li><a data-toggle="tab" href="#post"><?php _e('Post shortcode'); ?></a></li>
  <li><a data-toggle="tab" href="#comment"><?php _e('Comment'); ?></a></li>
  <li><a data-toggle="tab" href="#postandcomment"><?php _e('Post and Comment'); ?></a></li>
</ul>

<div class="tab-content">
  <div id="all" class="tab-pane fade in active">
    <h4> <?php _e('Description of all shortcode'); ?> </h4>
    <p> <?php _e('To display all badges on use a [displayAllBadgeUser] shortcode. Default badges is post badges. This is apply only for post or comment.'); ?> </p>
    <p> <?php _e('To display all badges on use a [displayPostCommentBadge] shortcode.  This is apply only for post and comment.'); ?> </p>
  </div>
  <div id="post" class="tab-pane fade">
    <h4> <?php _e('Description for post'); ?> </h4>
    <p> <?php _e('To show only post related badges use a shortcode [displayAllBadgeUser bbtype="post"]. This code display all the user regarding to post'); ?> </p>
    <p> <?php _e('To show only perticular user related post badges use a shortcode [displayAllBadgeUser bbuserid="User name" bbtype="post"]. This code display only perticular user realated post badge'); ?> </p>
  </div>
  <div id="comment" class="tab-pane fade">
   <h4> <?php _e('Description for Comment'); ?> </h4>
    <p> <?php _e('To show only comment related badges use a shortcode [displayAllBadgeUser bbtype="comment"]. This code display all the user regarding to comment'); ?> </p>
    <p> <?php _e('To show only perticular user related comment badges use a shortcode [displayAllBadgeUser bbuserid="User name" bbtype="comment"]. This code display only perticular user realated comment badge'); ?> </p>
  </div>
  <div id="postandcomment" class="tab-pane fade">
   <h4> <?php _e('Description for post and Comment'); ?> </h4>
    <p> <?php _e('To show both post and comment related badges use a shortcode [displayPostCommentBadge bbcommentlimit="1"]. This code display all the user regarding to post and comment'); ?> </p>
    <p> <?php _e('To show only perticular user related post and comment badges use a shortcode [displayPostCommentBadge bbuserid="user name" bbcommentlimit="1"]. This code display only perticular user realated post and comment badge.
Here  "bbcommentlimit" is used for dividing total comment to bbcommentlimit and round number is used for deciding for count. if you increate a "bbcommentlimit" then the comment count decrease'); ?></p>
  </div>
</div>
</div>
<!--
-
- End of description of shortcode
-
-->

</div>
<?php 
/**
*
* End of admin badge added form 
*
* Display a badge by post
*  
**/
?>
<div class="col-md-6 col-sm-6 col-xs-12">
<div class="col-md-12 col-sm-12 col-xs-12">
	<h3><?php _e('Badges for post'); ?></h3>
	<table class="table table-bordered">
		<tr>
			<th> <?php _e('Sr no.'); ?> </th>
			<th> <?php _e('Badge name'); ?> </th>
			<th> <?php _e('Badge image'); ?> </th>
			<th> <?php _e('Badge count'); ?> </th>
			<th> <?php _e('Edit'); ?> </th>
			<th> <?php _e('Delete'); ?> </th>
		</tr>
		<?php 
		$nonce_delete = wp_create_nonce( 'delete_badge' );
		$nonce_edit = wp_create_nonce( 'edit_badge' );
		$i=1;
		$resFormBadge = getAdminbadgetype('post');
		if (!empty($resFormBadge)) {
		foreach($resFormBadge as $resultFormBadge){
		?>
			<tr id="del_<?php echo $resultFormBadge->bbsrno; ?>">
			<td><?php echo $i; ?></td>
			<td><?php echo esc_html($resultFormBadge->badgename); ?></td>
			<td><img src="<?php echo esc_url($resultFormBadge->bbImgUrl); ?>" width="25%"></td>
			<td><?php echo esc_html($resultFormBadge->bbcount); ?></td>
			<td><a href="<?php echo esc_url(site_url()); ?>/wp-admin/options-general.php/?page=buddybadge&_wpedit=<?php echo $nonce_edit; ?>&edit=<?php echo esc_html($resultFormBadge->bbsrno); ?>" title="Edit"><span class="glyphicon glyphicon-pencil"></span></a></td>
			<td><a href="<?php echo admin_url(); ?>/options-general.php?page=buddybadge&_wpnonce=<?php echo $nonce_delete; ?>&delete=<?php echo esc_html($resultFormBadge->bbsrno); ?>"><span class="glyphicon glyphicon-trash" title="delete"></span></a></td>
			</tr>
		<?php
		$i++;
		}
		}else{
		?>
		<tr><th colspan="6" class="text-center text-danger"><?php _e('Sorry, No badge for post.'); ?></th></tr>
		<?php
		}
		?>
	</table>
</div>
<?php 
/**
*
* End of display a badge by post
* Display a badges for comment  
**/
?>
<div class="col-md-12 col-sm-12 col-xs-12">
	<h3><?php _e('Badges for comment'); ?></h3>
	<table class="table table-bordered">
		<tr>
			<th> <?php _e('Sr no.'); ?> </th>
			<th> <?php _e('Badge name'); ?> </th>
			<th> <?php _e('Badge image'); ?> </th>
			<th> <?php _e('Badge counts'); ?> </th>
			<th> <?php _e('Edit'); ?> </th>
			<th> <?php _e('Delete'); ?> </th>
		</tr>
		<?php
		$nonce_delete = wp_create_nonce( 'delete_badge' ); 
		$i=1;
		$resFormBadge = getAdminbadgetype('comment');
		if (!empty($resFormBadge)) {
		foreach($resFormBadge as $resultFormBadge){
		?>
			<tr>
			<td><?php echo $i; ?></td>
			<td><?php echo esc_html($resultFormBadge->badgename); ?></td>
			<td><img src="<?php echo esc_url($resultFormBadge->bbImgUrl); ?>" width="25%"></td>
			<td><?php echo esc_html($resultFormBadge->bbcount); ?></td>
			<td><a href="<?php echo esc_url(site_url()); ?>/wp-admin/options-general.php/?page=buddybadge&_wpedit=<?php echo $nonce_edit; ?>&edit=<?php echo esc_html($resultFormBadge->bbsrno); ?>" title="edit"><span class="glyphicon glyphicon-pencil"></span></a></td>
			<td><a href="<?php echo esc_url(admin_url()); ?>/options-general.php?page=buddybadge&_wpnonce=<?php echo $nonce_delete; ?>&delete=<?php echo esc_html($resultFormBadge->bbsrno); ?>"><span class="glyphicon glyphicon-trash" title="delete"></span></a></td>
			</tr>
		<?php
		$i++;
		}
		}else{
		?>
		<tr><th colspan="6" class="text-center text-danger"><?php _e('Sorry, No badge for comment.'); ?></th></tr>
		<?php
		}
		?>
	</table>
</div>
<?php
/**
*
* End of display badge by comment
* Display badge by post and comment
**/
?>
<div class="col-md-12 col-sm-12 col-xs-12">
	<h3><?php _e('Badges for post and comment'); ?></h3>
	<table class="table table-bordered">
		<tr>
			<th> <?php _e('sr no.'); ?> </th>
			<th> <?php _e('Badge name'); ?> </th>
			<th> <?php _e('Badge image'); ?> </th>
			<th> <?php _e('Badge counts'); ?> </th>
			<th> <?php _e('Edit'); ?> </th>
			<th> <?php _e('Delete'); ?> </th>
		</tr>
		<?php 
		$nonce_delete = wp_create_nonce( 'delete_badge' );
		$i=1;
		$resFormBadge = getAdminbadgetype('post and comment');
		if (!empty($resFormBadge)) {
		foreach($resFormBadge as $resultFormBadge){
		?>
			<tr>
			<td><?php echo $i; ?></td>
			<td><?php echo esc_html($resultFormBadge->badgename); ?></td>
			<td><img src="<?php echo esc_url($resultFormBadge->bbImgUrl); ?>" width="25%"></td>
			<td><?php echo esc_html($resultFormBadge->bbcount); ?></td>
			<td><a href="<?php echo esc_url(site_url()); ?>/wp-admin/options-general.php/?page=buddybadge&_wpedit=<?php echo $nonce_edit; ?>&edit=<?php echo esc_html($resultFormBadge->bbsrno); ?>" title="edit"><span class="glyphicon glyphicon-pencil"></span></a></td>
			<td><a href="<?php echo esc_url(admin_url()); ?>/options-general.php?page=buddybadge&_wpnonce=<?php echo $nonce_delete; ?>&delete=<?php echo esc_html($resultFormBadge->bbsrno); ?>"><span class="glyphicon glyphicon-trash" title="delete"></span></a></td>
			</tr>
		<?php
		$i++;
		}
		}else{
		?>
		<tr><th colspan="6" class="text-center text-danger"><?php _e('Sorry, No badge for post and comment.'); ?></th></tr>
		<?php
		}
		?>
	</table>
</div>
</div>
<?php
/**
*
* End of display badge by post and comment
*
**/
?>
</div>
</div>
<?php
if ( ! function_exists( 'wp_handle_upload' ) ){ 
    require_once( ABSPATH . 'wp-admin/includes/file.php' );
}
global $wpdb;
/**
*
* added form value
*
**/
if ( isset( $_POST['j_add_form']) || wp_verify_nonce( $_POST['j_add_form'], 'jaddform')) {
if(isset($_POST['submit']) && trim($_POST['submit'])=='Added to'){

if(isset($_POST['bbname']) && trim($_POST['bbname'])==''){
	$nonce_add_name = wp_create_nonce( 'error_badge_name' );
	echo '<script>window.location.href="'.admin_url().'/options-general.php?page=buddybadge&_wpaddname='.$nonce_add_name.'&errormessage=10";</script>';
	exit();
}

if(isset($_FILES['bbimg']['name']) && trim($_FILES['bbimg']['name'])==''){
	$nonce_add_img_name = wp_create_nonce( 'error_badge_img_name' );
	echo '<script>window.location.href="'.admin_url().'/options-general.php?page=buddybadge&_wpaddimgname='.$nonce_add_img_name.'&errormessage=11";</script>';
	exit();
}

$arrayimgtype = array(IMAGETYPE_PNG, IMAGETYPE_JPEG, IMAGETYPE_GIF);
$exitimgType = exif_imagetype($_FILES['bbimg']['tmp_name']);
$errormessage = !in_array($exitimgType, $arrayimgtype);
if(isset($errormessage) && $errormessage==1){
	$nonce_add_img_name = wp_create_nonce( 'error_badge_img_name' );
	echo '<script>window.location.href="'.admin_url().'/options-general.php?page=buddybadge&_wpaddimgname='.$nonce_add_img_name.'&errormessage=11";</script>';
	exit();
}
if(isset($_POST['bbcount']) && trim($_POST['bbcount'])==''){
	$nonce_add_count = wp_create_nonce( 'error_badge_count' );
	echo '<script>window.location.href="'.admin_url().'/options-general.php?page=buddybadge&_wpaddcount='.$nonce_add_count.'&errormessage=12";</script>';
	exit();
}
if (!is_numeric($_POST['bbcount'])){
	$nonce_add_count = wp_create_nonce( 'error_badge_count' );
	echo '<script>window.location.href="'.admin_url().'/options-general.php?page=buddybadge&_wpaddcount='.$nonce_add_count.'&errormessage=12";</script>';
	exit();
}

$upload_overrides = array( 'test_form' => false );
$buddybadgefile = wp_handle_upload( $_FILES['bbimg'], $upload_overrides );
$buddybadge_add = $wpdb->prefix."buddybadge";

$buddybadge_data = array(
	'badgename' => sanitize_text_field($_POST['bbname']),
	'bbImgUrl'  => $buddybadgefile['url'],
	'bbcount'   => intval($_POST['bbcount']),
	'bbtype'   => sanitize_text_field($_POST['bbadgetype']),
	'addedon'   => current_time('mysql')
);
$buddybadge_insert = $wpdb->insert($buddybadge_add,$buddybadge_data);
$success_add = wp_create_nonce( 'success_badge' );
echo '<script>window.location.href="'.admin_url().'/options-general.php?page=buddybadge&successmeg='.$success_add.'";</script>';
}
}
/**
*
* End of added form value
*
**/
/**
*
* Edit a form
*
**/
if ( isset( $_POST['j_edit_form'] ) || wp_verify_nonce( $_POST['j_edit_form'], 'jeditform' ) ) {

if(isset($_POST['submit']) && trim($_POST['submit'])=='edit'){
$nonce_edit = wp_create_nonce( 'edit_badge' );
if(isset($_POST['bbeditname']) && trim($_POST['bbeditname'])==''){
$error_edit_name = wp_create_nonce( 'error_edit_name' );
echo '<script>window.location.href="'.admin_url().'/options-general.php?page=buddybadge&_wpedit='.$nonce_edit.'&_wpeditname='.$error_edit_name.'&edit='.esc_html($_POST['userid']).'&errormessage=10";</script>';
exit();
}

if(isset($_POST['bbeditcount']) && trim($_POST['bbeditcount'])==''){
$error_edit_count = wp_create_nonce( 'error_edit_count' );
echo '<script>window.location.href="'.admin_url().'/options-general.php?page=buddybadge&_wpedit='.$nonce_edit.'&_wpeditcount='.$error_edit_count.'&edit='.esc_html($_POST['userid']).'&errormessage=12";</script>';
exit();
}

$tablename = $wpdb->prefix."buddybadge";
if(isset($_FILES['bbeditimg']['name']) && trim($_FILES['bbeditimg']['name'])!=''){
$upload_overrides = array( 'test_form' => false );
$movefile = wp_handle_upload( $_FILES['bbeditimg'], $upload_overrides );
$uploadFile = $movefile['url'];
}else{
$uploadFile = $_POST['editimgurl'];
}

$formData = array( 
	'badgename' => sanitize_text_field($_POST['bbeditname']),
	'bbImgUrl'  => $uploadFile,
	'bbcount'   => intval($_POST['bbeditcount']),
	'bbtype'   => sanitize_text_field($_POST['bbeditadgetype']),
	'addedon'   => current_time('mysql')
	 );
$whereclose = array( 'bbsrno' => $_POST['userid'] );
$updated = $wpdb->update( $tablename, $formData, $whereclose );
$success_edit = wp_create_nonce( 'success_edit' );
echo '<script>window.location.href="'.admin_url().'/options-general.php?page=buddybadge&_wpsuccessedit='.$success_edit.'";</script>';
}
}
/**
*
* End of edit a form
*
**/
/**
*
* Delete a value by ajax
*
**/
$nonce_res_delete = $_REQUEST['_wpnonce'];
if ( wp_verify_nonce( $nonce_res_delete, 'delete_badge' ) ) {
if(isset($_GET['delete']) && trim($_GET['delete'])!=''){
		$tablename = $wpdb->prefix."buddybadge";
		$wpdb->delete( $tablename, array( 'bbsrno' => intval($_GET['delete']) ) );
		$success_delete = wp_create_nonce( 'success_delete' );
		echo '<script>window.location.href="'.admin_url().'/options-general.php?page=buddybadge&_wpdelete='.$success_delete.'";</script>';
exit();
}
}

/**
*
* End of delete a value by ajax
*
**/
?>