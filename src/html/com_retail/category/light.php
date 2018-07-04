<?php defined("JPATH_PLATFORM") or die;
/**
 * AJAX layout body
 */
// var_dump($this->params);
if(empty($this->items))
	return;?>
   	<table class="itemlist">
   		<thead>
   			<tr>
   				<td width="25%"><?php echo JText::_("COM_RETAIL_HEADING_DATE_BOUNDS");?></td>
   				<td><?php echo JText::_("COM_RETAIL_HEADING_TITLE_AND_DESCRIPTION");?></td>
   				<td width="10%"><?php echo JText::_("COM_RETAIL_HEADING_PRICE");?></td>
   				<td width="25%"><?php echo JText::_("COM_RETAIL_HEADING_SIGN_IN");?></td>
   			</tr>
   		</thead>
    	<tbody>
    <?php foreach ($this->items as $item) : ?>
    	<?php $itemlink=JRoute::_(RetailHelperRoute::getProductRoute($item->id, $item->catid));?>
    		<tr>
    			<td>
	    			<time datetime="<?php echo JHtml::date($item->publish_up);?>"><?php echo JHtml::date($item->publish_up);?></time> -
	    			<time datetime="<?php echo JHtml::date($item->publish_down);?>"><?php echo JHtml::date($item->publish_down);?></time>
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
    	<?php echo $this->loadTemplate("footer");?>
</table>