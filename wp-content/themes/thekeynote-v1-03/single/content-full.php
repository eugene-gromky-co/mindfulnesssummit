<?php
/**
 * The default template for displaying standard post format
 */

	if( !is_single() ){ 
		global $gdlr_post_settings; 
		if($gdlr_post_settings['excerpt'] < 0) global $more; $more = 0;
	}else{
		global $gdlr_post_settings, $theme_option;
	}
?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<div class="gdlr-standard-style">
		<?php get_template_part('single/thumbnail', get_post_format()); ?>	
		
		<div class="blog-content-wrapper" >
			<div class="post-header-wrapper" >
				<div class="gdlr-blog-date-wrapper gdlr-info-font">
					<div class="gdlr-blog-day"><?php echo get_the_time('j'); ?></div>
					<div class="gdlr-blog-month"><?php echo get_the_time('M'); ?></div>
				</div>
				<header class="post-header">
					<?php 
						// print blog information
						if( is_single() && get_post_type() == 'post' ){
							echo gdlr_get_blog_info(array('author', 'comment', 'category'), true, '<span class="gdlr-separator">/</span>');
						}else if( !is_single() ){
							echo gdlr_get_blog_info(array('author', 'comment', 'category'), true, '<span class="gdlr-separator">/</span>');
						}
					?>				
				
					<?php if( is_single() ){ ?>
						<h1 class="gdlr-blog-title"><?php the_title(); ?></h1>
					<?php }else{ ?>
						<h3 class="gdlr-blog-title"><a href="<?php echo get_permalink(); ?>"><?php the_title(); ?></a></h3>
					<?php } ?>			
					<div class="clear"></div>
				</header><!-- entry-header -->
				<div class="post-header-bottom-gimmick"></div>
			</div>
			<div class="clear"></div>
		
			<?php 
				if( is_single() || $gdlr_post_settings['excerpt'] < 0 ){
					echo '<div class="gdlr-blog-content">';
					echo gdlr_content_filter($gdlr_post_settings['content'], true);
					wp_link_pages( array( 
						'before' => '<div class="page-links"><span class="page-links-title">' . __( 'Pages:', 'gdlr_translate' ) . '</span>', 
						'after' => '</div>', 
						'link_before' => '<span>', 
						'link_after' => '</span>' )
					);
					echo '</div>';
				}else if( $gdlr_post_settings['excerpt'] != 0 ){
					echo '<div class="gdlr-blog-content">' . get_the_excerpt() . '</div>';
				}
			?>
			
			<?php if( is_single() ){ ?>
			<div class="gdlr-single-blog-tag">
				<?php echo gdlr_get_blog_info(array('tag'), false); ?>
			</div>
			<?php } ?>
		</div> <!-- blog content wrapper -->
	</div>
</article><!-- #post -->