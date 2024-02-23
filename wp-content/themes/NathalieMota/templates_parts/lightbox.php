<?php
// Template Name: lightbox
?>
<div id="lightbox" style="display:none;">
    <button id="close-lightbox">&#10006;</button>
    <div class="lightbox-content">
        <img src="" id="lightbox-img" alt="Image en plein écran">
        <div class="lightbox-info">
            <p id="lightbox-category"></p>
            <p id="lightbox-ref"></p>
        </div>
        <button id="prev-photo"><?php echo '<img src="' . get_template_directory_uri() . '/assets/images/arrow-left.png" alt="Flèche" class="arrow">'; ?> Précédente </button>
        <button id="next-photo">Suivante <?php echo '<img src="' . get_template_directory_uri() . '/assets/images/arrow-right.png" alt="Flèche" class="arrow">'; ?></button>
    </div>
</div>
