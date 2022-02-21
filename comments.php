<?php
/**
 * The template for displaying comments.
 *
 * This is the template that displays the area of the page that contains both the current comments
 * and the comment form.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package designr
 */

/*
 * If the current post is protected by a password and
 * the visitor has not yet entered the password we will
 * return early without loading the comments.
 */
if ( post_password_required() ) {
	return;
	comment_form();
}
global $designr, $designrID, $bordy;
?>
	<?php 
		$comments = get_comments(array(
			'post_id' => $designrID
		));
		if (!empty($comments)) : ?>
<div id="comments" class="comments-area <?php if(!$bordy){ echo 'no-top-border';}?>">

	<?php // You can start editing here -- including this comment! ?>


		<h2><?php esc_html_e('Comments','designr');?></h2>
		<ol class="comment-list">
			<?php
				wp_list_comments( array(
					'style'      => 'ul',
					'short_ping' => true,
					'callback' => 'designr_comments',
					'avatar_size' => 56
				), $comments );
			?>
		</ol><!-- .comment-list -->

		<?php if ( get_comment_pages_count() > 1 && get_option( 'page_comments' ) ) : // Are there comments to navigate through? ?>
		<nav id="comment-nav-below" class="navigation comment-navigation" role="navigation">
			<h2 class="screen-reader-text"><?php esc_html_e( 'Comment navigation', 'designr' ); ?></h2>
			<div class="nav-links">

				<div class="nav-previous"><?php previous_comments_link( esc_html( 'Older Comments', 'designr' ) ); ?></div>
				<div class="nav-next"><?php next_comments_link( esc_html( 'Newer Comments', 'designr' ) ); ?></div>

			</div><!-- .nav-links -->
		</nav><!-- #comment-nav-below -->
		<?php endif; // Check for comment navigation. ?>

	<?php endif; // Check for have_comments(). ?>

	<?php
		// If comments are closed and there are comments, let's leave a little note, shall we?
		if ( ! comments_open() && get_comments_number() && post_type_supports( get_post_type(), 'comments' ) ) :
	?>
		<p class="no-comments"><?php esc_html_e( 'Comments are closed.', 'designr' ); ?></p>

</div><!-- #comments -->
	<?php endif; ?>
<?php 
if (comments_open()){?>
<div class="submitcomment">
<?php if ('open' == $post->comment_status) : ?>
 
<div id="respond">
 
<h2><?php esc_html_e('Submit Comment','designr');?></h2>
 
<div class="cancel-comment-reply">
    <small><?php cancel_comment_reply_link(); ?></small>
</div>
 
<?php if ( get_option('comment_registration') && !$user_ID ) : ?>
<p><?php echo __('You must be', 'designr');?> <a href="<?php echo esc_url( home_url( '/' ) ); ?>wp-login.php?redirect_to=<?php echo urlencode(get_permalink()); ?>"><?php echo __('logged in','designr');?></a> <?php echo __('to post a comment.','designr');?></p>
<?php else : ?>
 
<form action="<?php echo esc_url( home_url( '/' ) ); ?>wp-comments-post.php" method="post" id="commentform">
 
<?php if ( $user_ID ) : ?>
 
<p><?php echo __('Logged in as','designr');?> <a href="<?php echo admin_url();?>"><?php echo sanitize_user($user_identity); ?></a>. <a href="<?php echo wp_logout_url(get_permalink()); ?>" title="<?php echo __('Log out of this account','designr');?>"><?php echo __('Log out &raquo;','designr');?></a></p>
 
<?php else : ?>
 
<p><input type="text" name="author" id="author" value="<?php echo sanitize_user($comment_author); ?>" size="22" tabindex="1" placeholder="Name*" />
</p>
 
<p><input type="text" name="email" id="email" value="<?php echo sanitize_email($comment_author_email); ?>" size="22" tabindex="2" placeholder="Email*" />
</p>
 
<p><input type="text" name="url" id="url" placeholder="Website" value="<?php echo esc_url($comment_author_url); ?>" size="22" tabindex="3" />
</p>
 
<?php endif; ?>
<p><small><strong><?php echo __('XHTML:','designr');?></strong> <?php echo __('You can use these tags:','designr');?> <code><?php echo allowed_tags(); ?></code></small></p>
 
<p><textarea name="comment" id="comment" placeholder="<?php echo __('Comment*','designr');?>" cols="100%" rows="5" tabindex="4"></textarea></p>
 
<p><input name="submit" type="submit" id="submit" class="btn-default" tabindex="5" value="<?php echo __('SUBMIT','designr');?>" />
<?php comment_id_fields($designrID); ?>
</p>
<?php do_action('comment_form', $designrID);?>
 
</form>
 
<?php endif; // If registration required and not logged in ?>
</div></div>
<?php endif; // if you delete this the sky will fall on your head ?>
<?php } 
if(!empty($comments)){ ?>
</div>
<?php } ?>