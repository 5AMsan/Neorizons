<?php
/**
 * The template for displaying all single posts and attachments
 *
 * @package FoundationPress
 * @since FoundationPress 1.0.0
 */

get_header(); ?>

<div id="single-post" role="main">

<?php do_action( 'foundationpress_before_content' ); ?>
<?php while ( have_posts() ) : the_post(); ?>
	<article <?php post_class('main-content medium-offset-2 ') ?> id="post-<?php the_ID(); ?>">
		<!--<header>
			<h1 class="entry-title"><?php the_title(); ?></h1>
			<?php foundationpress_entry_meta(); ?>
		</header>-->
		<?php do_action( 'foundationpress_post_before_entry_content' ); ?>
		<div class="entry-content">

		<header class="columns medium-4"><?php the_post_thumbnail() ?></header>
		<dl class="content-reference columns medium-8">
			<dt class="contexte"><i class="fa fa-eye"></i> Contexte</dt>
			<dd class="contexte"><p><?php echo neorizons_excerpt(get_field('contexte')) ?></p></dd>
			<dt class="enjeux"><i class="fa fa-arrows"></i> Enjeux</dt>
			<dd class="enjeux"><p><?php echo neorizons_excerpt(get_field('enjeux')) ?></p></dd>
			<dt class="approche"><i class="fa fa-bullhorn"></i> Notre approche</dt>
			<dd class="approche"><p><?php echo neorizons_excerpt(get_field('approche')) ?></p></dd>
			
		</dl>
        <div class="clearfix"><?php the_content(); ?></div>
		</div>
		<footer>
			<?php wp_link_pages( array('before' => '<nav id="page-nav"><p>' . __( 'Pages:', 'foundationpress' ), 'after' => '</p></nav>' ) ); ?>
			<p><?php the_tags(); ?></p>
		</footer>
		<?php do_action( 'foundationpress_post_before_comments' ); ?>
		<?php comments_template(); ?>
		<?php do_action( 'foundationpress_post_after_comments' ); ?>
	</article>
<?php endwhile;?>

<?php do_action( 'foundationpress_after_content' ); ?>
<?php //get_sidebar(); ?>
</div>
<?php get_footer();
