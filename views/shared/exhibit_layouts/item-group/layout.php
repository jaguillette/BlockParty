<?php
$itemTags = isset($options['tags'])
    ? html_escape($options['tags'])
    : '';
$itemCollection = isset($options['collection'])
    ? html_escape($options['collection'])
    : '';
$itemType = isset($options['type'])
    ? html_escape($options['type'])
    : '';
$itemIds = isset($options['ids'])
    ? html_escape($options['ids'])
    : '';
$sectionTitle = isset($options['section-title'])
    ? html_escape($options['section-title'])
    : '';
$columns = isset($options['columns'])
    ? html_escape($options['columns'])
    : '';
$snippet = isset($options['snippet']) && is_numeric($options['snippet'])
    ? intval(html_escape($options['snippet']))
    : 0;
$hidefiles = isset($options['hidefiles'])
    ? html_escape($options['hidefiles'])
    : 0;
$showtypes = isset($options['showtypes'])
    ? html_escape($options['showtypes'])
    : 0;

$items = get_records('Item',array('tags'=>$itemTags, 'range'=>$itemIds, 'collection'=>$itemCollection, 'type'=>$itemType),50);
?>

<h2><?php echo $sectionTitle; ?></h2>
<div class="item-group <?php echo $columns; ?>">
    <?php
    foreach ($items as $item): ?>
        <?php echo $this->partial(
          'exhibits/item-group-item.php',
          array(
            'item'=>$item,
            'snippet'=>$snippet,
            'hidefiles'=>$hidefiles,
            'showtypes'=>$showtypes
          )
        ); ?>
    <?php endforeach; ?>
</div>
