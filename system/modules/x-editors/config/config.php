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
$GLOBALS['TL_HOOKS']['replaceInsertTags'][] = array('mawExtendedInsertTags', 'mawReplaceInsertTags');
$GLOBALS['TL_HOOKS']['replaceInsertTags'][] = array('mawExtendedInsertTags', 'mawReplaceLanguageTags');