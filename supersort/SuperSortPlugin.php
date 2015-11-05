<?php

/**
 * @package   SuperSort
 * @author    Michael Rog
 * @copyright Copyright 2014
 * @link      http://michaelrog.com/craft/supersort
 */

namespace Craft;

class SuperSortPlugin extends BasePlugin
{

    function getName()
    {
         return Craft::t('SuperSort');
    }

    function getVersion()
    {
        return '1.1.0';
    }

    function getDeveloper()
    {
        return 'Michael Rog';
    }

    function getDeveloperUrl()
    {
        return 'http://michaelrog.com/craft';
    }

    function addTwigExtension()
    {
        Craft::import('plugins.supersort.twigextensions.SuperSortTwigExtension');
        return new SuperSortTwigExtension();
    }

}
