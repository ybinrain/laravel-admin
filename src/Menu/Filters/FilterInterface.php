<?php

namespace Ybinrain\Ace\Menu\Filters;

use Ybinrain\Ace\Menu\Builder;

interface FilterInterface
{
    /**
     * @param $item
     * @param Builder $builder
     * @return mixed
     */
    public function transform($item, Builder $builder);
}