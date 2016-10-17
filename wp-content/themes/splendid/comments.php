<?php
/**
 * The template for displaying comments.
 *
 * The area of the page that contains both current comments
 * and the comment form.
 *
 * @package splendid
 */

/*
 * If the current post is protected by a password and
 * the visitor has not yet entered the password we will
 * return early without loading the comments.
 */
if ( post_password_required() ) {
	return;
}
?>


<!-- Comments -->
<section class="post-comments" id="comments">

	<h3><?php echo get_comments_number(); ?> <?php esc_html_e('Comments', 'splendid'); ?></h3>

	<?php if ( get_comment_pages_count() > 1 && get_option( 'page_comments' ) ) : // are there comments to navigate through ?>
		<nav id="comment-nav-above" class="navigation comment-navigation" role="navigation">
			<h2 class="screen-reader-text"><?php esc_html_e( 'Comment navigation', 'splendid' ); ?></h2>
			<div class="nav-links">

				<div class="nav-previous"><?php previous_comments_link( esc_html__( 'Older Comments', 'splendid' ) ); ?></div>
				<div class="nav-next"><?php next_comments_link( esc_html__( 'Newer Comments', 'splendid' ) ); ?></div>

			</div><!-- .nav-links -->
		</nav><!-- #comment-nav-above -->
	<?php endif; // check for comment navigation ?>
	
	<div class="comments-list">
		<div class="comment-list-item">
			<ul class="media-list clearlist mt-0 mb-0">
				<?php
					wp_list_comments( array(
						'callback' => 'splendid_comment', 
						'end-callback' => 'splendid_close_comment',
						'style'      => 'ul',
						'short_ping' => true,
					) );
				?>
			</ul>
		</div>
	</div>
</section>
<!-- End Comments -->

<!-- Add Comment -->
<div class="post-comment-submit">

	<?php
	$commenter = wp_get_current_commenter();
	$req = get_option( 'require_name_email' );
	$aria_req = ( $req ? " aria-required='true'" : '' );

	$args = array(
		'id_form' => 'commentform',
		'id_submit' => 'comment_submit',
		'title_reply' => esc_html__( 'Leave a Comment' ,'splendid'),
		'title_reply_to' =>  esc_html__( 'Leave a Comment to %s'  ,'splendid'),
		'cancel_reply_link' => esc_html__( 'Cancel Comment'  ,'splendid'),
		'label_submit' => esc_html__( 'Submit Comment'  ,'splendid'),
		'comment_field' => '
			<!-- Comment -->
			<label>Comment '.( $req ? ' <span class="color-red">*</span>' : '' ).'</label>
			<textarea name="comment" id="text" ' . $aria_req . ' class="input-md form-control" rows="6"  maxlength="400"></textarea>
			',
		'must_log_in' => '<p class="must-log-in">' . wp_kses_post( sprintf( __( 'You must be <a href="%s">logged in</a> to post a comment.' ,'splendid' ), esc_url( wp_login_url( apply_filters( 'the_permalink', get_permalink( ) ) ) ) ) ). '</p>',
		'logged_in_as' => '<p class="logged-in-as">' . wp_kses_post( sprintf( __( 'Logged in as <a href="%1$s">%2$s</a>. <a href="%3$s" title="Log out of this account">Log out?</a>'  ,'splendid'), esc_url (admin_url( 'profile.php' ) ), $user_identity, esc_url( wp_logout_url( apply_filters( 'the_permalink', get_permalink( ) ) ) ) ) ). '</p>',
		'comment_notes_before' => '',
		'comment_notes_after' => '<div class="clearfix"></div>',
		'class_submit' => 'button big bg-blue color-white',
		'fields' => apply_filters( 'comment_form_default_fields',
			array(
				'author' => '
					<div class="row input-row">
						<div class="col-lg-4 col-md-4 col-sm-4">
							<!-- Name -->
							<label>'.esc_html__('Name','splendid').' '.( $req ? ' <span class="color-red">*</span>' : '' ).'</label>
							<input type="text" name="author" id="name" ' . $aria_req . ' class="input-md form-control" maxlength="100">
						</div>',
					
				'email' => '
						<div class="col-lg-4 col-md-4 col-sm-4">
							<!-- Email -->
							<label>'.esc_html__('Email','splendid').' '.( $req ? ' <span class="color-red">*</span>' : '' ).'</label>
							<input type="email" name="email" id="email" class="input-md form-control" maxlength="100">
						</div>',

				'url' => '
						<div class="col-lg-4 col-md-4 col-sm-4">
							<label>'.esc_html__('Website','splendid').'</label>
							<input type="text" name="url" id="website" class="input-md form-control" maxlength="100">
						</div>
					</div>',
				
				
			)
		)
	);
	comment_form($args);
	?>
	<!-- End Form -->

</div>
<!-- End Add Comment -->