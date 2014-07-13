<?php
/**
 * @version   $Id: styledeclaration.php 20616 2014-04-24 16:30:33Z arifin $
 * @author		RocketTheme http://www.rockettheme.com
 * @copyright 	Copyright (C) 2007 - 2014 RocketTheme, LLC
 * @license		http://www.gnu.org/licenses/gpl-2.0.html GNU/GPLv2 only
 *
 * Gantry uses the Joomla Framework (http://www.joomla.org), a GNU/GPLv2 content management system
 *
 */
defined('JPATH_BASE') or die();

gantry_import('core.gantryfeature');
gantry_import('core.utilities.gantrymobiledetect');

class GantryFeatureStyleDeclaration extends GantryFeature {
    var $_feature_name = 'styledeclaration';

    function isEnabled() {
		global $gantry;
        $menu_enabled = $this->get('enabled');

        if (1 == (int)$menu_enabled) return true;
        return false;
    }

	function init() {
		global $gantry;
		$browser = $gantry->browser;

        // Logo
    	$css = $this->buildLogo();

        // Less Variables
    	$lessVariables = array(
            'accent-color1'               => $gantry->get('accent-color1',              '#DF392E'),
            'accent-color2'               => $gantry->get('accent-color2',              '#FEB948'),
            'accent-color3'               => $gantry->get('accent-color3',              '#3CA5DA'),

            'pagesurround-type'           => $gantry->get('pagesurround-type',          'preset1'),
            'pagesurround-background'     => $gantry->get('pagesurround-background',    '#E8ECEE'),

            'header-textcolor'            => $gantry->get('header-textcolor',           '#6F849B'),
            'header-background'           => $gantry->get('header-background',          '#2D3945'),
            'header-gap'                  => $gantry->get('header-gap',                 '70'),

            'top-textcolor'               => $gantry->get('top-textcolor',              '#FFFFFF'),
            'top-background'              => $gantry->get('top-background',             'transparent'),

            'utility-textcolor'           => $gantry->get('utility-textcolor',          '#5D6E7F'),
            'utility-background'          => $gantry->get('utility-background',         '#FFFFFF'),

            'showcase-textcolor'          => $gantry->get('showcase-textcolor',         '#FFFFFF'),
            'showcase-background'         => $gantry->get('showcase-background',        '#2D3945'),
            'showcase-type'               => $gantry->get('showcase-type',              'vermilion'),

            'feature-textcolor'           => $gantry->get('feature-textcolor',          '#5D6E7F'),
            'feature-background'          => $gantry->get('feature-background',         '#FFFFFF'),

            'maintop-textcolor'           => $gantry->get('maintop-textcolor',          '#FFFFFF'),
            'maintop-background'          => $gantry->get('maintop-background',         '#DF392E'),
            'maintop-type'                => $gantry->get('maintop-type',               'vermilion'),

            'expandedtop-textcolor'       => $gantry->get('expandedtop-textcolor',      '#6F849B'),
            'expandedtop-background'      => $gantry->get('expandedtop-background',     '#2D3945'),

            'mainbody-overlay'            => $gantry->get('mainbody-overlay',           'light'),

            'expandedbottom-textcolor'    => $gantry->get('expandedbottom-textcolor',   '#5D6E7F'),
            'expandedbottom-background'   => $gantry->get('expandedbottom-background',  '#FFFFFF'),

            'mainbottom-textcolor'        => $gantry->get('mainbottom-textcolor',       '#FFFFFF'),
            'mainbottom-background'       => $gantry->get('mainbottom-background',      '#3CA5DA'),

            'extension-textcolor'         => $gantry->get('extension-textcolor',        '#6F849B'),
            'extension-background'        => $gantry->get('extension-background',       '#2D3945'),

            'bottom-textcolor'            => $gantry->get('bottom-textcolor',           '#5D6E7F'),
            'bottom-background'           => $gantry->get('bottom-background',          '#FFFFFF'),

            'footer-textcolor'            => $gantry->get('footer-textcolor',           '#5D6E7F'),
            'footer-background'           => $gantry->get('footer-background',          '#FFFFFF'),

            'copyright-textcolor'         => $gantry->get('copyright-textcolor',        '#5D6E7F'),
            'copyright-background'        => $gantry->get('copyright-background',       '#FFFFFF')
    	);

        // Section Background Images
        $positions  = array('showcase-customshowcase-image', 'maintop-custommaintop-image');
        $source     = "";

        foreach ($positions as $position) {
            $data = $gantry->get($position, false) ? json_decode(str_replace("'", '"', $gantry->get($position))) : false;
            if ($data) $source = $data->path;
            if (!preg_match('/^\//', $source)) $source = JURI::root(true).'/'.$source;
            $lessVariables[$position] = $data ? 'url(' . $source . ')' : 'none';
        }

        $gantry->addInlineStyle($css);

       	$gantry->addLess('global.less', 'master.css', 7, $lessVariables);

	    $this->_disableRokBoxForiPhone();

        if ($gantry->get('layout-mode')=="responsive") {
            $gantry->addLess('mediaqueries.less');
            $gantry->addLess('menu-dropdown-direction.less');
        }

        if ($gantry->get('layout-mode')=="960fixed")   $gantry->addLess('960fixed.less');
        if ($gantry->get('layout-mode')=="1200fixed")  $gantry->addLess('1200fixed.less');


        // Parallax JS
        $detect = new GantryMobileDetect();
        if ($gantry->get('pagesurround-parallax')) {
            if (!$detect->isTablet() && !$detect->isMobile()) $gantry->addScript('rt-parallax.js');
        }


        // RTL
        if ($gantry->get('rtl-enabled')) $gantry->addLess('rtl.less', 'rtl.css', 8, $lessVariables);

        // Demo Styling
        if ($gantry->get('demo')) $gantry->addLess('demo.less', 'demo.css', 9, $lessVariables);

        // Third Party (k2)
        if ($gantry->get('k2')) $gantry->addLess('thirdparty-k2.less', 'thirdparty-k2.css', 10, $lessVariables);

        // Chart Script
        if ($gantry->get('chart-enabled')) $gantry->addScript('chart.js');
	}

