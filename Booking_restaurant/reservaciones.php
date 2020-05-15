<?php 
function create_reservaciones_post_Type() {

	$labelsRestaurantes = array(
		'name'               => __( 'Reservaciones', 'geekshat' ),
		'singular_name'      => __( 'Reservaciones', 'geekshat' ),
		'add_new'            => _x( 'Nueva reservación', 'geekshat', 'geekshat' ),
		'add_new_item'       => __( 'Crear nuevo', 'geekshat' ),
		'edit_item'          => __( 'Editar', 'geekshat' ),
		'new_item'           => __( 'Nuevo', 'geekshat' ),
		'view_item'          => __( 'Ver', 'geekshat' ),
		'search_items'       => __( 'Buscar', 'geekshat' ),
		'not_found'          => __( 'No se encontraron resultados ', 'geekshat' ),
		'not_found_in_trash' => __( 'No se encontraron resultados en la papelera', 'geekshat' ),
		'menu_name'          => __( 'Reservaciones', 'geekshat' ),
	);

	$argsRestaurantes = array(
		'labels'              => $labelsRestaurantes,
		'hierarchical'        => false,
		'description'         => 'descripcion',
		'taxonomies'          => array(),
		'public'              => false,
		'show_ui'             => true,
		'show_in_menu'        => true,
		'show_in_admin_bar'   => true,
		'menu_position'       => null,
		'menu_icon'           => null,
		'show_in_nav_menus'   => false,
		'publicly_queryable'  => false,
		'exclude_from_search' => true,
		'has_archive'         => false,
		'query_var'           => true,
		'can_export'          => true,
		'rewrite'             => true,
		'capability_type'     => 'post',
		'supports'            => array('title'),
	);


register_post_type( 'reservaciones', $argsRestaurantes ); 


$labels = array(
		'name'                  => _x( 'Motivos', 'Taxonomy plural name', 'geekshat' ),
		'singular_name'         => _x( 'Motivo', 'Taxonomy singular name', 'geekshat' ),
		'search_items'          => __( 'Buscar ', 'geekshat' ),
		'popular_items'         => __( 'Motivos mas usados', 'geekshat' ),
		'all_items'             => __( 'Todos', 'geekshat' ),
		'edit_item'             => __( 'Editar', 'geekshat' ),
		'update_item'           => __( 'Actualizar', 'geekshat' ),
		'add_new_item'          => __( 'Agregar nuevo', 'geekshat' ),
		'new_item_name'         => __( 'nuevo', 'geekshat' ),
		'add_or_remove_items'   => __( 'Agregar', 'geekshat' ),
		'choose_from_most_used' => __( 'Escoger de los motivos mas usados', 'geekshat' ),
		'menu_name'             => __( 'Motivos', 'geekshat' ),
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

	register_taxonomy( 'motivo', array( 'reservaciones' ), $args );

}

add_action( 'init', 'create_reservaciones_post_Type' );




add_filter( 'rwmb_meta_boxes', 'registrar_metaboxes_reservaciones' );

function registrar_metaboxes_reservaciones( $meta_boxes ) {

	$meta_boxes[] = array(
        'id'         => 'restaurante',
        'title'      => 'Datos de la reserva',
        'post_types' => 'reservaciones',
        'context'    => 'normal',
        'priority'   => 'high',

        'fields' => array(

        			array(
			                    'name' => 'Nombre Restaurant',
			                    'id'   => 'restaurante',
			                    'type' => 'post',
			                    'columns' 	 => 4,
			                     'post_type'   => 'restaurantes',
							    'field_type'  => 'select_advanced',
							    'placeholder' => 'Selecciona un restaurante',
							    'query_args'  => array(
							        'post_status'    => 'publish',
							        'posts_per_page' => - 1,
							    ),
			                ),
        			array(
					    'name'       => 'Fecha',
					    'id'         => 'fecha',
					    'type'       => 'date',
					    'columns' => 4,
					),
		           array(
					    'name'       => 'Hora',
					    'id'         => 'hora',
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
					    'type' => 'divider',
					),
		           array(
					    'name'       => 'Adultos',
					    'id'         => 'adultos',
					    'type'       => 'text',
					    'columns' => 4,
					),
		           array(
					    'name'       => 'Niños',
					    'id'         => 'ninos',
					    'type'       => 'text',
					    'columns' => 4,
					),
		           array(
					    'type' => 'divider',
					),
		           array(
					    'name'       => 'Comentario',
					    'id'         => 'comentario',
					    'type'       => 'textarea',
					    'columns' 	 => 12,
					),
        )
    );


	$meta_boxes[] = array(
        'id'         => 'clientes',
        'title'      => 'Datos del cliente',
        'post_types' => 'reservaciones',
        'context'    => 'normal',
        'priority'   => 'high',

        'fields' => array(

        			array(
					    'name'       => 'Nombre',
					    'id'         => 'nombre',
					    'type'       => 'text',
					    'columns' => 4,
					),

					array(
					    'name'       => 'DNI',
					    'id'         => 'dni',
					    'type'       => 'text',
					    'columns' => 4,
					),

					array(
					    'name'       => 'Fecha de Nacimiento',
					    'id'         => 'birthday',
					    'type'       => 'date',
					    'columns' => 4,
					),
					array(
					    'type' => 'divider',
					),
					array(
					    'name'       => 'Genero',
					    'id'         => 'genero',
					    'type'            => 'select',
					    'options'         => array(
					        'masculino'       => 'Masculino',
					        'femenino' 		  => 'Femenino',
					    ),
					    'columns' => 4,
					),	
					array(
					    'name'       => 'Dirección',
					    'id'         => 'direccion',
					    'type'            => 'textarea',
					    'columns' => 8,
					),
					array(
					    'type' => 'divider',
					),
					array(
					    'name'       => 'Teléfono',
					    'id'         => 'telefono',
					    'type'            => 'text',
					    'columns' => 4,
					),
					array(
					    'name'       => 'Correo',
					    'id'         => 'correo',
					    'type'       => 'email',
					    'columns' => 4,
					),		           
        )
    );
    return $meta_boxes;
}



add_filter( 'manage_reservaciones_posts_columns', 'set_custom_edit_reservaciones_columns' );

function set_custom_edit_reservaciones_columns($columns) {
    unset( $columns['Motivos'] );
    unset( $columns['date'] );
    
    $columns['title'] 				= __( 'Solicitud', 'your_text_domain' );
    $columns['restaurante'] 		= __( 'Restaurante', 'your_text_domain' );
    $columns['nombre'] 				= __( 'Nombre', 'your_text_domain' );
    $columns['telefono'] 			= __( 'Teléfono', 'your_text_domain' );
    $columns['correo'] 				= __( 'Correo', 'your_text_domain' );
    $columns['fecha'] 				= __( 'Fecha', 'your_text_domain' );
    $columns['hora'] 				= __( 'Hora', 'your_text_domain' );
    $columns['date'] 				= __( 'Fecha de solicitud', 'your_text_domain' );

    return $columns;
}

// Add the data to the custom columns for the book post type:
add_action( 'manage_reservaciones_posts_custom_column' , 'custom_reservaciones_column', 10, 2 );
function custom_reservaciones_column( $column, $post_id ) {
	$user_ID =  rwmb_meta('usuario','',$post_id);

    switch ( $column ) {

        case 'restaurante' :
            echo get_the_title(rwmb_meta('restaurante','',$post_id));
            break;

        case 'nombre' :
            echo rwmb_meta('nombre','',$post_id);
            break;

        case 'telefono' :
            echo rwmb_meta('telefono','',$post_id);
            break;

        case 'correo' :
            echo rwmb_meta('correo','',$post_id);
            break;

        case 'fecha' :
            echo rwmb_meta('fecha','',$post_id);
            break;

        case 'hora' :
            echo rwmb_meta('hora','',$post_id);
            break;

    }
}



add_filter( 'bulk_actions-edit-reservaciones', 'bulk_actions_reservaciones' );

function bulk_actions_reservaciones( $bulk_actions ) {
  $bulk_actions['exportar'] = __( 'Exportar selección', 'dominio_traduccion');  
  return $bulk_actions;
}

add_filter( 'handle_bulk_actions-edit-reservaciones', 'bulk_actions_handlers_reservaciones', 10, 3 );

function bulk_actions_handlers_reservaciones( $redirect_to, $doaction, $post_ids ) {
  

  if ( $doaction == 'exportar' ) {
    
    
    ob_start();
    $domain = $_SERVER['SERVER_NAME'];
    $filename = 'export-packages-' . $domain . '-' . time() . '.csv';
    
    $header_row = array(
        'ID',
        'Fecha',
        'Restaurante',
        'Motivo',
        'Fecha de reservación',
        'Hora de reservación',
        'a nombre de',
        'DNI',
        'Fecha de nacimiento',
        'Género',
        'Dirección',
        'Correo',
        'Teléfono',
        'Adultos',
        'Niños',
        'Comentario',
    );

    $data_rows = array();
    
    foreach( $post_ids as $post_id ) {

		$motivo  = get_the_term_list( $post_id , 'motivo' , '' , ',' , '' );

	    $row = array(
	    	$post_id,
	    	get_the_date('d-m-Y',$post_id),
	    	get_the_title(rwmb_meta('restaurante','', $post_id)),
	    	strip_tags($motivo),
	    	rwmb_meta('fecha'				,'', $post_id),
	    	rwmb_meta('hora'				,'', $post_id),
	    	rwmb_meta('nombre'				,'', $post_id),
	    	rwmb_meta('dni'				,'', $post_id),
	    	rwmb_meta('birthday'				,'', $post_id),
	    	rwmb_meta('genero'				,'', $post_id),
	    	rwmb_meta('direccion'				,'', $post_id),
	    	rwmb_meta('correo'				,'', $post_id),
	    	rwmb_meta('telefono'				,'', $post_id),
	    	rwmb_meta('adultos'				,'', $post_id),
	    	rwmb_meta('ninos'				,'', $post_id),
	    	rwmb_meta('comentario'				,'', $post_id),
	    );
        $data_rows[] = $row;
	  }

    $fh = @fopen( 'php://output', 'w' );

    fprintf( $fh, chr(0xEF) . chr(0xBB) . chr(0xBF) );
    header( 'Cache-Control: must-revalidate, post-check=0, pre-check=0' );
    header( 'Content-Description: File Transfer' );
    header( 'Content-type: text/csv' );
    header( "Content-Disposition: attachment; filename={$filename}" );
    header( 'Expires: 0' );
    header( 'Pragma: public' );
    fputcsv( $fh, $header_row,";" );
    foreach ( $data_rows as $data_row ) {
        fputcsv( $fh, $data_row , ";");
    }
    fclose( $fh );
    
    ob_end_flush();
    
	}
}


function motivos_select(){

	$terms = get_terms( array(
	    'taxonomy' => 'motivo',
	    'hide_empty' => false,
	) );
	
	$options = '';

	foreach ($terms as $term) {

	$options .= '<option value="'.$term->term_id.'">'.$term->name.'</option>';
	
	}

	return $options;
}



add_action('wp_ajax_nopriv_reservar', 'reservar');
add_action('wp_ajax_reservar', 'reservar');

function reservar(){



	$restaurant 		 = (isset($_POST['restaurant']) 	 	 	&& !empty($_POST['restaurant'])) 			? $_POST['restaurant']  			: null; 
	$nombre 		 	 = (isset($_POST['nombre']) 	  	     	&& !empty($_POST['nombre'])) 				? $_POST['nombre'] 					: null; 
	$dni 		 		 = (isset($_POST['dni']) 	  	  	 	 	&& !empty($_POST['dni'])) 					? $_POST['dni'] 					: null; 
	$genero 		 	 = (isset($_POST['genero']) 	  	 	 	&& !empty($_POST['genero'])) 				? $_POST['genero'] 					: null; 
	$fecha_de_nacimiento = (isset($_POST['fecha_de_nacimiento']) 	&& !empty($_POST['fecha_de_nacimiento'])) 	? $_POST['fecha_de_nacimiento'] 	: null;
	$correo 		 	 = (isset($_POST['correo']) 	  	 		&& !empty($_POST['correo'])) 				? $_POST['correo'] 					: null; 
	$telefono 		 	 = (isset($_POST['telefono']) 	  	 		&& !empty($_POST['telefono'])) 				? $_POST['telefono'] 				: null; 
	$direccion 		 	 = (isset($_POST['direccion']) 	  	 		&& !empty($_POST['direccion'])) 			? $_POST['direccion'] 				: null; 
	$motivo 		 	 = (isset($_POST['motivo']) 	  	 		&& !empty($_POST['motivo'])) 				? $_POST['motivo'] 					: null; 
	$fecha 		 		 = (isset($_POST['fecha']) 	  	 			&& !empty($_POST['fecha'])) 				? $_POST['fecha'] 					: null; 
	$hora 		 		 = (isset($_POST['hora']) 	  	 			&& !empty($_POST['hora'])) 					? $_POST['hora'] 					: null; 
	$adultos 		 	 = (isset($_POST['adultos']) 	  	  	 	&& !empty($_POST['adultos'])) 				? $_POST['adultos'] 				: null; 
	$ninos 				 = (isset($_POST['ninos']) 	 				&& !empty($_POST['ninos'])) 				? $_POST['ninos'] 					: null; 
	$comentarios 		 = (isset($_POST['comentarios']) 	 		&& !empty($_POST['comentarios'])) 			? $_POST['comentarios'] 			: null; 



	if ( $restaurant === null || $nombre === null || $dni === null || $genero === null || $fecha_de_nacimiento === null || $correo === null || $telefono === null || $direccion === null || $motivo === null || $fecha === null || $hora === null || $adultos === null ){

		echo 'data_invalid'; return wp_die();

	}	

		 $args = array(
	    'post_type'  => 'reservaciones',
	    'post_status' => array('draft'),
	    'meta_query' => array(
	        'relation' => 'AND',
	        array(
	            'key'     => 'correo',
	            'value'   => $correo,
	            'compare' => '==',
	        ),

	        array(
	            'key'     => 'fecha',
	            'value'   => $fecha,
	            'compare' => '==',
	        ),

	        array(
	            'key'     => 'restaurante',
	            'value'   => $restaurant,
	            'compare' => '==',
	        ),
	    )
	);

	$posts = get_posts($args);

	if (count($posts) >= 1) {
		echo 'exist'; return wp_die();
	}


	$args = array(
			'post_title'    => 'Nueva reserva para '.get_the_title($restaurant).' para el '.$fecha .' a las '.$hora,
			'post_status'   => 'draft',
			'post_type'     => 'reservaciones',
		);

	$ID = wp_insert_post( $args );

	if ($ID === 0) {
		echo 'error'; return wp_die();
	}


		wp_set_post_terms($ID, array($motivo) ,'motivo');
		add_post_meta($ID, 'restaurante', 	$restaurant,  true);
		add_post_meta($ID, 'fecha', 		$fecha,       true);
		add_post_meta($ID, 'hora',			$hora,		  true);
		add_post_meta($ID, 'nombre',		$nombre,	  true);
		add_post_meta($ID, 'dni', 			$dni,  		  true);
		add_post_meta($ID, 'birthday', 		$fecha_de_nacimiento, 	  true);
		add_post_meta($ID, 'genero',		$genero, 	  true);
		add_post_meta($ID, 'direccion', 	$direccion,   true);
		add_post_meta($ID, 'correo',		$correo, 	  true);
		add_post_meta($ID, 'telefono', 		$telefono,	  true);
		add_post_meta($ID, 'adultos', 		$adultos,	  true);
		add_post_meta($ID, 'ninos',			$ninos,		  true);
		add_post_meta($ID, 'comentario',	$comentarios,  true);


		$headers[]	 = "From: Notificaciones de reserva <".get_option('admin_email').">";
		$headers[]   = 'Reply-To: '.$nombre.' <'.$correo.'>';


		$msg = send_notifications_email($ID,'admin');
		$mensaje = emails_booking_template( $restaurant,null, $msg);
		$correos = rwmb_meta( 'correo' ,'',$restaurant);
		wp_mail($correos, 'Nueva reserva para '.get_the_title($restaurant).' para el '.$fecha .' a las '.$hora, $mensaje, $headers);



		$headers[]	 = "From: Notificaciones de reserva <".get_option('admin_email').">";
		$headers[]   = 'Reply-To: <'.$correos.'>';

		$msg = send_notifications_email($ID);
		$mensaje = emails_booking_template( $restaurant, null , $msg);
		wp_mail($correo, 'Nueva reserva para '.get_the_title($restaurant).' para el '.$fecha .' a las '.$hora, $mensaje, $headers);


		echo 'successfull'; return wp_die();



}


function send_notifications_email($post_id = 0, $tipo = 'cliente'){

			if ($post_id == 0) {
				return 'post not vaild';
			}


			$motivo  = get_the_term_list( $post_id , 'motivo' , '' , ',' , '' );
	    	
	    	$today 			= get_the_date('d-m-Y',$post_id);
	    	$restaurante 	= rwmb_meta('restaurante','',rwmb_meta('restaurante','', $post_id));
	    	$motivos 		= strip_tags($motivo);
	    	$fecha_reserva 	= rwmb_meta('fecha'					,'', $post_id);
	    	$hora_reserva 	= rwmb_meta('hora'					,'', $post_id);
	    	$nombre  		= rwmb_meta('nombre'				,'', $post_id);
	    	$dni 			= rwmb_meta('dni'					,'', $post_id);
	    	$nacimiento 	= rwmb_meta('birthday'				,'', $post_id);
	    	$genero 		= rwmb_meta('genero'				,'', $post_id);
	    	$direccion 		= rwmb_meta('direccion'				,'', $post_id);
	    	$correo 		= rwmb_meta('correo'				,'', $post_id);
	    	$telefono 		= rwmb_meta('telefono'				,'', $post_id);
	    	$adultos 		= rwmb_meta('adultos'				,'', $post_id);
	    	$ninos 			= rwmb_meta('ninos'					,'', $post_id);
	    	$comentario 	= rwmb_meta('comentario'			,'', $post_id);
	

			$mensaje = '
			<h4>Nueva reservación</h4>
			<p>Fecha: '.$fecha_reserva.':</p>
			<p>Hora: '.$hora_reserva.':</p>
			
			<p><b>Datos del cliente:</b><br>
			<p>nombre: '.$nombre.'</p> 
			<p>DNI: '.$dni.'</p> 
			<p>Fecha de nacimiento: '.$nacimiento.'</p> 
			<p>Género: '.$genero.'</p>
			 
			<b>Datos de contacto:</b><br>
			<p>Correo: '.$correo.'</p> 
			<p>Teléfono: '.$telefono.'</p> 
			<p>Dirección: '.$direccion.'</p> 

			<b>Datos de la reserva:</b><br>
			<p>Motivo: '.$motivos.'</p> 
			<p>Adultos: '.$adultos.'</p> 
			<p>Niños: '.$adultos.'</p> 
			<p>Comentario: '.$adultos.'</p> 
			</p>
			<p>Esta reserva se generó online</p>
			';

			if ($tipo == 'admin') {
				$mensaje .= '<b>NOTA:</b> Recuerda enviar la confirmación al cliente en un plazo máximo de 24 horas';
			}

			return $mensaje;

}


add_shortcode('send_notifications_email','testing');



add_filter( 'add_menu_classes', 'show_pending_number');

function show_pending_number( $menu ) {
    $type = "reservaciones";
    $status = "draft";
    $num_posts = wp_count_posts( $type, 'readable' );
    $pending_count = 0;
    if ( !empty($num_posts->$status) )
        $pending_count = $num_posts->$status;

    // build string to match in $menu array
    if ($type == 'post') {
        $menu_str = 'edit.php';
    // support custom post types
    } else {
        $menu_str = 'edit.php?post_type=' . $type;
    }

    // loop through $menu items, find match, add indicator
    foreach( $menu as $menu_key => $menu_data ) {
        if( $menu_str != $menu_data[2] )
            continue;
        $menu[$menu_key][0] .= " <span class='update-plugins count-$pending_count'><span class='plugin-count'>" . number_format_i18n($pending_count) . '</span></span>';
    }
    return $menu;
}


function testing(){

$correo 	= 'hola@geekshat.com';
$fecha  	= '2019-12-27';
$hora   	= '08:15';
$restaurant = '274';



}


add_shortcode( 'testing', 'testing' );