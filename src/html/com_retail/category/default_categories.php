<?php defined("JPATH_PLATFORM") or die();?>
<div class="categories w4">
	<?php foreach($this->categories as $item) : ?>
	<?php $catlink=JRoute::_("index.php?option=com_retail&view=category&id={$item->id}");?>
	<div class="item">
		<div class="inside">
			<figure class="image">
				<a href="<?php echo $catlink;?>">
					<?php echo JHtml::image($item->params->image, $item->title);?>
				</a>
				<figcaption><?php echo $item->title;?></figcaption>
			</figure>
			<div class="short-description">
				<?php echo JHtml::_("content.prepare", JHtml::_("retail.split", $item->description)); ?>
			</div>
		</div>
	</div>
	<?php endforeach; ?>
</div>
