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
$GLOBALS['TL_DCA']['tl_form_field']['list']['sorting']['child_record_callback'] = array('maw_tl_form_field', 'listFormFields');


/**
 * Class maw_tl_form_field
 *
 * Provide miscellaneous methods that are used by the data configuration array.
 * @copyright  MEN AT WORK 2011 
 * @author     MEN AT WORK <cms@men-at-work.de> 
 * @package    Controller
 */
class maw_tl_form_field extends tl_form_field
{

	/**
	 * Add the type of input field
	 * @param array
	 * @return string
	 */
	public function listFormFields($arrRow)
	{
		$key = $arrRow['invisible'] ? 'unpublished' : 'published';

		$strType = '
<div class="cte_type ' . $key . '">' . $GLOBALS['TL_LANG']['FFL'][$arrRow['type']][0] . ($arrRow['mandatory'] ? ' * ' : ''). ($arrRow['name'] ? ' (' . $arrRow['name'] . ')' : '') . ($arrRow['class'] ? ' [' . $arrRow['class'] . ']' : '') . '</div>
<div class="limit_height' . (!$GLOBALS['TL_CONFIG']['doNotCollapse'] ? ' h32' : '') . ' block">';

		$strClass = $GLOBALS['TL_FFL'][$arrRow['type']];

		if (!$this->classFileExists($strClass))
		{
			return '';
		}

		$objWidget = new $strClass($arrRow);

		$strWidget = $objWidget->parse();
		$strWidget = preg_replace('/ name="[^"]+"/i', '', $strWidget);
		$strWidget = str_replace('type="submit"', 'type="button"', $strWidget);

		if ($objWidget instanceof FormHidden)
		{
			return $strType . "\n" . $objWidget->value . "\n</div>\n";
		}

		return $strType . '
<table cellspacing="0" cellpadding="0" class="tl_form_field_preview" summary="Table holds a form input field">
'.$strWidget.'</table>
</div>' . "\n";
	}

}