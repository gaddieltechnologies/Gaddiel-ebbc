<?php
/**
 * @version		$Id: default_items.php 21700 2011-06-28 04:32:41Z dextercowley $
 * @package		Joomla.Site
 * @subpackage	com_contact
 * @copyright	Copyright (C) 2005 - 2011 Open Source Matters, Inc. All rights reserved.
 * @license		GNU General Public License version 2 or later; see LICENSE.txt
 */

// no direct access
defined('_JEXEC') or die;

$listOrder	= $this->escape($this->state->get('list.ordering'));
$listDirn	= $this->escape($this->state->get('list.direction'));

// Create a shortcut for params.
$params = &$this->item->params;
?>

<?php if (empty($this->items)) : ?>
	<p> <?php echo JText::_('COM_CONTACT_NO_CONTACTS'); ?>	 </p>
<?php else : ?>

<form action="<?php echo htmlspecialchars(JFactory::getURI()->toString()); ?>" method="post" name="adminForm" id="adminForm">
	<fieldset class="filters">
	<?php if ($this->params->get('show_pagination_limit')) : ?>
		<div class="display-limit">
			<?php echo JText::_('JGLOBAL_DISPLAY_NUM'); ?>&#160;
			<?php echo $this->pagination->getLimitBox(); ?>
		</div>
	<?php endif; ?>
	<input type="hidden" name="filter_order" value="<?php echo $listOrder; ?>" />
	<input type="hidden" name="filter_order_Dir" value="<?php echo $listDirn; ?>" />
	</fieldset>

	<table class="category">
		<?php if ($this->params->get('show_headings')) : ?>
		<thead><tr>
			<th class="item-title">
				<?php echo JText::_('JGLOBAL_NUM'); ?>
			</th>
			<th class="item-title">
				<?php echo JHtml::_('grid.sort', 'COM_CONTACT_CONTACT_EMAIL_NAME_LABEL', 'a.name', $listDirn, $listOrder); ?>
			</th>
			<?php if ($this->params->get('show_position_headings')) : ?>
			<th class="item-title">
				<?php echo JHtml::_('grid.sort',  'COM_CONTACT_POSITION', 'a.con_position', $listDirn, $listOrder); ?>
			</th>
			<?php endif; ?>
			<?php if ($this->params->get('show_email_headings')) : ?>
			<th class="item-title">
				<?php echo JText::_('JGLOBAL_EMAIL'); ?>
			</th>
			<?php endif; ?>
			<?php if ($this->params->get('show_telephone_headings')) : ?>
			<th class="item-title">
				<?php echo JText::_('COM_CONTACT_TELEPHONE'); ?>
			</th>
			<?php endif; ?>

			<?php if ($this->params->get('show_mobile_headings')) : ?>
			<th class="item-title">
				<?php echo JText::_('COM_CONTACT_MOBILE'); ?>
			</th>
			<?php endif; ?>

			<?php if ($this->params->get('show_fax_headings')) : ?>
			<th class="item-title">
				<?php echo JText::_('COM_CONTACT_FAX'); ?>
			</th>
			<?php endif; ?>

			<?php if ($this->params->get('show_suburb_headings')) : ?>
			<th class="item-title">
				<?php echo JHtml::_('grid.sort', 'COM_CONTACT_SUBURB', 'a.suburb', $listDirn, $listOrder); ?>
			</th>
			<?php endif; ?>

			<?php if ($this->params->get('show_state_headings')) : ?>
			<th class="item-title">
				<?php echo JHtml::_('grid.sort', 'COM_CONTACT_STATE', 'a.state', $listDirn, $listOrder); ?>
			</th>
			<?php endif; ?>

			<?php if ($this->params->get('show_country_headings')) : ?>
			<th class="item-title">
				<?php echo JHtml::_('grid.sort', 'COM_CONTACT_COUNTRY', 'a.country', $listDirn, $listOrder); ?>
			</th>
			<?php endif; ?>

			</tr>
		</thead>
		<?php endif; ?>

		<tbody>
			<?php foreach($this->items as $i => $item) : ?>
				<tr class="<?php echo ($i % 2) ? "odd" : "even"; ?>">
					<td class="item-title">
						<?php echo $i; ?>
					</td>

					<td class="item-title">
						<a href="<?php echo JRoute::_(ContactHelperRoute::getContactRoute($item->slug, $item->catid)); ?>">
							<?php echo $item->name; ?></a>
					</td>

					<?php if ($this->params->get('show_position_headings')) : ?>
						<td class="item-title">
							<?php echo $item->con_position; ?>
						</td>
					<?php endif; ?>

					<?php if ($this->params->get('show_email_headings')) : ?>
						<td class="item-title">
							<?php echo $item->email_to; ?>
						</td>
					<?php endif; ?>

					<?php if ($this->params->get('show_telephone_headings')) : ?>
						<td class="item-title">
							<?php echo $item->telephone; ?>
						</td>
					<?php endif; ?>

					<?php if ($this->params->get('show_mobile_headings')) : ?>
						<td class="item-title">
							<?php echo $item->mobile; ?>
						</td>
					<?php endif; ?>

					<?php if ($this->params->get('show_fax_headings')) : ?>
					<td class="item-title">
						<?php echo $item->fax; ?>
					</td>
					<?php endif; ?>

					<?php if ($this->params->get('show_suburb_headings')) : ?>
					<td class="item-title">
						<?php echo $item->suburb; ?>
					</td>
					<?php endif; ?>

					<?php if ($this->params->get('show_state_headings')) : ?>
					<td class="item-title">
						<?php echo $item->state; ?>
					</td>
					<?php endif; ?>

					<?php if ($this->params->get('show_country_headings')) : ?>
					<td class="item-title">
						<?php echo $item->country; ?>
					</td>
					<?php endif; ?>
				</tr>
			<?php endforeach; ?>

		</tbody>
	</table>

	<?php if ($this->params->get('show_pagination')) : ?>
	<div class="pagination">
		<?php if ($this->params->def('show_pagination_results', 1)) : ?>
		<p class="counter">
			<?php echo $this->pagination->getPagesCounter(); ?>
		</p>
		<?php endif; ?>
		<?php echo $this->pagination->getPagesLinks(); ?>
	</div>
	<?php endif; ?>
</form>
<?php endif; ?>

<div class="item-separator"></div>
