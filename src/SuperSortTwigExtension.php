<?php
/**
 * SuperSort
 *
 * @author     Michael Rog <michael@michaelrog.com>
 * @link       https://topshelfcraft.com
 * @copyright  Copyright 2017, Michael Rog
 * @see        https://github.com/topshelfcraft/SuperSort
 */

namespace topshelfcraft\supersort;

use Twig\Extension\AbstractExtension;
use Twig\TwigFilter;
use Twig\TwigFunction;

/**
 * @author   Michael Rog <michael@michaelrog.com>
 * @package  SuperSort
 * @since    3.0.0
 */
class SuperSortTwigExtension extends AbstractExtension
{

    /**
     * @return string
     */
    public function getName()
    {
        return 'SuperSort';
    }

    /**
     * @return array
     */
    public function getFilters()
    {
        return [
            'supersort' => new TwigFilter('supersort', [Sorter::class, 'superSort'])
        ];
    }

    public function getFunctions()
    {
        return [
            'supersort' => new TwigFunction('supersort', [Sorter::class, 'superSort'])
        ];
    }

}
