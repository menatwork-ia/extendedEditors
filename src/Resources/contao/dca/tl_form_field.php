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
 * Table maw_tl_form_field
 */
$GLOBALS['TL_DCA']['tl_form_field']['list']['sorting']['child_record_callback'] = array('MenAtWork\ExtendedEditorsBundle\Contao\Table\FormField', 'listFormFields');
