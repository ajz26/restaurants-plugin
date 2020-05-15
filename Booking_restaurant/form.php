<?php  

global $post;

$post_ID = $post->ID;

wp_enqueue_style('reservas');
wp_enqueue_style('datepicker');
wp_enqueue_style('bootstrap');
wp_enqueue_style('timepicker');
wp_enqueue_script('datepicker');
wp_enqueue_script('moment-with-locale');
wp_enqueue_script('moment-timezone');
wp_enqueue_script('swall');
wp_enqueue_script('jQuery-mask');
wp_enqueue_script('reservas');
wp_enqueue_script('timepicker');
wp_localize_script( 'reservas', 'restaurante', array(
												'apertura' 	 => rwmb_get_value('apertura','', $post_ID ),
												'cierre' 	 => rwmb_get_value('cierre','', $post_ID ),
												'tiempo'	 => rwmb_get_value('tiempo','', $post_ID )

												) );    

get_header(); ?>

<div class="container">
	<div class="row">
		<div class="col-md-12 text-center">
			
			<img class="mx-auto d-block"  src="<?php the_post_thumbnail_url( $post_ID); ?>" alt="<?php rwmb_get_value('restaurante'); ?>">
			<b><?php echo rwmb_get_value('restaurante','',$post_ID); ?></b>
		</div>
	</div>
	<div class="row">
		<div class="col-md-12">

			<form action="" id="booking-restaurant-form">
				
				<input type="hidden" value="<?php echo $post_ID ?>" name="restaurant" id="restaurant">

					<h5 class="text-center d-block">Información personal</h5>
				
				<div class="form-row">
					
						<div class="form-group col-12">
						    <label for="nombre">Nombre y apellido</label>
						    <input type="text" class="form-control required" id="nombre" placeholder="Nombre completo">
						</div>

					<div class="form-group col-md-4">
						    <label for="dni">DNI</label>
						    <input type="text" class="form-control required" id="dni" placeholder="Número de Documento de Identidad">
					</div>
					<div class="form-group col-md-4">
						    <label for="fecha-de-nacimiento">Fecha de nacimiento</label>
						    <input type="text" class="form-control required" id="fecha-de-nacimiento" placeholder="Fecha de nacimiento">
					</div>

					<div class="form-group col-md-4">
					      <label for="genero">Género</label>
					      <select id="genero" class="form-control form-control-lg">
					        <option selected value="masculino">Masculino</option>
					        <option value="femenino">Femenino</option>
					      </select>
					</div>
				</div>

				<div class="row">
					<div class="col-12">
					<h5 class="text-center d-block">Datos de contacto</h5>
					</div>
					<div class="col-md-6">
						<div class="form-group">
						    <label for="correo">Email</label>
						    <input type="text" class="form-control required" id="correo" placeholder="Correo electrónico">
						</div>
					</div>
					<div class="col-md-6">
						<div class="form-group">
						    <label for="telefono">Teléfono</label>
						    <input type="text" class="form-control required" id="telefono" placeholder="Teléfono">
						</div>
					</div>
					<div class="col-md-12">
						<div class="form-group">
						    <label for="direccion">Dirección</label>
						    <input type="text" class="form-control required" id="direccion" placeholder="Dirección">
						</div>
					</div>
				</div>

				<div class="row">
					<div class="col-12">
					<h5 class="text-center d-block">Tu reservación</h5>
					</div>

					<div class="col-md-4">
						<div class="form-group">
						    <label for="motivo">Motivo</label>
						   <select  class="form-control form-control-lg" id="motivo">
						   	<?php echo motivos_select(); ?>
						   </select>
						</div>
					</div>
					<div class="col-md-4">
						<div class="form-group">
						    <label for="fecha">Fecha</label>
						    <input type="text" class="form-control required" id="fecha" placeholder="Fecha">
						</div>
					</div>
					<div class="col-md-4">
						<div class="form-group">
						    <label for="hora">Hora</label>
						    <input type="text" class="form-control required" id="hora" placeholder="Hora">
						</div>
					</div>

					<div class="col-md-6">
						<div class="form-group">
						    <label for="adultos">Adultos</label>
						    <input type="text" class="form-control" id="adultos" placeholder="Adultos">
						</div>
					</div>

					<div class="col-md-6">
						<div class="form-group">
						    <label for="ninos">Niños</label>
						    <input type="text" class="form-control" id="ninos" placeholder="Niños">
						</div>
					</div>

					<div class="col-md-12">
						<div class="form-group">
						    <label for="comentarios">Comentarios</label>
						     <textarea class="form-control form-control-lg" id="comentarios" rows="3"></textarea>
						</div>
					</div>

					<div class="form-group col-md-12 my-3">
						<div class="form-check form-check-inline my-5">
						  <input class="form-check-input" type="checkbox" id="terms_conditions">
						  <label class="form-check-label" for="terms_conditions"><b>ENTIENDO Y ACEPTO</b> el tratamiento de mis datos </label>
						</div>
 					 <button type="submit" class="btn btn-secondary btn-lg btn-block">SOLICITAR RESERVA</button>

					</div>
				</div>
				
			</form>
		</div>
	</div>
</div>


<?php get_footer();