<?php

namespace Ybinrain\Ace\Menu\Filters;

use Illuminate\Contracts\Routing\UrlGenerator;
use Ybinrain\Ace\Menu\Builder;

class HrefFilter implements FilterInterface
{
    protected $urlGenerator;

    public function __construct(UrlGenerator $urlGenerator)
    {
        $this->urlGenerator = $urlGenerator;
    }

    public function transform($item, Builder $builder)
    {
        $item['href'] = $this->makeHref($item);

        return $item;
    }

    protected function makeHref($item)
    {
        if ( !empty($item['url'])) {
            return $this->urlGenerator->to($item['url']);
        }

        return '#';
    }
}
