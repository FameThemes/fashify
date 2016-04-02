<?php
/**
 * The template for displaying archive pages.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package Fashify
 */

get_header(); ?>

<div class="container">
	<div id="primary" class="content-area">
		<main id="main" class="site-main" role="main">

		<?php
		global $wp_query;
		$total_pages = $wp_query->max_num_pages;
		$current_page = max(1, get_query_var('paged'));
		$archive_layout = get_theme_mod( 'fashify_archive_layout', 'default' );
		if ( have_posts() ) : ?>

			<header class="page-header">
				<?php
					the_archive_title( '<h1 class="entry-title">', '</h1>' );
					the_archive_description( '<div class="taxonomy-description">', '</div>' );
				?>
			</header><!-- .page-header -->

			<?php
			/* Start the Loop */
			while ( have_posts() ) : the_post();

				/*
				 * Include the Post-Format-specific template for the content.
				 * If you want to override this in a child theme, then include a file
				 * called content-___.php (where ___ is the Post Format name) and that will be used instead.
				 */
				 switch ( $archive_layout ) {
 		 			case 'grid':
 		 				get_template_part( 'template-parts/content', 'grid' );
 		 				break;

 		 			case 'list':
 		 				get_template_part( 'template-parts/content', 'list' );
 		 				break;

 		 			default:
 		 				get_template_part( 'template-parts/content', 'grid-large' );
 		 				break;
 		 		}


			endwhile;

		else :

			get_template_part( 'template-parts/content', 'none' );

		endif;

		if (  $wp_query->max_num_pages > 1 ) {
			echo '<div class="post-pagination">';
			the_posts_pagination(array(
				'prev_next' => true,
				'prev_text' => '',
				'next_text' => '',
				'before_page_number' => '<span class="screen-reader-text">' . __('Page', 'fashify') . ' </span>',
			));
			echo '</div>';
		}
		?>

		</main><!-- #main -->
	</div><!-- #primary -->

	<?php get_sidebar(); ?>
</div>

<?php
get_footer();
