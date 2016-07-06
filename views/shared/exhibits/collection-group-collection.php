<div class="collection">

    <h2><?php echo link_to_collection(null,array(),'show',$collection); ?></h2>

    <?php if ($collectionImage = record_image($collection, 'square_thumbnail')): ?>
        <?php echo link_to_collection($collectionImage, array('class' => 'image'),'show',$collection); ?>
    <?php endif; ?>

    <?php if (metadata($collection, array('Dublin Core', 'Description'))): ?>
    <div class="collection-description">
        <?php echo text_to_paragraphs(metadata($collection, array('Dublin Core', 'Description'), array('snippet'=>150))); ?>
    </div>
    <?php endif; ?>

    <?php if ($collection->hasContributor()): ?>
    <div class="collection-contributors">
        <p>
        <strong><?php echo __('Contributors'); ?>:</strong>
        <?php echo metadata($collection, array('Dublin Core', 'Contributor'), array('all'=>true, 'delimiter'=>', ')); ?>
        </p>
    </div>
    <?php endif; ?>

    <p class="view-items-link">
    <?php echo link_to_items_browse(__('View the items in %s', metadata($collection, array('Dublin Core', 'Title'))), array('collection' => metadata($collection, 'id'))); ?></p>

</div>