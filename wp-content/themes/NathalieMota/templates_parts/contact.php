<?php
// Template Name: contact
?>
<div id="contact_popup" class="overlay">
	<div class="popup">
	<img class="popup_img" src="<?php echo get_template_directory_uri(); ?>/assets/images/contact_header.png" alt="entête formulaire de contact">               
	<?php echo do_shortcode( '[contact-form-7 id="7ed6369" title="Formulaire contact pop-up"]' ); ?>
	</div>
</div>
