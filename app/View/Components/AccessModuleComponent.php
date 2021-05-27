<?php

namespace App\View\Components;

use Illuminate\Support\Str;
use Illuminate\View\Component;

class AccessModuleComponent extends Component
{

    public $module;

    public $route;
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($permission)
    {
       $this->route = str_replace('_', '-', str_replace('_read', '-index', $permission));
       //$this->module = Str::title('modulo de '.);
       $name = explode('_', $permission);
       if (count($name) > 2) {
            $name = $name[0].'-'.$name[1];
       } else {
             $name = $name[0];
       }
       $this->module = Str::title(__('modules.'.$name));
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\View\View|string
     */
    public function render()
    {
        return view('components.access-module');
    }
}
