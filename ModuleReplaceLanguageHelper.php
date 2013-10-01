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
 * Class ModuleReplaceLanguageHelper 
 *
 * @copyright  Glen Langer 2011 
 * @author     Glen Langer <BugBuster> 
 * @package    ReplaceLanguage
 */
class ModuleReplaceLanguageHelper extends Backend
{
	/**
	 * Thanks for this concept to Xtra!
	 */
	
	/**
	 * Constants
	 */
	const REPLACECONFIG_STRING = "/*### BEGIN: Contao Replace Language startup - do not move! ###*/\nModuleReplaceLanguage::check();\n/*### END: Contao Replace Language startup - do not move! ###*/\n\n";
	const REPLACECONFIG_MARKER = " * on every back end and front end request.\n */\n";
	
	/**
	 * Write into system/config/initconfig.php
	 *
	 */
	public function saveReplaceLanguageState($varValue, DataContainer $dc)
	{
		$objFile=new File('system/config/initconfig.php');
		$strContent=$objFile->getContent();
		if($varValue)
		{
			if(!strpos($strContent,self::REPLACECONFIG_STRING))
			{
				// enable ReplaceLanguage
				$strContent=str_replace(self::REPLACECONFIG_MARKER,self::REPLACECONFIG_MARKER.self::REPLACECONFIG_STRING,$strContent);
			}
		} else {
			if(strpos($strContent,self::REPLACECONFIG_STRING))
			{
				// disable ReplaceLanguage
				$strContent=str_replace(self::REPLACECONFIG_STRING,'',$strContent);
			}
		}
		$objFile->write($strContent);
		$objFile->close();
		return $varValue;
	}
	
	/**
	 * Read state from initconfig.php
	 *
	 */
	public function loadReplaceLanguageState($varValue, DataContainer $dc)
	{
		$objFile=new File('system/config/initconfig.php');
		$strContent=$objFile->getContent();
		return $varValue && strpos($strContent,self::REPLACECONFIG_STRING);
	}
	
}

?>