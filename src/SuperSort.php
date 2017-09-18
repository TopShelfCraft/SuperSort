<?php

namespace topshelfcraft\supersort;

use craft\base\Plugin;

/**
 * Class SuperSort
 */
class SuperSort extends Plugin
{
    /** @var SuperSort $plugin */
    public static $plugin;

    /**
     * Initialize plugin
     */
    public function init()
    {
        // Make sure parent init functionality runs
        parent::init();

        // Save an instance of this plugin for easy reference throughout app
        self::$plugin = $this;
    }
}
