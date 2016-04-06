<?php

// Register Custom Post Type
if ( ! function_exists( 'neorizons_interventions' ) ) :
function neorizons_interventions() {

	$labels = array(
		'name'                  => _x( 'Interventions', 'Post Type General Name', 'neorizons' ),
		'singular_name'         => _x( 'Intervention', 'Post Type Singular Name', 'neorizons' ),
		'menu_name'             => __( 'Secteurs d\'int.', 'neorizons' ),
		'name_admin_bar'        => __( 'Secteurs d\'intervention', 'neorizons' ),
		'archives'              => __( 'Item Archives', 'neorizons' ),
		'parent_item_colon'     => __( 'Parent Item:', 'neorizons' ),
		'all_items'             => __( 'Tous les secteurs', 'neorizons' ),
		'add_new_item'          => __( 'Nouveau secteur', 'neorizons' ),
		'add_new'               => __( 'Ajouter', 'neorizons' ),
		'new_item'              => __( 'Nouveau secteur', 'neorizons' ),
		'edit_item'             => __( 'Modifier', 'neorizons' ),
		'update_item'           => __( 'Mettre à jour', 'neorizons' ),
		'view_item'             => __( 'Voir le secteur', 'neorizons' ),
		'search_items'          => __( 'Rechercher', 'neorizons' ),
		'not_found'             => __( 'Aucun élément trouvé', 'neorizons' ),
		'not_found_in_trash'    => __( 'Aucun élément trouvé dans la corbeille', 'neorizons' ),
		'featured_image'        => __( 'Image à la une', 'neorizons' ),
		'set_featured_image'    => __( 'Mettre une image à la une', 'neorizons' ),
		'remove_featured_image' => __( 'Supprimer l\'image à la une', 'neorizons' ),
		'use_featured_image'    => __( 'Utiliser comme image à la une', 'neorizons' ),
		'insert_into_item'      => __( 'Insert into item', 'neorizons' ),
		'uploaded_to_this_item' => __( 'Uploaded to this item', 'neorizons' ),
		'items_list'            => __( 'Items list', 'neorizons' ),
		'items_list_navigation' => __( 'Items list navigation', 'neorizons' ),
		'filter_items_list'     => __( 'Filter items list', 'neorizons' ),
	);
	$args = array(
		'label'                 => __( 'Intervention', 'neorizons' ),
		'description'           => __( 'Post Type Description', 'neorizons' ),
		'labels'                => $labels,
		'supports'              => array( 'title', 'editor', 'page-attributes', 'revisions' ),
		'hierarchical'          => false,
		'public'                => true,
		'show_ui'               => true,
		'show_in_menu'          => true,
		'menu_position'         => 5,
		'menu_icon'             => 'dashicons-hammer',
		'show_in_admin_bar'     => true,
		'show_in_nav_menus'     => true,
		'can_export'            => true,
		'has_archive'           => false,		
		'exclude_from_search'   => true,
		'publicly_queryable'    => true,
		'capability_type'       => 'page',
	);
	register_post_type( 'intervention', $args );

}
add_action( 'init', 'neorizons_interventions', 0 );
add_filter( 'parse_query','neorizons_filter_intervention' );
function neorizons_filter_intervention( $query ) {
	if( is_admin() && $query->query['post_type'] == 'intervention' ) {
		$query->set('orderby', 'menu_order');
		$query->set('order', 'ASC');
	}
}
endif;

