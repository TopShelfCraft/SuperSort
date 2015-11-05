<?php

namespace Craft;

class SuperSortTwigExtension extends \Twig_Extension
{

	protected $env;

	public function getName()
	{
		return 'SuperSort Filter';
	}

	public function getFilters()
	{
		return array('supersort' => new \Twig_Filter_Method($this, 'superSort'));
	}

	public function initRuntime(\Twig_Environment $env)
	{
		$this->env = $env;
	}

	public function superSort($array, $method='asort', $as=false, $sortFlag=SORT_REGULAR)
	{

		$originalArray = $array;

		$method = strtolower($method);

		$asMethods = array('sortas', 'rsortas', 'natcasesortas', 'natsortas');
		$usingAsMethod = in_array($method, $asMethods);

		if ( !is_array($array) )
		{

			// TODO: Add better handling for other types of objects

			if ($array instanceof ElementCriteriaModel)
			{
				$array = $array->find();
			}
			else
			{
				$array = array();
			}

		}

		if ( empty($as) or !is_string($as) )
		{
			$as = '';
		}

		if ($usingAsMethod)
		{

			$asArray = $array;

			foreach($array as $k => $v)
			{
				$asArray[$k] = craft()->templates->renderObjectTemplate($as, $v);
			}

		}

		settype($sortFlag, 'integer');

		switch ($method)
		{

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

		if ($usingAsMethod)
		{

			$array = array();

			foreach($asArray as $k => $v)
			{
				$array[$k] = $originalArray[$k];
			}

		}

		return $array;
	}

}