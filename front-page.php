<?php
/**
 * The template for displaying front page
 *
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package WordPress
 * @subpackage FoundationPress
 * @since FoundationPress 1.0.0
 */

get_header(); ?>

<?php while ( have_posts() ) : the_post(); ?>
<header id="front-hero" role="banner" style="background-image:url(<?php echo get_theme_mod('img-front') ?>)">
	
    <div class="marketing">
		
        <div data-magellan>
			<img class="alignnone wp-image-20 size-full" src="<?php echo get_theme_mod('logo-front') ?>" alt="Neorizons" width="550" height="264" />
           <h1><?php the_title() ?></h1>
			<?php the_content() ?>
        	<a role="button" class="square button sites-button hide-for-small-only" href="#f-philosophie"><i class="fa fa-chevron-down fa-2x"></i></a>
		</div>

	</div>

</header>
<?php endwhile;?>

<!-- Fake Magellan destination -->
<div id="f-philosophie" data-magellan-target="f-philosophie" style="position: relative;	top: -98px;"></div>

<!--<div id="page-full-width" role="main">
    
	<?php //do_action( 'foundationpress_before_content' ); ?>
    <?php //while ( have_posts() ) : the_post(); ?>
      
      <article <?php //post_class('main-content') ?> id="post-<?php //the_ID(); ?>">
          
          <header>
              <h2 class="sub-entry-title"><?php //the_title(); ?></h2>
          </header>
          
          <?php //do_action( 'foundationpress_page_before_entry_content' ); ?>
          <div class="entry-content">
              <?php //the_content(); ?>
          </div>
          
          <footer>
              <?php //wp_link_pages( array('before' => '<nav id="page-nav"><p>' . __( 'Pages:', 'foundationpress' ), 'after' => '</p></nav>' ) ); ?>
              <p><?php //the_tags(); ?></p>
          </footer>
          
      </article>
      
    <?php //endwhile;?>
    <?php //do_action( 'foundationpress_after_content' ); ?>
    
</div> -->

<?php neorizons_get_subpage('accueil/philosophie') ?>

<?php neorizons_get_subpage('accueil/qui-sommes-nous') ?>

<?php neorizons_get_subpage('accueil/secteurs-dintervention') ?>

<?php neorizons_get_subpage('accueil/offres') ?>

<?php neorizons_get_subpage('accueil/nos-references', true) ?>

<?php neorizons_get_subpage('accueil/nos-actualites') ?>

<?php neorizons_get_subpage('accueil/quelques-chiffres') ?>

<?php neorizons_get_subpage('accueil/contact') ?>

<?php get_footer(); ?>