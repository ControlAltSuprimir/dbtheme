<?php
/**
 * Template part for displaying home featured blocks section
 *
 * @package Education_Soul
 */

$featured_blocks_title  = education_soul_get_option( 'featured_blocks_title' );
$featured_blocks_number = absint( education_soul_get_option( 'featured_blocks_number' ) );
$featured_blocks_column = education_soul_get_option( 'featured_blocks_column' );

$featured_block_pages = array();

for ( $i = 0; $i <= $featured_blocks_number; $i++ ) {
	$page_item = education_soul_get_option( 'featured_blocks_page_' . $i );
	if ( absint( $page_item ) > 0 ) {
		$featured_block_pages[] = absint( $page_item );
	}
}

if ( ! empty( $featured_block_pages ) ) {
	$featured_block_pages = array_unique( $featured_block_pages );
}
?>
<div id="education-soul-featured-blocks" class="home-section home-section-featured-blocks">
	<div class="container">
		<?php if ( ! empty( $featured_blocks_title ) ) : ?>
			<h2 class="section-title"><?php echo esc_html( $featured_blocks_title ); ?></h2>
		<?php endif; ?>

		<?php if ( ! empty( $featured_block_pages ) ) : ?>
			<?php
			$qargs = array(
				'posts_per_page'      => absint( $featured_blocks_number ),
				'no_found_rows'       => true,
				'ignore_sticky_posts' => true,
				'orderby'             => 'post__in',
				'post_type'           => 'page',
				'post__in'            => $featured_block_pages,
			);

			// Fetch posts.
			$the_query = new WP_Query( $qargs );
			?>
			<?php if ( $the_query->have_posts() ) : ?>
				<div class="inner-wrapper featured-blocks-column-<?php echo absint( $featured_blocks_column ); ?>">

					<?php
					while ( $the_query->have_posts() ) :
						$the_query->the_post();
						?>
						<div class="featured-block-item">
							<div class="featured-block-inner">
								<?php if ( has_post_thumbnail() ) : ?>
									<a class="featured-block-thumb" href="<?php the_permalink(); ?>"><?php the_post_thumbnail( 'education-soul-thumb' ); ?></a>
								<?php endif; ?>
								<div class="featured-block-content">
									<h3 class="block-title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
									<?php
									$excerpt = education_soul_the_excerpt( 20 );
									echo wp_kses_post( wpautop( $excerpt ) );
									?>
                                    
                                    <a class="custom-button" href="<?php the_permalink(); ?>"><?php esc_html_e( 'Read More', 'education-soul-pro' ); ?><span class="screen-reader-text"> <?php the_title(); ?></span></a>
								</div><!-- .featured-block-content -->
							</div><!-- .featured-block-inner -->
						</div><!-- .featured-block-item -->
					<?php endwhile; ?>

				</div><!-- .inner-wrapper -->
				<?php wp_reset_postdata(); ?>
			<?php endif; ?>

		<?php else : ?>

			<?php if ( current_user_can( 'edit_theme_options' ) ) : ?>
				<p><strong><?php esc_html_e( 'No pages selected to be displayed as featured blocks. In Customizer, go to Homepage Sections -> Featured Blocks to choose pages.', 'education-soul-pro' ); ?></strong></p>
			<?php endif; ?>

		<?php endif; ?>

	</div><!-- .container -->
</div><!-- .home-section-featured-blocks -->