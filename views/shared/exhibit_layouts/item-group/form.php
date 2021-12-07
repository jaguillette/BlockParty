<?php
$formStem = $block->getFormStem();
$options = $block->getOptions();
?>
<div class="item-details">
    <h4><?php echo __('Section Title'); ?></h4>
    <?php echo $this->formText($formStem . '[options][section-title]', @$options['section-title']); ?>

    <h4><?php echo __('Item Query'); ?></h4>
    <div class="query-param">
        <?php echo $this->formLabel($formStem . '[options][tags]', __('Tags:')); ?>
        <?php echo $this->formText($formStem . '[options][tags]', @$options['tags']); ?>
    </div>

    <div class="query-param">
        <?php echo $this->formLabel($formStem . '[options][collection]', __('Collection:')); ?>
        <?php echo $this->formSelect(
              $formStem . '[options][collection]',
              @$options['collection'],
              array('id' => 'collection-search'),
              get_table_options('Collection')
            ); ?>
    </div>

    <div class="query-param">
        <?php echo $this->formLabel($formStem . '[options][type]', __('Item Type')) ?>
        <?php echo $this->formSelect(
          $formStem . '[options][type]',
          @$options['type'],
          array('id' => 'item-type-search'),
          get_table_options('ItemType')
        ); ?>
    </div>

    <div class="query-param">
        <?php echo $this->formLabel($formStem . '[options][ids]', __('Item IDs:')); ?>
        <?php echo $this->formText($formStem . '[options][ids]', @$options['ids']); ?>
    </div>
</div>

<div class="layout-options">
    <div class="block-header">
        <h4><?php echo __('Layout Options'); ?></h4>
        <div class="drawer-toggle"></div>
    </div>

    <div class="item-group-columns">
        <?php echo $this->formLabel($formStem . '[options][columns]', __('Number of columns')); ?>
        <?php
        echo $this->formSelect($formStem . '[options][columns]',
            @$options['columns'], array(),
            array(
                'oneCol'=>__('One Column'),
                'twoCol'=>__('Two Column'),
                'threeCol'=>__('Three Column'),
            )
        );
        ?>
    </div>

    <div class="snippet">
        <?php echo $this->formLabel($formStem . '[options][snippet]',__('Description snippet length')); ?>
        <?php echo $this->formText($formStem . '[options][snippet]', @$options['snippet']); ?>
        <p class="instructions"><?php echo __('The number of characters that the description text will be limited to. Anything other than a number in this field will be discarded.') ?></p>
    </div>

    <div class="hide-files">
      <?php echo $this->formLabel($formStem . '[options][hidefiles]',__('Hide Item files')); ?>
      <?php
      if (isset($options['hidefiles']) && $options['hidefiles']=='1') {
        $hidefiles = true;
      } else {
        $hidefiles = false;
      }
        ?>
      <?php echo $this->formCheckbox($formStem . '[options][hidefiles]', null, array('checked'=>$hidefiles)); ?>
    </div>

    <div class="show-types">
      <?php echo $this->formLabel($formStem . '[options][showtypes]',__('Display Item Types')); ?>
      <?php
      if (isset($options['showtypes']) && $options['showtypes']=='1') {
        $showtypes = true;
      } else {
        $showtypes = false;
      }
        ?>
      <?php echo $this->formCheckbox($formStem . '[options][showtypes]', null, array('checked'=>$showtypes)); ?>
    </div>
</div>
