<?php

/**
 * Contao Open Source CMS
 *
 * @copyright  MEN AT WORK 2014
 * @package    extendedEditors
 * @license    GNU/LGPL 
 * @filesource
 */

/**
 * Hooks
 */
$GLOBALS['TL_HOOKS']['replaceInsertTags'][] = array('maw.extendededitorsbundle.listener.replaceInsertTags', 'ReplaceInsertTags');
$GLOBALS['TL_HOOKS']['replaceInsertTags'][] = array('maw.extendededitorsbundle.listener.replaceInsertTags', 'ReplaceLanguageTags');