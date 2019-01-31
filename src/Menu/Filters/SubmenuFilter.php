<?php

namespace Ybinrain\Ace\Menu\Filters;

use Ybinrain\Ace\Menu\Builder;

class SubmenuFilter implements FilterInterface
{
    public function transform($item, Builder $builder)
    {
        if (isset($item['children'])) {
            $item['children'] = $builder->transformItems($item['children']);
        }
        return $item;
    }
}
