<div class="exhibit">
	<h2><?php echo exhibit_builder_link_to_exhibit($exhibit); ?></h2>
	<?php if ($exhibitImage = record_image($exhibit, 'square_thumbnail')): ?>
        <?php echo exhibit_builder_link_to_exhibit($exhibit, $exhibitImage, array('class' => 'image')); ?>
    <?php endif; ?>
    <?php if ($exhibitDescription = metadata($exhibit, 'description', array('no_escape' => true, 'snippet' => $snippet))): ?>
    <div class="description"><?php echo $exhibitDescription; ?></div>
    <?php endif; ?>
    <?php if ($exhibitTags = tag_string($exhibit, 'exhibits')): ?>
    <p class="tags"><?php echo $exhibitTags; ?></p>
    <?php endif; ?>
</div>
