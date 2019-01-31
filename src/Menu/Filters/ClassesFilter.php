<?php

namespace Ybinrain\Ace\Menu\Filters;

use Ybinrain\Ace\Menu\Builder;

class ClassesFilter implements FilterInterface
{
    public function transform($item, Builder $builder)
    {
        $item['classes'] = $this->makeClasses($item);
        $item['class'] = implode(' ', $item['classes']);

        return $item;
    }

    protected function makeClasses($item)
    {
        $classes = [];

        if ( !empty($item['active'])) {
            $classes[] = 'active';
            if ( !empty($item['children'])) {
                $classes[] = 'open';
            }
        }


        return $classes;
    }
}
