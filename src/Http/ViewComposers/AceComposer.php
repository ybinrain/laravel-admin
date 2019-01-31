<?php

namespace Ybinrain\Ace\Http\ViewComposers;

use Ybinrain\Ace\AceService;
use Illuminate\View\View;

class AceComposer
{
    protected $aceService;

    public function __construct(AceService $aceService)
    {
        $this->aceService = $aceService;
    }

    public function compose(View $view)
    {
        $view->with('ace', $this->aceService);
    }
}
