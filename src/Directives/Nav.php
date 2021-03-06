<?php

namespace Edalzell\Blade\Directives;

use Edalzell\Blade\Concerns\IsDirective;
use Statamic\Tags\ArrayAccessor;
use Statamic\Tags\Context;
use Statamic\Tags\Structure;

class Nav extends Structure
{
    use IsDirective;

    public $directive = 'nav';
    public $key = 'item';
    public $method = 'handleNav';
    public $type = 'loop';

    public function handleNav(string $handle, $params = [])
    {
        $this->initParams($params);

        return $this->structure($handle);
    }

    private function initParams($params = [])
    {
        // Because this extends the `structure` tag, have to fake the parameters
        // Can't use Parameter because that expects even more variables to be set
        // @TODO is there a nicer way to do this?
        $defaults = [
            'from' => null,
            'show_unpublished' => false,
            'include_home' => false,
        ];

        $this->context = Context::make();
        $this->params = ArrayAccessor::make(array_merge($defaults, $params));
    }
}
