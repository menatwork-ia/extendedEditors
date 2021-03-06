<?php

/**
 * Contao Open Source CMS
 *
 * @copyright  MEN AT WORK 2014
 * @package    extendedEditors
 * @license    GNU/LGPL
 * @filesource
 */
namespace MenAtWork\ExtendedEditorsBundle\Contao;
/**
 * Class mawExtendedInsertTags
 *
 * @copyright  MEN AT WORK 2018
 * @package    Frontend
 */
class InsertTags
{
    public function ReplaceInsertTags($strTag)
    {
        $arrSplit = explode('::', $strTag);

        // Replace tag
        switch (strtolower($arrSplit[0])) {
            case 'http':
            case 'cache_http':
            case 'https':
            case 'cache_https':
                if (isset($arrSplit[1])) {
                    $strReturn = '<a ';
                    $strReturn .= ($arrSplit[2] == 'blank') ? "onclick='window.open(this.href); return false;' " : "";
                    $strReturn .= 'href="' . (str_replace('cache_', '', $arrSplit[0])) . '://' . $arrSplit[1] . '">';
                    if (isset($arrSplit[3])) {
                        $strReturn .= $arrSplit[3];
                    } elseif (isset($arrSplit[2])) {
                        $strReturn .= ($arrSplit[2] == 'blank') ? $arrSplit[1] : $arrSplit[2];
                    } else {
                        $strReturn .= $arrSplit[1];
                    }
                    $strReturn .= '</a>';

                    return $strReturn;
                } else {
                    return false;
                }

            case 'anchor':
                return '<a href="' . \Environment::get('request') . '#' . $arrSplit[1] . '">' . $arrSplit[2] . '</a>';

            case 'anchor_open':
                return '<a href="' . \Environment::get('request') . '#' . $arrSplit[1] . '">';

            case 'anchor_close':
                return '</a>';

            case 'comments':
                return $this->countComments($arrSplit[1], $arrSplit[2]);

            case 'download':
                $objFile = \FilesModel::findByUuid($arrSplit[1]);

                return '<a title="' . $arrSplit[2] . '" href="' . $objFile->path . '" >' . $arrSplit[2] . '</a>';
        }

        return false;
    }

    protected function countComments($strParentTable, $intParentId)
    {
        if (empty($strParentTable) || empty($intParentId)) {
            return false;
        }

        $objResult = \Database::getInstance()
            ->prepare('SELECT COUNT(*) as mycount FROM tl_comments WHERE source=? AND parent=?')
            ->execute($strParentTable, $intParentId);

        return $objResult->mycount;
    }

    public function ReplaceLanguageTags($strTag)
    {
        if ($strTag == 'actlang') {
            return $GLOBALS['TL_LANGUAGE'];
        } else {
            return false;
        }
    }

}
