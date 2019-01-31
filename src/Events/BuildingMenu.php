<?php

namespace Ybinrain\Ace\Events;

use Ybinrain\Ace\Menu\Builder;

class BuildingMenu
{
    public $menu;

    public function __construct(Builder $menu)
    {
        $this->menu = $menu;
    }
}

