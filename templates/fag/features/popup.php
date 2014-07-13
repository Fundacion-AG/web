<?php
/**
* @version   $Id: popup.php 20604 2014-04-24 13:54:10Z arifin $
* @author    RocketTheme http://www.rockettheme.com
* @copyright Copyright (C) 2007 - 2014 RocketTheme, LLC
* @license   http://www.gnu.org/licenses/gpl-2.0.html GNU/GPLv2 only
*
* Gantry uses the Joomla Framework (http://www.joomla.org), a GNU/GPLv2 content management system
*
*/

defined('JPATH_BASE') or die();

gantry_import('core.gantryfeature');

class GantryFeaturePopup extends GantryFeature
{
    var $_feature_name = 'popup';

	function render($position)
	{
		global $gantry;
	    ob_start();

	    $user = JFactory::getUser();

	    ?>
		<div class="rt-block rt-popupmodule-button">
			<?php echo $this->_renderRokBoxLink(); ?>
				<span class="desc"><?php echo $this->get('text'); ?></span>
			</a>
		</div>
		<?php
	    return ob_get_clean();
	}

	function _renderRokBoxLink(){
		$isRokBox2 = @file_exists(JPATH_BASE . '/plugins/editors-xtd/rokbox/rokbox.xml');
		$output = array();

		if ($isRokBox2){
			$output[] = '<a class="'.$this->get('buttontext').'" data-rokbox href="#" data-rokbox-element="#rt-popupmodule">';
		} else {
			$output[] = '<a href="#" class="'.$this->get('buttontext').'" rel="rokbox['.$this->get('width').' '.$this->get('height').'][module=rt-popupmodule]">';
		}

		return implode("\n", $output);
	}
}