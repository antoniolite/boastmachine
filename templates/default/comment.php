<div class="comment">

<div class="comment_info">

<?php

	echo $lang['posted_by'];

	// If the user was a guest (unregistered), how his name,email,url
	if(empty($cmt['author'])) {

	?>

	<?php if(!empty($cmt['auth_email'])) { ?>
		<script type="text/javascript">
		<!--
			document.write("<a href=\"mailto:<?php echo eregi_replace( "^([_\.0-9a-z-]+)@([0-9a-z][0-9a-z-]+)\.([a-z]{2,6})$", '\\1"+"&"+"#064;"+"\\2"+"."+"\\3',bmc_htmlentities($cmt['auth_email'])); ?>\"><?php echo bmc_htmlentities($cmt['auth_name']); ?></a>");
		//-->
		</script>

	<?php
		} else {
			echo $cmt['auth_name'];
		}
	?>
		&nbsp;

		<?php if(!empty($cmt['auth_url']) && $cmt['auth_url'] != "http://") {	?>
		<a href="http://<?php echo str_replace("http://","",bmc_htmlentities($cmt['auth_url'])); ?>">www</a>
		<?php
			} // end if
		?>
	<?php
	} // end if

	else {
		// Just show the username
	?>
	<a href="<?php echo $bmc_vars['site_url']; ?>/profile.php?id=<?php echo bmc_htmlentities($cmt['author']); ?>"><?php echo $author; ?></a>&nbsp;&nbsp;
	<?php
	}
	?>


<?php

	// Get the original author of the post
	$post_author=$db->query("SELECT author FROM ".MY_PRF."posts WHERE id='{$cmt['post']}'", false);


	// If the user logged in is the admin/or the author of the post, show the 'delete' link
	// and also the IP of the user posting the comment
	if(defined('IS_ADMIN') && IS_ADMIN || ( isset($bmc_vars['logged_in_user']['id']) && $bmc_vars['logged_in_user']['id'] == $post_author['author'] && $bmc_vars['logged_in_user']['level'] > 2)) {
?>
&nbsp;&nbsp;<a href="<?php echo $bmc_vars['site_url']."/".BLOG_FILE; ?>?action=delete_comment&cmt=<?php echo $cmt['id']; ?>&amp;id=<?php echo $post_data['id']; ?>">(<?php echo $lang['admin_but_del']; ?>)</a> &nbsp;
( <a href="http://network-tools.com/default.asp?host=<?php echo $cmt['auth_ip']; ?>" title="Trace IP"><?php echo $cmt['auth_ip']; ?></a> )
<?php
	}
?>

<br />
<?php echo $lang['str_on']; ?> <?php echo $date; ?><br />
</div><!-- end comment_info //-->
<div class="comment_text">
<?php echo $comment; ?>
</div><!-- end comment_text //-->

</div><!-- end comment //-->

