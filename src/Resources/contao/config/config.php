<?php

/**
 * Contao Open Source CMS
 *
 * @copyright  MEN AT WORK 2014
 * @package    extendedEditors
 * @license    GNU/LGPL 
 * @filesource
 */

namespace MenAtWork\ExtendedEditorsBundle\Resources\contao\config;

/**
 * Hooks
 */
$GLOBALS['TL_HOOKS']['replaceInsertTags'][] = array('InsertTags', 'ReplaceInsertTags');
$GLOBALS['TL_HOOKS']['replaceInsertTags'][] = array('InsertTags', 'ReplaceLanguageTags');