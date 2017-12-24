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

use Craft;
use craft\base\Plugin;
use topshelfcraft\supersort\services\Sorter;


/**
 * @author   Michael Rog <michael@michaelrog.com>
 * @package  SuperSort
 * @since    3.0.0
 *
 * @property  Sorter $sorter
 */
class SuperSort extends Plugin
{


	/*
	 * Static properties
	 */

    /**
	 * @var SuperSort $plugin
	 */
    public static $plugin;


	/*
	 * Public methods
	 */

	/**
	 * Initializes the plugin, sets its static self-reference, and registers the Twig extension.
	 */
    public function init()
    {

		parent::init();
		self::$plugin = $this;

		Craft::$app->getView()->registerTwigExtension(new SuperSortTwigExtension());

    }


}
