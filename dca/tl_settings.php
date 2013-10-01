<?php if (!defined('TL_ROOT')) die('You can not access this file directly!');

/**
 * Contao Open Source CMS
 * Copyright (C) 2005-2011 Leo Feyer
 *
 * Formerly known as TYPOlight Open Source CMS.
 *
 * This program is free software: you can redistribute it and/or
 * modify it under the terms of the GNU Lesser General Public
 * License as published by the Free Software Foundation, either
 * version 3 of the License, or (at your option) any later version.
 * 
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the GNU
 * Lesser General Public License for more details.
 * 
 * You should have received a copy of the GNU Lesser General Public
 * License along with this program. If not, please visit the Free
 * Software Foundation website at <http://www.gnu.org/licenses/>.
 *
 * PHP version 5
 * @copyright  Glen Langer 2011 
 * @author     Glen Langer <BugBuster> 
 * @package    ReplaceLanguage 
 * @license    LGPL 
 * @filesource
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
	'inputType'     => 'checkbox',
	'load_callback' => array(array('ModuleReplaceLanguageHelper', 'loadReplaceLanguageState')),
	'save_callback' => array(array('ModuleReplaceLanguageHelper', 'saveReplaceLanguageState'))
);
$GLOBALS['TL_DCA']['tl_settings']['fields']['rl_language'] = array(
	'label'		    => &$GLOBALS['TL_LANG']['tl_settings']['rl_language'],
	'inputType'     => 'text',
	'eval'          => array('mandatory'=>false, 'maxlength'=>2)
);


?>