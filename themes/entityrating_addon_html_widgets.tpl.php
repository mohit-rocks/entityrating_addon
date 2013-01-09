<?php
/**
 * Available variables:
 *  - $widgets: An array with html widgets for rating.
 *  - $node: The full loaded node
 */
?>
<div class="messaging-display">
  <?php
  foreach ($widgets as $key => $widget) {
    print '<div class="rate_widget rate_widget_'.$key.'">'.$widget.'</div>';
  }
  ?>
</div>
