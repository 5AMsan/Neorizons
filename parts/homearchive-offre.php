<?php global $cue, $tot, $items; ?>
<article class="home-cptarchive toggle home-offre">
	<header>
    	<a data-open="subcontent-<?php the_ID() ?>" rel="subcontent-<?php the_ID() ?>"><div class="post-thumbnail"><?php the_post_thumbnail() ?></div>
        <h3><?php the_title() ?></h3></a>
	</header>
    <div class="large reveal callout content-offre" id="subcontent-<?php the_ID() ?>" data-reveal data-close-on-click="true" data-animation-in="fade-in" data-animation-out="fade-out">
		<button class="close-button" data-close aria-label="Close modal" type="button"><span aria-hidden="true">&times;</span></button>
		<aside class="post-thumbnail"><?php the_post_thumbnail() ?></aside>
        <div class="columns medium-9">
            <h2><?php the_title() ?></h2>
            <?php the_content() ?>
        </div>
		<?php echo neorizons_get_reveal_nav($cue, $tot, $items) ?>
    </div>
</article>