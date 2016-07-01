<?php
$head = array('bodyclass' => 'tag-everything primary',
			  'title' => html_escape(__('Tag Everything | Browse')),
			  'content_class' => 'horizontal-nav');
echo head($head);
?>
<?php echo flash(); ?>

<a class="add-page button small green" href="<?php echo html_escape(url('tag-everything/add')); ?>"><?php echo __('Add a Tag Page'); ?></a>
<?php if (!has_loop_records('tag_everything_tag_page')): ?>
	<p><?php echo __('There are no tag pages.'); ?> <a href="<?php echo html_escape(url('tag-everything/add')); ?>"><?php echo __('Add a tag page.'); ?></a></p>
<?php else: ?>
	<?php echo $this->partial('index/browse-list.php', array('tagPages' => $tag_everything_tag_pages)); ?>
<?php endif; ?>
<?php echo foot(); ?>