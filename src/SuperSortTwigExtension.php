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


/**
 * @author   Michael Rog <michael@michaelrog.com>
 * @package  SuperSort
 * @since    3.0.0
 */
class SuperSortTwigExtension extends \Twig_Extension
{

    /**
     * @return string
     */
    public function getName()
    {
        return 'SuperSort';
    }


	/*
	 * Public methods
	 */

    /**
     * @return array
     */
    public function getFilters()
    {
        return [
            'supersort' => new \Twig_Filter(
                'supersort',
                [
                    SuperSort::$plugin->sorter,
                    'superSort'
                ]
            )
        ];
    }

}
