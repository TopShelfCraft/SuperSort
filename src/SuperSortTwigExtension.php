<?php
namespace TopShelfCraft\SuperSort;

use Twig\Extension\AbstractExtension;
use Twig\TwigFilter;
use Twig\TwigFunction;

class SuperSortTwigExtension extends AbstractExtension
{

    public function getName(): string
    {
        return 'SuperSort';
    }

    public function getFilters(): array
    {
        return [
            'supersort' => new TwigFilter('supersort', [Sorter::class, 'superSort'])
        ];
    }

    public function getFunctions(): array
    {
        return [
            'supersort' => new TwigFunction('supersort', [Sorter::class, 'superSort'])
        ];
    }

}
