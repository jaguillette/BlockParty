<div class="item-group-item">
	<h3><?php echo link_to_item(metadata($item,array('Dublin Core', 'Title')),array(),'show',$item); ?></h3>
	<?php if (metadata($item, 'has thumbnail')): ?>
	<div class="item-img">
	    <?php echo link_to_item(item_image('fullsize',array(),0,$item),array(),'show',$item); ?>
	</div>
	<?php endif; ?>
	<div class="item-description">
		<?php 
			$description = metadata($item,array('Dublin Core','Description'));
			if ($snippet) {
				$description = snippet($description,0,$snippet);
			}
			echo $description; ?>
	</div>
</div>