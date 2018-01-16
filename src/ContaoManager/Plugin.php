<?php
/**
 * @copyright  MEN AT WORK 2018
 * @package    extendedEditors
 * @license    GNU/LGPL
 */

namespace MenAtWork\ExtendedEditorsBundle\ContaoManager;

use MenAtWork\ExtendedEditorsBundle\ExtendedEditorsBundle;
use Contao\CoreBundle\ContaoCoreBundle;
use Contao\ManagerPlugin\Bundle\BundlePluginInterface;
use Contao\ManagerPlugin\Bundle\Config\BundleConfig;
use Contao\ManagerPlugin\Bundle\Parser\ParserInterface;

class Plugin implements BundlePluginInterface
{
    /**
     * {@inheritdoc}
     */
    public function getBundles(ParserInterface $parser)
    {
        return [
            BundleConfig::create(ExtendedEditorsBundle::class)
                ->setLoadAfter([ContaoCoreBundle::class]),
        ];
    }
}