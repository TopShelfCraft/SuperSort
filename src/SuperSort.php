<?php
namespace TopShelfCraft\SuperSort;

use Craft;
use TopShelfCraft\base\Plugin;

/**
 * @author Michael Rog <michael@michaelrog.com>
 * @link https://topshelfcraft.com
 * @copyright Copyright 2022, Top Shelf Craft (Michael Rog)
 *
 * @property Sorter $sorter
 */
class SuperSort extends Plugin
{

	public ?string $changelogUrl = "https://raw.githubusercontent.com/TopShelfCraft/SuperSort/master/CHANGELOG.md";
	public bool $hasCpSection = false;
	public bool $hasCpSettings = false;
	public string $schemaVersion = "0.0.0.0";

	/**
	 * Initializes the plugin and registers the Twig extension.
	 */
	public function init()
	{

		$this->setComponents([
			'sorter' => Sorter::class,
		]);

		parent::init();

		Craft::$app->getView()->registerTwigExtension(new SuperSortTwigExtension());

	}

}
