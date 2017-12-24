<?php
/**
 * SuperSort
 *
 * @author     Michael Rog <michael@michaelrog.com>
 * @link       https://topshelfcraft.com
 * @copyright  Copyright 2017, Michael Rog
 * @see        https://github.com/topshelfcraft/SuperSort
 */

namespace topshelfcraft\supersort\services;

use Craft;
use craft\base\Component;
use craft\elements\db\ElementQuery;


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
	 *
	 * @return array
	 *
	 * @throws \Exception
	 */
	public function superSort($array, $method = 'asort', $as = null, $sortFlag = SORT_REGULAR) {

		$originalArray = $array;

		$method = strtolower($method);

		// Check whether we're using an 'as' method.

		$asMethods = ['sortas', 'rsortas', 'natcasesortas', 'natsortas'];
		$usingAsMethod = in_array($method, $asMethods);

		// Normalize the source array.

		if (! is_array($array)) {

			// TODO: Add better handling for other types of objects (e.g. Arrayables, Collections)

			if ($array instanceof ElementQuery) {
				$array = $array->all();
			}
			else
			{
				$array = [];
			}

		}

		// Normalize the sort flag param.

		settype($sortFlag, 'integer');

		// Pre-processing if we're using an 'as' method...

		if ($usingAsMethod) {

			// Normalize `as` param.

			if (empty($as) || !is_string($as)) {
				$as = '';
			}

			// Create a transformed 'as' array by processing each item as an object template.

			$asArray = $array;

			foreach ($array as $k => $v) {
				$asArray[$k] = Craft::$app->getView()->renderObjectTemplate($as, $v);
			}

		}

		// Do the business.

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

		}

		// Post-processing if we're using an 'as' method...

		if ($usingAsMethod) {

			// Reassemble the result from the newly-sorted transformed 'as' array.

			$array = [];

			foreach ($asArray as $k => $v) {
				$array[$k] = $originalArray[$k];
			}

		}

		return $array;

	}

}
