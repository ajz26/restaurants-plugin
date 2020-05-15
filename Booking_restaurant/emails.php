<?php

function emails_booking_template($restaurant = 0, $title = 'Venus Service Express', $content = ''){

	$images = rwmb_meta( 'banner', array( 'size' => 'full','limit' => 1 ) , $restaurant );
$image = reset( $images );


	$template ='


<!DOCTYPE html>
<html lang="es">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
	<title>'.$title.'</title>
</head>
<body leftmargin="0" marginwidth="0" topmargin="0" marginheight="0" offset="0" style="padding: 0;">
	<div id="wrapper" dir="ltr" style="background-color: #f7f7f7; margin: 0; padding: 70px 0; width: 100%; -webkit-text-size-adjust: none;">
		<table border="0" cellpadding="0" cellspacing="0" height="100%" width="100%">
			<tr>
				<td align="center" valign="top">
					<div id="template_header_image">
						<p style="margin: 0;"> <img src="'.$image['url'].'" style="width: 600px;"></p>
					</div>
						<table border="0" cellpadding="0" cellspacing="0" width="600" id="template_container" style="background-color: #ffffff; border: 1px solid #dedede; box-shadow: 0 1px 4px rgba(0, 0, 0, 0.1); border-radius: 3px;">
							<tr>
								<td align="center" valign="top">
									<!-- Header -->
									<table border="0" cellpadding="0" cellspacing="0" width="600" id="template_header" style="background-color: '.rwmb_meta('color','',$restaurant).';text-align:center; color: #ffffff; border-bottom: 0; font-weight: bold; line-height: 100%; vertical-align: middle; font-family: "Helvetica Neue", Helvetica, Roboto, Arial, sans-serif; border-radius: 3px 3px 0 0;"><tr>
										<td id="header_wrapper" style="text-align:center; padding: 5px 48px; display: block; background-color: '.rwmb_meta('color','',$restaurant).'; color:#ffffff;">
											<h1 style="background-color: '.get_option('woocommerce_email_base_color').'; color: '.get_option('woocommerce_email_text_color').'; text-align:center; font-family: "Helvetica Neue", Helvetica, Roboto, Arial, sans-serif; font-size: 30px; font-weight: 300; line-height: 150%; margin: 0; text-align: left; text-shadow: 0 1px 0 #ffce69; color: #ffffff;">'.rwmb_meta('restaurante',null,$restaurant).'</h1>
										</td>
									</tr>
								</table>
								<!-- End Header -->
							</td>
						</tr>
						<tr>
							<td align="center" valign="top">
								<!-- Body -->
								<table border="0" cellpadding="0" cellspacing="0" width="600" id="template_body">
									<tr>
										<td valign="top" id="body_content" style="background-color: #ffffff;">
											
											<!-- Content -->
											<table border="0" cellpadding="20" cellspacing="0" width="100%"><tr>
												<td valign="top" style="padding: 48px 48px 32px;">
													<div id="body_content_inner" style="color: #636363; font-family: "Helvetica Neue", Helvetica, Roboto, Arial, sans-serif; font-size: 14px; line-height: 150%; text-align: left;">
														<p style="margin: 0 0 16px;">'.$content.'</p>
													</div>
												</td>
											</tr>
										</table>
										<!-- End Content -->

									</td>
								</tr></table>
								<!-- End Body -->
							</td>
						</tr>
					</table>
				</td>
			</tr>
			<tr>
				<td align="center" valign="top">
					<!-- Footer -->
					<table border="0" cellpadding="10" cellspacing="0" width="600" id="template_footer"><tr>
						<td valign="top" style="padding: 0; border-radius: 6px;">
							<table border="0" cellpadding="10" cellspacing="0" width="100%"><tr>
								<td colspan="2" valign="middle" id="credit" style="border-radius: 6px; border: 0; color: #8a8a8a; font-family: "Helvetica Neue", Helvetica, Roboto, Arial, sans-serif; font-size: 12px; line-height: 150%; text-align: center; padding: 24px 0;">
									<p style="margin: 0 0 16px; text-align:center;">'.rwmb_meta('restaurant','',$restaurant).'<br>por <a href="https://geekshat.com/" style="color: #202020; font-weight: normal; text-decoration: underline;">Geekshat</a></p>
								</td>
							</tr></table>
						</td>
					</tr></table>
					<!-- End Footer -->
				</td>
			</tr>
		</table>
	</div>
</body>
</html>
';

	return $template;
};



add_shortcode( 'emails_venus_wc_template','emails_venus_wc_template');