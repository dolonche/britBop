<?php defined("JPATH_PLATFORM") or die;?>
<?php if (!empty($this->items)): ?>
	<?php if (($this->params->def("show_pagination", 2) == 1)  || $this->params->get("show_pagination_limit") ||
				($this->params->get('show_pagination') == 2) && ($this->pagination->pagesTotal > 1)) : ?>
    	<tfoot>
    		<tr>
    			<td>
					<?php if ($this->params->get("show_pagination_limit")) : ?>
						<div class="btn-group pull-right">
							<label for="limit" class="element-invisible">
								<?php echo JText::_("JGLOBAL_DISPLAY_NUM"); ?>
							</label>
							<?php echo $this->pagination->getLimitBox(); ?>
						</div>
					<?php endif; ?>
    			</td>
    			<td colspan="4">
					<?php if ($this->params->def('show_pagination_results', 1)) : ?>
						<div class="pagination">
							<?php echo $this->pagination->getPagesCounter(); ?>
						</div>
					<?php endif; ?>
    			</td>
    		</tr>
    		<tr>
    			<td colspan="5" class="center">
					<div class="pagination">
						<?php echo $this->pagination->getPagesLinks(); ?>
					</div>
    			</td>
    		</tr>
    	</tfoot>
	<?php endif;?>
<?php endif; ?>

