<?php

/**
 * Contao Open Source CMS, Copyright (C) 2005-2013 Leo Feyer
 *
 * Contao Module "Replace Language"
 *
 * @copyright  Glen Langer 2011..2013 <http://www.contao.glen-langer.de>
 * @author     Glen Langer (BugBuster)
 * @package    ReplaceLanguage
 * @license    LGPL
 * @filesource
 * @see	       https://github.com/BugBuster1701/replacelanguage
 */


/**
 * Hooks
 */
$GLOBALS['TL_HOOKS']['initializeSystem'][] = array('ReplaceLanguage\ModuleReplaceLanguage', 'check');
//$GLOBALS['TL_HOOKS']['initializeSystem'][] = array('ReplaceLanguage\ModuleReplaceLanguage', 'debug');
