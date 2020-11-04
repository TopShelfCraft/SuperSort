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
use craft\base\Plugin as BasePlugin;
use topshelfcraft\ranger\Plugin;

/**
 * @author   Michael Rog <michael@michaelrog.com>
 * @package  SuperSort
 * @since    3.0.0
 *
 * @property  Sorter $sorter
 */
class SuperSort extends BasePlugin
{

    /**
     * @var bool
     */
    public $hasCpSettings = false;

    /**
     * @var bool
     */
    public $hasCpSection = false;

    /**
     * @var string
     */
    public $schemaVersion = '0.0.0.0';

    /**
	 * @var SuperSort $plugin
     *
     * @deprecated Use `getInstance()` instead.
     * @todo Remove in 4.0
	 */
    public static $plugin;

    /**
     * @param $id
     * @param null $parent
     * @param array $config
     */
    public function __construct($id, $parent = null, array $config = [])
    {

        $config['components'] = [
            'sorter' => Sorter::class,
        ];

        parent::__construct($id, $parent, $config);

    }

	/**
	 * Initializes the plugin, sets its static self-reference, and registers the Twig extension.
	 */
    public function init()
    {

		parent::init();
		Plugin::watch($this);

		// TODO: Remove in 4.0.
		self::$plugin = $this;

		Craft::$app->getView()->registerTwigExtension(new SuperSortTwigExtension());

    }

}
