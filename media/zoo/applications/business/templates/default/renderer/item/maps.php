<?php
/**
* @package   com_zoo
* @author    YOOtheme http://www.yootheme.com
* @copyright Copyright (C) YOOtheme GmbH
* @license   http://www.gnu.org/licenses/gpl.html GNU/GPL
*/

// no direct access
defined('_JEXEC') or die('Restricted access');

?>

<div class="layout-maps">
	
	<?php if ($this->checkPosition('title')) : ?>
	<h2 class="pos-title">
		<?php echo $this->renderPosition('title'); ?>
	</h2>
	<?php endif; ?>
	
	<?php if ($this->checkPosition('subtitle')) : ?>
	<p class="pos-subtitle">
		<?php echo $this->renderPosition('subtitle', array('style' => 'comma')); ?>
	</p>
	<?php endif; ?>

	<?php if ($this->checkPosition('media')) : ?>
	<div class="pos-media">
		<?php echo $this->renderPosition('media'); ?>
	</div>
	<?php endif; ?>

	<?php if ($this->checkPosition('description')) : ?>
	<div class="pos-description">
		<?php echo $this->renderPosition('description', array('style' => 'block')); ?>
	</div>
	<?php endif; ?>
	
	<?php if ($this->checkPosition('links')) : ?>
	<p class="pos-links">
		<?php echo $this->renderPosition('links', array('style' => 'pipe')); ?>
	</p>
	<?php endif; ?>
	
</div>