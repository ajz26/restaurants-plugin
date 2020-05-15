<?php 
/* Plugin Name: Restaurant Booking
 * Description: Booking para Casa andina hoteles 
 * Version: 1.0
 * Author: Antonio Zambrano
 * Author URI: https://geekshat.com
 * Text Domain: geekshat
 */


define('geekshat_plugin_dir', plugin_dir_path( __FILE__ ));
define('geekshat_plugin_url', plugin_dir_url( __FILE__ ));

if ( defined( 'ABSPATH' ) && ! defined( 'RWMB_VER' ) ) {
	require_once geekshat_plugin_dir . '/includes/meta-box/meta-box.php';
	require_once geekshat_plugin_dir . '/includes/meta-box/addons/meta-box-conditional-logic/meta-box-conditional-logic.php';
	require_once geekshat_plugin_dir . '/includes/meta-box/addons/meta-box-columns/meta-box-columns.php';
	require_once geekshat_plugin_dir . '/includes/meta-box/addons/meta-box-group/meta-box-group.php';

}


	require_once geekshat_plugin_dir . 'restaurantes.php';
	require_once geekshat_plugin_dir . 'reservaciones.php';
	require_once geekshat_plugin_dir . 'emails.php';



function geekshat_register_scripts_and_styles(){
	wp_register_script('timepicker', geekshat_plugin_url.'includes/js/jquery.timepicker.min.js',array('jquery'), false, true );

	wp_register_script('swall', 'https://unpkg.com/sweetalert/dist/sweetalert.min.js',array('jquery'), false, true );
	wp_register_script('datepicker', geekshat_plugin_url.'includes/js/datepicker.min.js',array('jquery'), false, true);
	wp_register_script('moment-with-locale', geekshat_plugin_url.'includes/js/moment-with-locales.js',array('jquery'), false, true);
	wp_register_script('moment-timezone', geekshat_plugin_url.'includes/js/moment-timezone.js',array('jquery'), false, true);
	wp_register_script('reservas', geekshat_plugin_url.'includes/js/reservas.js',array('jquery'), false, true );
	wp_register_script('jQuery-mask', geekshat_plugin_url.'includes/js/jquery.mask.js',array('jquery'), false, true );
    wp_localize_script( 'reservas', 'geekshat', array( 'ajax_url' => admin_url( 'admin-ajax.php' )) );    
	wp_register_style('reservas', geekshat_plugin_url.'includes/css/reservas.css','','1.0');
	wp_register_style('bootstrap', geekshat_plugin_url.'includes/css/bootstrap.min.css','','3.4.1');
	wp_register_style('datepicker', geekshat_plugin_url.'includes/css/datepicker.min.css','','1.0.9');

	wp_register_style( 'timepicker', geekshat_plugin_url.'includes/css/jquery.timepicker.min.css','','3.4.1');
}

add_action('init','geekshat_register_scripts_and_styles');


add_action( 'admin_menu', 'geekshat_customize_admin_menu_page' );


function geekshat_customize_admin_menu_page() {

    add_submenu_page('edit.php?post_type=reservaciones',
					 'Restaurantes',
					 'Restaurantes',
					 'manage_options',
					 'edit.php?post_type=restaurantes',
					 '');


    add_submenu_page('edit.php?post_type=reservaciones',
					 'Hoteles',
					 'Hoteles',
					 'manage_options',
					 'edit-tags.php?taxonomy=hotel&post_type=restaurantes',
					 '');
    add_submenu_page('edit.php?post_type=reservaciones',
					 'Ciudades',
					 'Ciudades',
					 'manage_options',
					 'edit-tags.php?taxonomy=ciudad&post_type=restaurantes',
					 '');
	

	remove_submenu_page('edit.php?post_type=reservaciones','post-new.php?post_type=reservaciones');

}


	add_action( 'admin_init', 'register_venus_settings' );

function register_venus_settings() {
	register_setting( 'geekshat-settings-group', 'TerminosCondiciones' );
}


function configuracionesGeekshatReservas(){

 	$TerminosCondiciones = get_option('TerminosCondiciones');

?>

	<div class="wrap">
	<h1>Configuración de reservas</h1>


	<form method="post" action="options.php"> 
	
	<?php 
		settings_fields( 'geekshat-settings-group' );
   		do_settings_sections( 'geekshat-settings-group' );
   	?>
	<table class="form-table">
	<tbody>
	<tr>
	<th scope="row"><label for="blogname">Términos y condiciones</label></th>
	<td><textarea  class="regular-text" name="TerminosCondiciones" placeholder="Indíca los términos y condiciones para las reservas"> <?php echo $TerminosCondiciones ?></textarea></td>
	</tr>
	</tbody>
	</table>
	<?php submit_button(); ?>
	</form>
	</div>

<?php }




function html_content_email(){
    return "text/html";
}
add_filter( 'wp_mail_content_type','html_content_email' );




	function remove_revolution_slider_meta_boxes() {
		remove_meta_box( 'us_page_settings', 'restaurantes', 'normal' );
		remove_meta_box( 'us_page_settings', 'reservaciones', 'normal' );
		remove_meta_box( 'us_portfolio_settings', 'restaurantes', 'normal' );
		remove_meta_box( 'us_portfolio_settings', 'reservaciones', 'normal' );


		remove_meta_box( 'commentstatusdiv', 'restaurantes', 'normal' );
		remove_meta_box( 'commentstatusdiv', 'reservaciones', 'normal' );

		remove_meta_box( 'commentsdiv', 'restaurantes', 'normal' );
		remove_meta_box( 'commentsdiv', 'reservaciones', 'normal' );
		


		
	}

	add_action( 'do_meta_boxes', 'remove_revolution_slider_meta_boxes' );



if ( is_admin() ) {

	function remove_menu_pages_venus() {
		remove_menu_page('vc-general');
		remove_menu_page('about-ultimate');
		// remove_menu_page('edit.php?post_type=shop_order');
	}

	add_action( 'admin_menu', 'remove_menu_pages_venus',9999999 );
	
} 
