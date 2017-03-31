<div class="item-group-item">
	<h3><?php echo link_to_item(metadata($item,array('Dublin Core', 'Title')),array(),'show',$item); ?></h3>
	<?php if ($showtypes && metadata($item,'item_type_name')): ?>
		<h4 class="item-type">
			<?php echo metadata($item,'item_type_name'); ?>
		</h4>
	<?php endif; ?>
	<?php if (metadata($item, 'has thumbnail') && $hidefiles != 1): ?>
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
