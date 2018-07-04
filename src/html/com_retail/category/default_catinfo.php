<?php defined("JPATH_PLATFORM") or die;
$category=$this->state->get("category");?>
<div class="catinfo">
	<?php echo JHtml::_("content.prepare", JHtml::_("retail.split", $category->description, false)); ?>
</div>

