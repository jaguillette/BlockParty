<?php
$collectionIds = isset($options['ids'])
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

$queryParams = array();
if ($collectionIds) {$queryParams['range']=$collectionIds;}
$collections = get_records('Collection',$queryParams,50);

?>

<h2><?php echo $sectionTitle; ?></h2>
<div class="collection-group <?php echo $columns; ?>">
    <?php
    foreach ($collections as $collection): ?>
        <?php echo $this->partial('exhibits/collection-group-collection.php',array('collection'=>$collection,'snippet'=>$snippet)); ?>
    <?php endforeach; ?>
</div>

