<?php
$exhibitTags = isset($options['tags'])
    ? html_escape($options['tags'])
    : '';
$exhibitSlugs = isset($options['slugs'])
    ? html_escape($options['slugs'])
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
if ($exhibitTags) {$queryParams['tags']=$exhibitTags;}
if ($exhibitSlugs) {
  $exhibitSlugs = explode(",",$exhibitSlugs);
  $queryParams['slug']= array_map(function($x) {return trim($x);}, $exhibitSlugs);
}
$exhibits = get_records('Exhibit',$queryParams,50);

?>

<h2><?php echo $sectionTitle; ?></h2>
<div class="exhibit-group <?php echo $columns; ?>">
    <?php
    foreach ($exhibits as $exhibit): ?>
        <?php echo $this->partial('exhibits/exhibit-group-exhibit.php',array('exhibit'=>$exhibit,'snippet'=>$snippet)); ?>
    <?php endforeach; ?>
</div>
