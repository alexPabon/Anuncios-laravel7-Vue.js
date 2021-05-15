<?php

namespace App\View\Components\myFooter;

use Illuminate\View\Component;

class PageLink extends Component
{
    public $url;
    public $imgUrl;
    public $titleLink;

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($url,$imgUrl,$titleLink)
    {
        $this->url = $url;
        $this->imgUrl = $imgUrl;
        $this->titleLink = $titleLink;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\View\View|string
     */
    public function render()
    {
        return view('components.my-footer.page-link');
    }
}
