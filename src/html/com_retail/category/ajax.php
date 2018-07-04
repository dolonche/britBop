<?php defined("JPATH_PLATFORM") or die;
	JHtml::_("jquery.framework");
	JHtml::stylesheet("com_retail/jquery.countdown.css",array(),true);
	JHtml::script("com_retail/jquery.plugin.min.js",false,true);
	JHtml::script("com_retail/jquery.countdown.min.js",false,true);
	JHtml::script("com_retail/jquery.countdown-ru.js",false,true);
	JHtml::script("com_retail/default.js",false,true);
	//$iparams=array("width"=>"90", "height"=>"120");
	JText::script("COM_RETAIL_SIGN_IN_COMPLETE");
	$doc = JFactory::getDocument();
	$baseuri=JUri::base();
	$doc->addStyleSheet("{$baseuri}media/com_retail/colorbox/colorbox.css");
	$doc->addScript("{$baseuri}media/com_retail/colorbox/jquery.colorbox-min.js");
	//JHtml::_("bootstrap.framework");?>
<div class="retail wrapper">
	<?php if(!empty($this->categories)):?>
		<?php echo $this->loadTemplate("categories");?>
	<?php endif;?>
	<?php if ($this->params->get("show_page_heading", 1)) : ?>
		<h1> <?php echo $this->escape($this->params->get("page_heading")); ?> </h1>
	<?php endif; ?>
	<?php echo $this->loadTemplate("catinfo");?>
	<form action="<?php echo JRoute::_("index.php?option=com_retail&view=category"); ?>"
			method="post" id="jform" name="jform">
		<div class="ajaxoutline"
			data-context="retail.ajax.category_<?php echo $this->state->category->id;?>"
			data-layout="light"
			<?php echo $this->datastr;?>>
		</div>
	    <div>
			<input type="hidden" name="option" value="com_retail" />
			<input type="hidden" name="view" value="category" />
	    </div>
	</form>
</div>