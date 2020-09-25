<?php
/**
 * The template for displaying archive pages
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package Education_Soul
 */

get_header(); ?>
<style>
    h4, p {
		margin-top: 0px;
       	margin-bottom: 5px;
	}
	hr{
		margin-bottom: 30px;
	}
</style>
<div class="container-fluid" id="full-guidth">



<div class="row content" >


<div class="col-sm-9">
			<h1 class="page-title"><?php single_cat_title();?></h1>
           
				<hr>

	<?php if ( have_posts() ) : ?>
            <?php 
                while (have_posts()):	the_post();?>
                <div class="row single-archive" style="margin-bottom:30px;">
                    <div class='col-3'>
                        <a href="<?php the_permalink();?>">
                            <?php the_post_thumbnail('medium')?>
                        </a>
                    </div>
                    <div class='col-9'>
					<h4><a href="<?php the_permalink();?>"><?php the_title(); ?></a></h4>
					<p><?php the_date(); ?></p>
					<p><?php $content = get_the_content(); echo mb_strimwidth($content, 0, 300, '...'); ?></p>
					
                    </div>
                </div>
				<?php endwhile; ?>
			

			

		<?php
		/**
		 * Hook - education_soul_action_posts_navigation.
		 *
		 * @hooked: education_soul_custom_posts_navigation - 10
		 */
		do_action( 'education_soul_action_posts_navigation' ); ?>


		<?php else : ?>

			<?php get_template_part( 'template-parts/content', 'none' ); ?>

		<?php endif; ?>
		</div>


	<div class="col-sm-3">
    
			<table>
			
			<tr><th id="option_p">Autores1</th></tr>
				<tr><th id="option_p">Autores2</th></tr>
				<tr><th id="option_p">Autores3</th></tr>
				<tr><th id="option_p">Autores4</th></tr>
                
                
			
			</table>

	

    </div>



	</main><!-- #main -->
</div><!-- #primary -->


<?php get_footer(); ?>