    function buildLogo(){
		global $gantry;

        if ($gantry->get('logo-type')!="custom") return "";

        $source = $width = $height = "";

        $logo = str_replace("&quot;", '"', str_replace("'", '"', $gantry->get('logo-custom-image')));
        $data = json_decode($logo);

        if (!$data){
            if (strlen($logo)) $source = $logo;
            else return "";
        } else {
            $source = $data->path;
        }

        if (substr($gantry->baseUrl, 0, strlen($gantry->baseUrl)) == substr($source, 0, strlen($gantry->baseUrl))){
            $file = JPATH_ROOT . '/' . substr($source, strlen($gantry->baseUrl));
        } else {
            $file = JPATH_ROOT . '/' . $source;
        }

        if (isset($data->width) && isset($data->height)){
            $width = $data->width;
            $height = $data->height;
        } else {
            $size = @getimagesize($file);
            $width = $size[0];
            $height = $size[1];
        }

        if (!preg_match('/^\//', $source))
        {
            $source = JURI::root(true).'/'.$source;
        }

        $source = str_replace(' ', '%20', $source);

        $output = "";
        $output .= "#rt-logo {background: url(".$source.") 50% 0 no-repeat !important;}"."\n";
        $output .= "#rt-logo {width: ".$width."px;height: ".$height."px;}"."\n";

        $file = preg_replace('/\//i', DIRECTORY_SEPARATOR, $file);

        return (file_exists($file)) ?$output : '';
    }

	function _disableRokBoxForiPhone() {
		global $gantry;

		if ($gantry->browser->platform == 'iphone' || $gantry->browser->platform == 'android') {
			$gantry->addInlineScript("window.addEvent('domready', function() {\$\$('a[rel^=rokbox]').removeEvents('click');});");
		}
	}
}