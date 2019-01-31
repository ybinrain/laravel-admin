<?php

namespace Ybinrain\Ace\Menu\Filters;

use Ybinrain\Ace\Menu\Builder;
use Illuminate\Contracts\Auth\Access\Gate;

use Auth;

class GateFilter implements FilterInterface
{
    protected $gate;

    public function __construct(Gate $gate)
    {
        $this->gate = $gate;
    }

    public function transform($item, Builder $builder)
    {
        if (! $this->isVisible($item)) {
            return false;
        }

        return $item;
    }

    protected function isVisible($item)
    {
        if ( empty($item['can'])) {
            return true;
        }

        return Auth::user()->canDo($item['can']);

    }
}