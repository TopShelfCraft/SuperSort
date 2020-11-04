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
use craft\base\Component;
use craft\elements\db\ElementQuery;
use yii\base\InvalidArgumentException;

/**
 * @author   Michael Rog <michael@michaelrog.com>
 * @package  SuperSort
 * @since    3.0.0
 */
class Sorter extends Component
{

    /**
     * @param array|ElementQuery $array
     * @param string $method
     * @param string|null $as
     * @param int $sortFlag
     * @param array $comp
     *
     * @return array
     *
     * @throw \Exception
     */
	public static function superSort($array, $method = 'asort', $as = null, $sortFlag = SORT_REGULAR, $comp = [])
    {

		$method = strtolower($method);

		// Normalize the source array.

		if (! is_array($array)) {

			// TODO: Add better handling for other types of objects (e.g. Arrayables, Collections)

			if ($array instanceof ElementQuery) {
				$array = $array->all();
			}
			else
			{
				$array = [$array];
			}

		}

		// Normalize the sort flag param.

		settype($sortFlag, 'integer');

        switch ($method)
        {

            case 'asort':
                asort($array, $sortFlag);
                return $array;

            case 'arsort':
                arsort($array, $sortFlag);
                return $array;

            case 'krsort':
                krsort($array, $sortFlag);
                return $array;

            case 'ksort':
                ksort($array, $sortFlag);
                return $array;

            case 'natcasesort':
                natcasesort($array);
                return $array;

            case 'natsort':
                natsort($array);
                return $array;

            case 'rsort':
                rsort($array, $sortFlag);
                return $array;

            case 'sort':
                sort($array, $sortFlag);
                return $array;

            case 'shuffle':
                shuffle($array);
                return $array;

            case 'uasort':
                uasort($array, $comp);
                return $array;

            case 'customordersort':
                return static::sortByCustomOrder($array, $comp);

            case 'natcasesortas':
            case 'natsortas':
            case 'rsortas':
            case 'sortas':
            case 'customordersortas':
            case 'uasortas':
                return static::sortAs($array, $method, $as, $sortFlag, $comp);

        }

        throw new InvalidArgumentException("{$method} is not a valid method for SuperSort.");

	}

	public static function sortAs($array, $method = 'sortas', $as = null, $sortFlag = SORT_REGULAR, $comp = [])
    {

        $originalArray = $array;

        // Normalize `as` param.

        if (empty($as) || !is_string($as)) {
            $as = '';
        }

        // Create a transformed 'as' array by processing each item as an object template.

        $asArray = [];

        foreach ($array as $k => $v) {
            $asArray[$k] = Craft::$app->getView()->renderObjectTemplate($as, $v);
        }

        // Do the business.

        switch ($method) {

            case 'natcasesortas':
                natcasesort($asArray);
                break;

            case 'natsortas':
                natsort($asArray);
                break;

            case 'rsortas':
                arsort($asArray, $sortFlag);
                break;

            case 'sortas':
                asort($asArray, $sortFlag);
                break;

            case 'uasortas':
                uasort($asArray, $comp);
                break;

            case 'customordersortas':
                $asArray = static::sortByCustomOrder($asArray, $comp);
                break;

        }

        // Reassemble the result from the newly-sorted transformed 'as' array.

        $array = [];

        foreach ($asArray as $k => $v) {
            $array[$k] = $originalArray[$k];
        }

        return $array;

    }

    /**
     * Sorts an array by custom order provided in archetype.
     *
     * Items which do not appear in the archetype list appear at end of the list, in their original relative order.
     *
     * @param array $array
     * @param array $archetype
     *
     * @return array
     */
    public static function sortByCustomOrder($array, $archetype = [])
    {

        // Take values from archetype array and flip them with numeric order values.
        $archetype = array_flip(array_values($archetype));

        uasort($array, function($a, $b) use($archetype) {

            $aPos = $archetype[$a] ?? null;
            $bPos = $archetype[$b] ?? null;

            if ($aPos === null && $bPos !== null)
            {
                return 1;
            }

            if ($aPos !== null && $bPos === null)
            {
                return -1;
            }

            return (int)$aPos - (int)$bPos;

        });

        return $array;

    }

    /**
     * @internal Used for testing the `uasort` and `uasortas` methods.
     *
     * @param $a
     * @param $b
     *
     * @return int
     */
    public static function __test_numericFirst($a, $b)
    {
        return is_numeric($a) ? -1 : (int) is_numeric($b);
    }

}
