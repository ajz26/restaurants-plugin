<?php 
function create_restaurant_post_Type() {

	$labelsRestaurantes = array(
		'name'               => __( 'Restaurantes', 'geekshat' ),
		'singular_name'      => __( 'Restaurante', 'geekshat' ),
		'add_new'            => _x( 'Agregar', 'geekshat', 'geekshat' ),
		'add_new_item'       => __( 'Agregar nuevo', 'geekshat' ),
		'edit_item'          => __( 'Editar', 'geekshat' ),
		'new_item'           => __( 'Nuevo', 'geekshat' ),
		'view_item'          => __( 'Ver', 'geekshat' ),
		'search_items'       => __( 'Buscar', 'geekshat' ),
		'not_found'          => __( 'No se encontraron resultados ', 'geekshat' ),
		'not_found_in_trash' => __( 'No se encontraron resultados en la papelera', 'geekshat' ),
		'menu_name'          => __( 'Recojos y Paquetes', 'geekshat' ),
	);

	$argsRestaurantes = array(
		'labels'              => $labelsRestaurantes,
		'public'              => true,
		'show_ui'             => true,
		'show_in_menu'        => false,
		'show_in_admin_bar'   => false,
		'show_in_nav_menus'   => false,
		'publicly_queryable'  => true,
		'exclude_from_search' => true,
		'has_archive'         => false,
		'query_var'           => true,
		'can_export'          => true,
		'rewrite' => array('slug' => 'restaurant', 'with_front' => false),
		'capability_type'     => 'post',
		'supports'            => array(
			'title',
			'thumbnail'
		),
	);


register_post_type( 'restaurantes', $argsRestaurantes ); 



$labels = array(
		'name'                  => _x( 'Hoteles', 'Taxonomy plural name', 'geekshat' ),
		'singular_name'         => _x( 'Hotel', 'Taxonomy singular name', 'geekshat' ),
		'search_items'          => __( 'Buscar ', 'geekshat' ),
		'all_items'             => __( 'Todos', 'geekshat' ),
		'edit_item'             => __( 'Editar', 'geekshat' ),
		'update_item'           => __( 'Actualizar', 'geekshat' ),
		'add_new_item'          => __( 'Agregar nuevo', 'geekshat' ),
		'new_item_name'         => __( 'nuevo', 'geekshat' ),
		'add_or_remove_items'   => __( 'Agregar', 'geekshat' ),
		'choose_from_most_used' => __( 'Escoger de los motivos mas usados', 'geekshat' ),
		'menu_name'             => __( 'Hoteles', 'geekshat' ),
	);

	$args = array(
		'labels'            => $labels,
		'public'            => true,
		'show_in_nav_menus' => true,
		'show_admin_column' => false,
		'hierarchical'      => true,
		'parent_item'  		=> null,
		'parent_item_colon' => null,
		'show_ui'           => true,
		'query_var'         => true,
		'capabilities'      => array(),
	);

	register_taxonomy( 'hotel', array( 'restaurantes' ), $args );



$labels = array(
		'name'                  => _x( 'Ciudades', 'Taxonomy plural name', 'geekshat' ),
		'singular_name'         => _x( 'Ciudad', 'Taxonomy singular name', 'geekshat' ),
		'search_items'          => __( 'Buscar ', 'geekshat' ),
		'all_items'             => __( 'Todos', 'geekshat' ),
		'edit_item'             => __( 'Editar', 'geekshat' ),
		'update_item'           => __( 'Actualizar', 'geekshat' ),
		'add_new_item'          => __( 'Agregar nuevo', 'geekshat' ),
		'new_item_name'         => __( 'nuevo', 'geekshat' ),
		'add_or_remove_items'   => __( 'Agregar', 'geekshat' ),
		'choose_from_most_used' => __( 'Escoger de los motivos mas usados', 'geekshat' ),
		'menu_name'             => __( 'Ciudades', 'geekshat' ),
	);

	$args = array(
		'labels'            => $labels,
		'public'            => true,
		'show_in_nav_menus' => true,
		'show_admin_column' => false,
		'hierarchical'      => true,
		'parent_item'  		=> null,
		'parent_item_colon' => null,
		'show_ui'           => true,
		'query_var'         => true,
		'capabilities'      => array(),
	);

	register_taxonomy( 'ciudad', array( 'restaurantes' ), $args );



}

add_action( 'init', 'create_restaurant_post_Type' );




add_filter( 'rwmb_meta_boxes', 'registrar_metaboxes_restaurantes' );

function registrar_metaboxes_restaurantes( $meta_boxes ) {

	$meta_boxes[] = array(
        'id'         => 'restaurante',
        'title'      => 'Datos del restaurante',
        'post_types' => 'restaurantes',
        'context'    => 'normal',
        'priority'   => 'high',

        'fields' => array(

        			array(
			                    'name' => 'Nombre Restaurant',
			                    'id'   => 'restaurante',
			                    'type' => 'text',
			                    'columns' 	 => 4,
			                ),
        			array(
							    'name'       => 'Correo',
							    'id'         => 'correo',
							    'type'       => 'email',
							    'columns' 	 => 4,
							),
		        	array(
					    'type' => 'divider',
					),
		           array(
					    'name'       => 'Horario de apertura',
					    'id'         => 'apertura',
					    'type'       => 'time',
					    'js_options' => array(
					        'stepMinute'      => 15,
					        'controlType'     => 'select',
					        'showButtonPanel' => false,
					        'oneLine'         => true,
					    ),
					    'columns' => 4,
					   ),
		           array(
					    'name'       => 'Horario de cierre',
					    'id'         => 'cierre',
					    'type'       => 'time',
					    'js_options' => array(
					        'stepMinute'      => 15,
					        'controlType'     => 'select',
					        'showButtonPanel' => false,
					        'oneLine'         => true,
					    ),

					    'inline'     => false,
					    'columns' => 4,
					),
		           array(
						    'name'       => 'Tiempo entre reservas',
						    'id'         => 'tiempo',
						    'type'            => 'select',
						    'options'         => array(
						        '15'	       => '15',
						        '30' 		  => '30',
						        '45' 		  => '45',
						        '60' 		  => '60',
						    ),
						    'columns' => 4,
						),
        )
    );

	

	$meta_boxes[] = array(
        'id'         => 'Identidad',
        'title'      => 'Identidad del restaurant',
        'post_types' => 'restaurantes',
        'context'    => 'normal',
		'priority'   => 'high',
		
        'fields' => array(
			array(
				'name'   => 'Color',
				'desc' 		 => 'Color',
				'id'     => 'color',
				'type'   => 'color',
				'columns' 	 => 6,
			),

			array(
				'name'             => 'Banner',
				'id'               => 'banner',
				'type'             => 'image_advanced',
				'force_delete'     => false,
			),
        )
    );


    return $meta_boxes;
}



add_filter('single_template', 'customize_template_from_restaurants');

function customize_template_from_restaurants($single) {

    global $post;

    if ( $post->post_type == 'restaurantes' ) {
        if ( file_exists( geekshat_plugin_dir . '/form.php' ) ) {
            return geekshat_plugin_dir . '/form.php';
        }
    }

    return $single;

}