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
	$doc->addScript("{$baseuri}media/com_retail/colorbox/jquery.colorbox-min.js");?>
<div class="retail wrapper">
<?php if(!empty($this->categories)):?>
	<?php echo $this->loadTemplate("categories");?>
<?php endif;?>
<?php if ($this->params->get("show_page_heading", 1)) : ?>
	<h1><?php echo $this->escape($this->params->get("page_heading")); ?></h1>
<?php endif; ?>
<form action="<?php echo JRoute::_("index.php?option=com_retail&view=category"); ?>" method="post" id="jform" name="jform">
   	<div class="blog w1">
    <?php foreach ($this->items as $item) : ?>
    	<?php $itemlink=JRoute::_(RetailHelperRoute::getProductRoute($item->id)); ?>
			<div class="blog-item">
   				<h3><?php echo JHtml::link($itemlink, $item->title);?></h3>
    				<?php if(!empty($item->images->intro->image)):?>
					<?php $image_title=empty($item->images->intro->title)?$item->title:$item->images->intro->title;?>
					<?php $image_alt=empty($item->images->intro->alt)?$item->title:$item->images->intro->alt;?>
					<?php $img=JHtml::image($item->images->intro->image, $image_alt, array("title"=>$image_title));?>
					<?php if(!empty($item->images->fulltext->image)){
						$img=JHtml::link($item->images->fulltext->image, $img, array("class"=>"modal"));
					}
					$class=empty($item->images->intro->float)?"":" {$item->images->intro->float}";
					$class.=empty($item->images->intro->class)?"":" {$item->images->intro->class}";?>
					<figure class="image<?php echo $class;?>">
						<?php echo $img;?>
						<?php if(!empty($item->images->intro->caption)):?>
							<figcaption><?php echo $item->images->intro->caption;?></figcaption>
						<?php endif;?>
					</figure>
					<?php endif;?>
   				<?php echo $item->intro.JHtml::link($itemlink, JText::_("COM_RETAIL_READMORE"));?>
				<p><?php JHtml::_("retail.price",$item);?></p>
    			<p><?php echo JText::_("COM_RETAIL_DATE_START");?>: <?php echo JHtml::date($item->publish_up);?>
    			<br /><?php echo JText::_("COM_RETAIL_DATE_END");?>: <?php echo JHtml::date($item->publish_down);?></p>
   				<p><?php echo JHtml::_("retail.comments", $item->id); ?></p>
    		</div>
			<hr class="clear" />
   	<?php endforeach; ?>
   	<?php echo $this->loadTemplate("footer");?>
   	</div>
<?php echo $this->loadTemplate("catinfo");?>

		<input type="hidden" name="option" value="com_retail" />
		<input type="hidden" name="view" value="category" />
</form>
</div>
