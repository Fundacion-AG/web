<?php
/**
* @version   $Id: popup.php 9685 2013-04-24 19:34:38Z kevin $
* @author    RocketTheme http://www.rockettheme.com
* @copyright Copyright (C) 2007 - 2013 RocketTheme, LLC
* @license   http://www.gnu.org/licenses/gpl-2.0.html GNU/GPLv2 only
*
* Gantry uses the Joomla Framework (http://www.joomla.org), a GNU/GPLv2 content management system
*
*/

defined('JPATH_BASE') or die();

gantry_import('core.gantryfeature');

class GantryFeatureCreditos extends GantryFeature 
{
    var $_feature_name = 'creditos';

	/*function render($position)
	{
		global $gantry;
	    ob_start();

	    $user = JFactory::getUser();
	    
	    ?>
	    <div class="rt-block <?php global $gantry; echo 'rt-'.$gantry->get("blocks-default-overlay").'-block'; ?>">
			<div class="rt-popupmodule-button">
				<?php echo $this->_renderRokBoxLink(); ?>
					<a href="http://www.artmillan.com" title="ArtMillan. C.A." class="powered-by"></a>
				</a>
			</div>
		</div>
		<?php
	    return ob_get_clean();
	}*/


	function render($position) {
	    ob_start();
	    ?>
	    <div class="rt-block fp-feature-02 nomarginall" >
		<a href="#" class="rt-powered-by" data-rokbox data-rokbox-caption="Creditos web" data-rokbox-element="#rt-creditos"><img src="templates/fag/images/Creditos-Banner.png" /></a>
			
		</div>
		<?php
	    return ob_get_clean();
	}

//<a href="http://www.artmillan.com" title="ArtMillan. C.A." class="powered-by"></a>
	function _renderRokBoxLink(){
		$isRokBox2 = @file_exists(JPATH_BASE . '/plugins/editors-xtd/rokbox/rokbox.xml');
		$output = array();

		if ($isRokBox2){
			$output[] = '<a class="buttontext button" data-rokbox href="#" data-rokbox-element="#rt-creditos">';
		} else {
			$output[] = '<a href="#" class="buttontext button" rel="rokbox['.$this->get('width').' '.$this->get('height').'][module=rt-creditos]">';
		}

		return implode("\n", $output);
	}
}