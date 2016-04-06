<article class="home-cptarchive home-actualites orbit-slide">
	<div class="post-content">
		<?php if (has_post_thumbnail()) : ?>
        <div class="post-thumbnail" data-toggler data-animate="slide-in-down slide-out-up"><?php the_post_thumbnail('thumbnail') ?></div>
		<?php else : ?>
		<div class="long-excerpt"><?php the_content() ?></div>
		<?php endif; ?>
		<header>
			<p class="post-meta"><?php foundationpress_entry_meta() ?></p>
			<h4><a href="<?php the_permalink() ?>"><?php the_title() ?></a></h4>
		</header>
		<?php if (has_post_thumbnail()) : ?>
        <div class="excerpt"><?php the_excerpt() ?></div>
		<?php endif; ?>
    </div>
</article>