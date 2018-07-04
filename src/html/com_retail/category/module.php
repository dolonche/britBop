<?php defined("JPATH_PLATFORM") or die;
if(empty($this->items))
	return;
$colspan=$this->display->image?" colspan=\"2\"":"";?>
   	<table class="itemlist">
   		<thead>
   			<tr>
   				<td<?php echo $colspan;?>><?php echo JText::_("COM_RETAIL_HEADING_TITLE_AND_DESCRIPTION");?></td>
   				<?php if($this->display->price):?>
   				<td width="10%"><?php echo JText::_("COM_RETAIL_HEADING_PRICE");?></td>
   				<?php endif;?>
   				<td width="25%"><?php echo JText::_("COM_RETAIL_HEADING_SIGN_IN");?></td>
   			</tr>
   		</thead>
    	<tbody>
    <?php foreach ($this->items as $item) : ?>
    	<?php $itemlink=JRoute::_(RetailHelperRoute::getProductRoute($item->id, $item->catid));?>
    		<tr>
    		<?php if($this->display->image):?>
    			<td class="modthumbnail">
 				<?php if($this->display->image&&!empty($item->images->intro->image)):?>
    					<?php $image_title=empty($item->images->intro->title)?$item->title:$item->images->intro->title;?>
    					<?php $image_alt=empty($item->images->intro->alt)?$item->title:$item->images->intro->alt;?>
   						<?php $img=JHtml::image($item->images->intro->image, $image_alt, array("title"=>$image_title));?>
    					<?php
    					$class=empty($item->images->intro->float)?"":" {$item->images->intro->float}";
    					$class.=empty($item->images->intro->class)?"":" {$item->images->intro->class}";?>
 						<figure class="image<?php echo $class;?>">
 							<?php echo $img;?>
 							<figcaption><?php echo $image_title;?></figcaption>
						</figure>
				<?php endif;?>
    			</td>
    		<?php endif;?>
    		 	<td>
    				<p>
    					<?php echo JHtml::link($itemlink, $item->title);?>
    					<?php if($this->display->date):?>
    					<br />(<?php echo JHtml::date($item->publish_up);?> - <?php echo JHtml::date($item->publish_down);?>)
    					<?php endif;?>
    				</p>
    				<?php if($this->display->intro):?>
    					<?php echo $item->intro.JHtml::link($itemlink, JText::_("COM_RETAIL_READMORE"));?>
    				<?php endif;?>
    			</td>
    			<?php if($this->display->price):?>
    			<td>
    				<?php echo JHtml::_("retail.price",$item);?>
    			</td>
    			<?php endif;?>
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
    	<tfoot>
    		<tr>
    			<td colspan="5">
				    <div class="pagination">
				    	<?php echo $this->pagination->getPagesLinks(); ?>
				    </div>
    			</td>
    		</tr>
    	</tfoot>
   	</table>