if ( ! function_exists( 'neorizons_offres' ) ) :
function neorizons_offres() {

	$labels = array(
		'name'                  => _x( 'Offres', 'Post Type General Name', 'neorizons' ),
		'singular_name'         => _x( 'Offre', 'Post Type Singular Name', 'neorizons' ),
		'menu_name'             => __( 'Offres', 'neorizons' ),
		'name_admin_bar'        => __( 'Offres', 'neorizons' ),
		'archives'              => __( 'Item Archives', 'neorizons' ),
		'parent_item_colon'     => __( 'Parent Item:', 'neorizons' ),
		'all_items'             => __( 'Toutes les offres', 'neorizons' ),
		'add_new_item'          => __( 'Nouvelle offre', 'neorizons' ),
		'add_new'               => __( 'Ajouter', 'neorizons' ),
		'new_item'              => __( 'Nouvelle offre', 'neorizons' ),
		'edit_item'             => __( 'Modifier', 'neorizons' ),
		'update_item'           => __( 'Mettre à jour', 'neorizons' ),
		'view_item'             => __( 'Voir l\'offre', 'neorizons' ),
		'search_items'          => __( 'Rechercher', 'neorizons' ),
		'not_found'             => __( 'Aucun élément trouvé', 'neorizons' ),
		'not_found_in_trash'    => __( 'Aucun élément trouvé dans la corbeille', 'neorizons' ),
		'featured_image'        => __( 'Image à la une', 'neorizons' ),
		'set_featured_image'    => __( 'Mettre une image à la une', 'neorizons' ),
		'remove_featured_image' => __( 'Supprimer l\'image à la une', 'neorizons' ),
		'use_featured_image'    => __( 'Utiliser comme image à la une', 'neorizons' ),
		'insert_into_item'      => __( 'Insert into item', 'neorizons' ),
		'uploaded_to_this_item' => __( 'Uploaded to this item', 'neorizons' ),
		'items_list'            => __( 'Items list', 'neorizons' ),
		'items_list_navigation' => __( 'Items list navigation', 'neorizons' ),
		'filter_items_list'     => __( 'Filter items list', 'neorizons' ),
	);
	$args = array(
		'label'                 => __( 'Offre', 'neorizons' ),
		'description'           => __( 'Post Type Description', 'neorizons' ),
		'labels'                => $labels,
		'supports'              => array( 'title', 'editor', 'thumbnail', 'page-attributes', 'revisions' ),
		'hierarchical'          => false,
		'public'                => true,
		'show_ui'               => true,
		'show_in_menu'          => true,
		'menu_position'         => 6,
		'menu_icon'             => 'dashicons-star-filled',
		'show_in_admin_bar'     => true,
		'show_in_nav_menus'     => true,
		'can_export'            => true,
		'has_archive'           => false,		
		'exclude_from_search'   => true,
		'publicly_queryable'    => true,
		'capability_type'       => 'page',
	);
	register_post_type( 'offre', $args );

}
add_action( 'init', 'neorizons_offres', 0 );
add_filter( 'parse_query','neorizons_filter_offre' );
function neorizons_filter_offre( $query ) {
	if( is_admin() && $query->query['post_type'] == 'offre' ) {
		$query->set('orderby', 'menu_order');
		$query->set('order', 'ASC');
	}
}
endif;

if ( ! function_exists( 'neorizons_references' ) ) :
function neorizons_references() {

	$labels = array(
		'name'                  => _x( 'Références', 'Post Type General Name', 'neorizons' ),
		'singular_name'         => _x( 'Référence', 'Post Type Singular Name', 'neorizons' ),
		'menu_name'             => __( 'Références', 'neorizons' ),
		'name_admin_bar'        => __( 'Références', 'neorizons' ),
		'archives'              => __( 'Archives des références', 'neorizons' ),
		'parent_item_colon'     => __( 'Parent Item:', 'neorizons' ),
		'all_items'             => __( 'Toutes les références', 'neorizons' ),
		'add_new_item'          => __( 'Nouvelle référence', 'neorizons' ),
		'add_new'               => __( 'Ajouter', 'neorizons' ),
		'new_item'              => __( 'Nouvelle référence', 'neorizons' ),
		'edit_item'             => __( 'Modifier', 'neorizons' ),
		'update_item'           => __( 'Mettre à jour', 'neorizons' ),
		'view_item'             => __( 'Voir la référence', 'neorizons' ),
		'search_items'          => __( 'Rechercher', 'neorizons' ),
		'not_found'             => __( 'Aucun élément trouvé', 'neorizons' ),
		'not_found_in_trash'    => __( 'Aucun élément trouvé dans la corbeille', 'neorizons' ),
		'featured_image'        => __( 'Logo de l\'entité', 'neorizons' ),
		'set_featured_image'    => __( 'Ajouter un logo', 'neorizons' ),
		'remove_featured_image' => __( 'Supprimer le logo', 'neorizons' ),
		'use_featured_image'    => __( 'Utiliser comme logo', 'neorizons' ),
		'insert_into_item'      => __( 'Insérer dans la référence', 'neorizons' ),
		'uploaded_to_this_item' => __( 'Télécharger dans cette référence', 'neorizons' ),
		'items_list'            => __( 'Liste des références', 'neorizons' ),
		'items_list_navigation' => __( 'Liste de navigation des références', 'neorizons' ),
		'filter_items_list'     => __( 'Filtrer les références', 'neorizons' ),
	);
	$args = array(
		'label'                 => __( 'Référence', 'neorizons' ),
		'description'           => __( 'Référence', 'neorizons' ),
		'labels'                => $labels,
		'supports'              => array( 'title', 'editor', 'thumbnail', 'revisions', /*'editor', 'custom-fields',*/ ),
		'hierarchical'          => false,
		'public'                => true,
		'show_ui'               => true,
		'show_in_menu'          => true,
		'menu_position'         => 7,
		'menu_icon'             => 'dashicons-awards',
		'show_in_admin_bar'     => true,
		'show_in_nav_menus'     => true,
		'can_export'            => true,
		'has_archive'           => true,		
		'exclude_from_search'   => false,
		'publicly_queryable'    => true,
		'capability_type'       => 'page',
	);
	register_post_type( 'reference', $args );

}
add_action( 'init', 'neorizons_references', 0 );
endif;