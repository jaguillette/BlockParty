<table class="full">
	<thead>
		<tr>
			<?php echo browse_sort_links(array(
				__('Title') => 'title',
				__('Tags') => 'tags',
				__('Slug') => 'slug',
				__('Last Modified') => 'updated'));
			?>
		</tr>
	</thead>
	<tbody>
	<?php foreach (loop('tag_everything_tag_page') as $tagPage): ?>
		<tr>
			<td>
				<span class="title">
					<a href="<?php echo html_escape(record_url('tag_everything_tag_page')); ?>">
						<?php echo metadata('tag_everything_tag_page', 'title'); ?>
					</a>
					<?php if (!metadata('tag_everything_tag_page', 'is_published')): ?>
						(<?php echo __('Private'); ?>)
					<?php endif; ?>
				</span>
				<ul class="action-links group">
					<li><a class="edit" href="<?php html_escape(record_url('tag_everything_tag_page', 'edit')); ?>">
						<?php echo __('Edit'); ?>
					</a></li>
					<li><a class="delete-confirm" href="<?php html_escape(record_url('tag_everything_tag_page', 'delete-confirm')); ?>">
						<?php echo __('Delete'); ?>
					</a></li>
				</ul>
			</td>
			<td><?php echo metadata('tag_everything_tag_page', 'tags') ?></td>
			<td><?php echo metadata('tag_everything_tag_page', 'slug') ?></td>
			<td><?php echo html_escape(format_date(metadata('simple_pages_page', 'updated'), Zend_Date::DATETIME_SHORT)) ?></td>
		</tr>
	<?php endforeach; ?>
	</tbody>
</table>