<?php

namespace Ybinrain\Ace\Menu;

use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Contracts\Routing\UrlGenerator;

class ActiveChecker
{
    private $request;

    private $url;

    public function __construct(Request $request, UrlGenerator $url)
    {
        $this->request = $request;
        $this->url = $url;
    }

    public function isActive($item)
    {
        if ( !empty($item['active'])) {
            return $this->isExplicitActive($item['active']);
        }

        if ( !empty($item['children'])) {
            return $this->containsActive($item['children']);
        }

        if ( !empty($item['url'])) {
            return $this->checkExactOrSub($item['url']);
        }

        return false;
    }

    protected function checkExactOrSub($url)
    {
        return $this->checkExact($url) || $this->checkSub($url);
    }

    protected function checkExact($url)
    {
        return $this->checkPattern($url);
    }

    protected function checkSub($url)
    {
        return $this->checkPattern($url."/*");
    }

    protected function checkPattern($pattern)
    {
        $fullUrlPattern = $this->url->to($pattern);

        $fullUrl = $this->request->fullUrl();

        return Str::is($fullUrlPattern, $fullUrl);
    }

    protected function containsActive($items)
    {
        foreach ($items as $item) {
            if ($this->isActive($item)) {
                return true;
            }
        }
        return false;
    }

    private function isExplicitActive($active)
    {
        if ($this->checkExact($active)) {
            return true;
        }
        return false;
    }
}