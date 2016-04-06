<article class="home-cptarchive home-reference orbit-slide">
	<header><?php the_post_thumbnail() ?></header>
    <dl class="content-reference">
    	<?php if($contexte = get_field('contexte')) : ?>
		<dt class="contexte"><i class="fa fa-eye"></i> Contexte</dt>
        <dd class="contexte"><?php echo neorizons_excerpt($contexte); ?></dd>
        <?php endif; ?>
		<?php if($enjeux = get_field('enjeux')) : ?>
		<dt class="enjeux"><i class="fa fa-arrows"></i> Enjeux</dt>
        <dd class="enjeux"><?php echo neorizons_excerpt(enjeux) ?></dd>
        <?php endif; ?>
		<?php if($approche = get_field('approche')) : ?>
		<dt class="approche"><i class="fa fa-bullhorn"></i> Notre approche</dt>
        <dd class="approche"><?php echo neorizons_excerpt($approche) ?></dd>
		<?php endif; ?>
        <a href="<?php echo home_url('/#contact') //the_permalink() ?>" class="button icon search"><i class="fa fa-search"></i>En savoir plus</a>
    </dl>
</article>