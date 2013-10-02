<?php 

/**
 * Contao Open Source CMS, Copyright (C) 2005-2013 Leo Feyer
 *
 * Contao Module "Replace Language" - Backend DCA tl_settings
 *
 * @copyright  Glen Langer 2011..2013 <http://www.contao.glen-langer.de>
 * @author     Glen Langer (BugBuster)
 * @package    ReplaceLanguage
 * @license    LGPL
 * @filesource
 * @see	       https://github.com/BugBuster1701/replacelanguage
 */

/**
 * Add to palette
 */
$GLOBALS['TL_DCA']['tl_settings']['palettes']['default'] .= ';{enable_legend},rl_enable,rl_language';

/**
 * Add fields
 */
$GLOBALS['TL_DCA']['tl_settings']['fields']['rl_enable'] = array(
	'label'		    => &$GLOBALS['TL_LANG']['tl_settings']['rl_enable'],
	'inputType'     => 'checkbox'
);
$GLOBALS['TL_DCA']['tl_settings']['fields']['rl_language'] = array(
	'label'		    => &$GLOBALS['TL_LANG']['tl_settings']['rl_language'],
	'inputType'     => 'text',
	'eval'          => array('mandatory'=>false, 'maxlength'=>2)
);
