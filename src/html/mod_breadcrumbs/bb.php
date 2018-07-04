<?php
/**
 * @package     Joomla.Site
 * @subpackage  mod_breadcrumbs
 *
 * @copyright   Copyright (C) 2005 - 2018 Open Source Matters, Inc. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 */

defined('_JEXEC') or die;
?>
<div class="<?php echo $moduleclass_sfx; ?>">
<ul class="<?php echo $moduleclass_sfx; ?>__list" itemscope itemtype="https://schema.org/BreadcrumbList">
	<?php if ($params->get('showHere', 1)) : ?>
		<li class="<?php echo $moduleclass_sfx; ?>__list-item">
			<?php echo JText::_('MOD_BREADCRUMBS_HERE'); ?>&#160;
		</li>
	<?php else : ?>
	<?php endif; ?>

	<?php
	// Get rid of duplicated entries on trail including home page when using multilanguage
	for ($i = 0; $i < $count; $i++)
	{
		if ($i === 1 && !empty($list[$i]->link) && !empty($list[$i - 1]->link) && $list[$i]->link === $list[$i - 1]->link)
		{
			unset($list[$i]);
		}
	}

	// Find last and penultimate items in breadcrumbs list
	end($list);
	$last_item_key   = key($list);
	prev($list);
	$penult_item_key = key($list);

	// Make a link if not the last item in the breadcrumbs
	$show_last = $params->get('showLast', 1);

	// Generate the trail
	foreach ($list as $key => $item) :
		if ($key !== $last_item_key) :
			// Render all but last item - along with separator ?>
			<li class="<?php echo $moduleclass_sfx; ?>__list-item" itemprop="itemListElement" itemscope itemtype="https://schema.org/ListItem">
				<?php if (!empty($item->link)) : ?>
					<a itemprop="item" href="<?php echo $item->link; ?>" class="pathway"><span itemprop="name"><?php echo $item->name; ?></span></a>
				<?php else : ?>
					<span itemprop="name">
						<?php echo $item->name; ?>
					</span>
				<?php endif; ?>

				<?php if (($key !== $penult_item_key) || $show_last) : ?>
					<span class="divider">
						<?php if (!empty($custom)) : echo $separator; ?>
						<?php else : ?>
						<svg id="arrow-right" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"viewBox="0 0 512 512">
							<path d="M184.7,413.1l2.1-1.8l156.5-136c5.3-4.6,8.6-11.5,8.6-19.2c0-7.7-3.4-14.6-8.6-19.2L187.1,101l-2.6-2.3  C182,97,179,96,175.8,96c-8.7,0-15.8,7.4-15.8,16.6h0v286.8h0c0,9.2,7.1,16.6,15.8,16.6C179.1,416,182.2,414.9,184.7,413.1z"/>
						</svg>
						<?php endif; ?>
					</span>
				<?php endif; ?>
				<meta itemprop="position" content="<?php echo $key + 1; ?>">
			</li>
		<?php elseif ($show_last) :
			// Render last item if reqd. ?>
			<li class="<?php echo $moduleclass_sfx; ?>__list-item" itemprop="itemListElement" itemscope itemtype="https://schema.org/ListItem" class="active">
				<span itemprop="name">
					<?php echo $item->name; ?>
				</span>
				<meta itemprop="position" content="<?php echo $key + 1; ?>">
			</li>
		<?php endif;
	endforeach; ?>
</ul>
</div>