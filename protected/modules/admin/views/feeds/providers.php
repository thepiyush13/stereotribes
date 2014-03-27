<?php $this->renderPartial('/_partials/_search_panel', array('href' => '/admin/feeds/addsources', 'label' => 'Add Providers'))?>
<div class='row'>
    <?php $this->renderPartial('_sources_listing', array('providers' => $providers)) ?>
</div>
