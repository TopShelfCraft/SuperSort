<?php

namespace topshelfcraft\supersort;

use Craft;
use craft\elements\db\ElementQuery;

/**
 * Class SuperSortTwigExtension
 */
class SuperSortTwigExtension extends \Twig_Extension
{
    protected $env;

    /**
     * Get Name
     * @return string
     */
    public function getName()
    {
        return 'SuperSort Filter';
    }

    /**
     * Get filters
     * @return array
     */
    public function getFilters()
    {
        return [
            'supersort' => new \Twig_Filter(
                'supersort',
                [
                    $this,
                    'superSort'
                ]
            )
        ];
    }

    /**
     * Init runtime
     * @param \Twig_Environment $env
     */
    public function initRuntime(\Twig_Environment $env)
    {
        $this->env = $env;
    }

    /**
     * Super sort
     * @param $array
     * @param string $method
     * @param bool|string $as
     * @param int $sortFlag
     * @return array
     * @throws \Exception
     */
    public function superSort(
        $array,
        $method = 'asort',
        $as = false,
        $sortFlag = SORT_REGULAR
    ) {

        $originalArray = $array;

        $method = strtolower($method);

        $asMethods = [
            'sortas',
            'rsortas',
            'natcasesortas',
            'natsortas'
        ];

        $usingAsMethod = in_array($method, $asMethods, false);

        if (! is_array($array)) {
            // TODO: Add better handling for other types of objects

            $newArray = array();

            if ($array instanceof ElementQuery) {
                $newArray = $array->all();
            }

            $array = $newArray;
        }

        if (empty($as) || ! is_string($as)) {
            $as = '';
        }

        if ($usingAsMethod) {
            $asArray = $array;

            foreach ($array as $k => $v) {
                $asArray[$k] = Craft::$app->view->renderObjectTemplate($as, $v);
            }
        }

        settype($sortFlag, 'integer');

        switch ($method) {
            case 'asort':
                asort($array, $sortFlag);
                break;

            case 'arsort':
                arsort($array, $sortFlag);
                break;

            case 'krsort':
                krsort($array, $sortFlag);
                break;

            case 'ksort':
                ksort($array, $sortFlag);
                break;

            case 'natcasesort':
                natcasesort($array);
                break;

            case 'natsort':
                natsort($array);
                break;

            case 'rsort':
                rsort($array, $sortFlag);
                break;

            case 'sort':
                sort($array, $sortFlag);
                break;

            case 'shuffle':
                shuffle($array);
                break;

            case 'rsortas':
                arsort($asArray, $sortFlag);
                break;

            case 'sortas':
                asort($asArray, $sortFlag);
                break;

            case 'natcasesortas':
                natcasesort($asArray);
                break;

            case 'natsortas':
                natsort($asArray);
                break;
        }

        if ($usingAsMethod) {
            $array = array();

            foreach ($asArray as $k => $v) {
                $array[$k] = $originalArray[$k];
            }

        }

        return $array;
    }
}
