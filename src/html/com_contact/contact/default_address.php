<?php
/**
 * @package     Joomla.Site
 * @subpackage  com_contact
 *
 * @copyright   Copyright (C) 2005 - 2014 Open Source Matters, Inc. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 */

defined('_JEXEC') or die;

/**
 * marker_class: Class based on the selection of text, none, or icons
 * jicon-text, jicon-none, jicon-icon
 */
?>
<div class="contact-address dl-horizontal">
	<?php if (($this->params->get('address_check') > 0) &&
		($this->contact->address || $this->contact->suburb  || $this->contact->state || $this->contact->country || $this->contact->postcode)) : ?>
		<?php if ($this->params->get('address_check') > 0) : ?>
			<p>
				<span class="<?php echo $this->params->get('marker_class'); ?>" >
					<?php echo $this->params->get('marker_address'); ?>
				</span>

		<?php endif; ?>

		<?php if ($this->contact->address && $this->params->get('show_street_address')) : ?>

				<span class="contact-street">
					<?php echo $this->contact->address ; ?>
				</span>
			</p>
		<?php endif; ?>

		<?php if ($this->contact->suburb && $this->params->get('show_suburb')) : ?>
			<p>
				<span class="contact-suburb">
					<?php echo $this->contact->suburb ; ?>
				</span>
			</p>
		<?php endif; ?>
		<?php if ($this->contact->state && $this->params->get('show_state')) : ?>
			<p>
				<span class="contact-state">
					<?php echo $this->contact->state ; ?>
				</span>
			</p>
		<?php endif; ?>
		<?php if ($this->contact->postcode && $this->params->get('show_postcode')) : ?>
			<p>
				<span class="contact-postcode">
					<?php echo $this->contact->postcode ; ?>
				</span>
			</p>
		<?php endif; ?>
		<?php if ($this->contact->country && $this->params->get('show_country')) : ?>
			<p>
				<span class="contact-country">
					<?php echo $this->contact->country ; ?>
				</span>
			</p>
		<?php endif; ?>

	<?php endif; ?>

<?php if ($this->contact->email_to && $this->params->get('show_email')) : ?>
	</p>
		<span class="<?php echo $this->params->get('marker_class'); ?>" >
			<?php echo nl2br($this->params->get('marker_email')); ?>
		</span>


		<span class="contact-emailto">
			<?php echo $this->contact->email_to; ?>
		</span>
	</p>
<?php endif; ?>

<?php if ($this->contact->telephone && $this->params->get('show_telephone')) : ?>
	</p>
		<span class="<?php echo $this->params->get('marker_class'); ?>" >
			<?php echo $this->params->get('marker_telephone'); ?>
		</span>


		<span class="contact-telephone">
			<?php echo nl2br($this->contact->telephone); ?>
		</span>
	</p>
<?php endif; ?>
<?php if ($this->contact->fax && $this->params->get('show_fax')) : ?>
	<p>
		<span class="<?php echo $this->params->get('marker_class'); ?>" >
			<?php echo $this->params->get('marker_fax'); ?>
		</span>


		<span class="contact-fax">
		<?php echo nl2br($this->contact->fax); ?>
		</span>
	</p>
<?php endif; ?>
<?php if ($this->contact->mobile && $this->params->get('show_mobile')) :?>
	<p>
		<span class="<?php echo $this->params->get('marker_class'); ?>" >
			<?php echo $this->params->get('marker_mobile'); ?>
		</span>


		<span class="contact-mobile">
			<?php echo nl2br($this->contact->mobile); ?>
		</span>
	</p>
<?php endif; ?>
<?php if ($this->contact->webpage && $this->params->get('show_webpage')) : ?>
	<p>
		<span class="<?php echo $this->params->get('marker_class'); ?>" >
		</span>


		<span class="contact-webpage">
			<a href="<?php echo $this->contact->webpage; ?>" target="_blank">
			<?php echo JStringPunycode::urlToUTF8($this->contact->webpage); ?></a>
		</span>
	</p>
<?php endif; ?>
</div>
