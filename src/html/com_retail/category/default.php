<?php defined("JPATH_PLATFORM") or die;
	JHtml::_("jquery.framework");
	JHtml::stylesheet("com_retail/jquery.countdown.css",array(),true);
	JHtml::script("com_retail/jquery.plugin.min.js",false,true);
	JHtml::script("com_retail/jquery.countdown.min.js",false,true);
	JHtml::script("com_retail/jquery.countdown-ru.js",false,true);
	JHtml::script("com_retail/default.js",false,true);
	$iparams=array();
	JText::script("COM_RETAIL_SIGN_IN_COMPLETE");
	$doc = JFactory::getDocument();
	$baseuri=JUri::base();
	$doc->addStyleSheet("{$baseuri}media/com_retail/colorbox/colorbox.css");
	$doc->addScript("{$baseuri}media/com_retail/colorbox/jquery.colorbox-min.js");?>
<div class="retail wrapper">
<?php if ($this->params->get("show_page_heading", 1)) : ?>
<div class="page-header">
	<h1> <?php echo $this->escape($this->params->get("page_heading")); ?> </h1>
</div>
<?php endif; ?>

<?php if(!empty($this->categories)):?>
	<?php echo $this->loadTemplate("categories");?>
<?php endif;?>
<form action="index.php" method="post" id="jform" name="jform">
   	<table class="itemlist">
   		<thead>
   			<tr>
   				<td width="20%"><?php echo JText::_("COM_RETAIL_HEADING_DATE_BOUNDS");?></td>
   				<td><?php echo JText::_("COM_RETAIL_HEADING_TITLE_AND_DESCRIPTION");?></td>
   				<td width="15%"><?php echo JText::_("COM_RETAIL_HEADING_PRICE");?></td>
   				<td width="25%"><?php echo JText::_("COM_RETAIL_HEADING_SIGN_IN");?></td>
   			</tr>
   		</thead>
    	<tbody>
    <?php foreach ($this->items as $item) : ?>
    	<?php $itemlink=JRoute::_(RetailHelperRoute::getProductRoute($item->id));?>
    		<tr>
    			<td>
	    			<time datetime="<?php echo JHtml::date($item->publish_up, "Y-m-d");?>"><?php echo JHtml::date($item->publish_up);?></time>
	   				 -
	   				<time datetime="<?php echo JHtml::date($item->publish_down, "Y-m-d");?>"><?php echo JHtml::date($item->publish_down);?></time>
   				</td>
    			<td>
    				<p><?php echo JHtml::link($itemlink, $item->title);?></p>
    				<?php echo $item->intro.JHtml::link($itemlink, JText::_("COM_RETAIL_READMORE"));?>
    			</td>
    			<td>
					<?php echo JHtml::_("retail.price",$item);?>
    			</td>
    			<td<?php echo ($item->until>0)?" class=\"countdown\"":""?>>
    				<?php if($item->until>0):?>
	    				<?php echo JText::_("COM_RETAIL_SIGN_IN_REMAINING_TIME");?>:
	    				<p> </p>
   						<p>
   							<span class="target" data-limit="<?php echo $item->until;?>"></span>
    					</p>
    					<p class="center">
	   						<button class="oto" data-id="<?php echo $item->id;?>">
	   							<?php echo JText::_("COM_RETAIL_SIGN_IN_BUTTON_CAPTION");?>
	   						</button>
    					</p>
    				<?php elseif($item->running):?>
    					<?php echo JText::_("COM_RETAIL_TRAINING_RUNNING");?>
    				<?php else:?>
    					<?php echo JText::_("COM_RETAIL_SIGN_IN_COMPLETE");?>
    				<?php endif;?>
    				<?php echo JHtml::_("retail.comments", $item->id); ?>
    			</td>
    		</tr>
    <?php endforeach; ?>
    	</tbody>
		<?php echo $this->loadTemplate("footer"); ?>
    </table>
	<?php echo $this->loadTemplate("catinfo");?>
    <div>
		<input type="hidden" name="option" value="com_retail" />
		<input type="hidden" name="view" value="category" />
    </div>
</form>
</div>
