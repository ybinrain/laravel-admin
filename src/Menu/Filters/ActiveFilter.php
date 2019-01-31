<?php

namespace Ybinrain\Ace\Menu\Filters;

use Ybinrain\Ace\Menu\ActiveChecker;
use Ybinrain\Ace\Menu\Builder;

class ActiveFilter implements FilterInterface
{
    private $activeChecker;

    public function __construct(ActiveChecker $activeChecker)
    {
        $this->activeChecker = $activeChecker;
    }

    public function transform($item, Builder $builder)
    {
        $item['active'] = $this->activeChecker->isActive($item);

        return $item;
    }
}
