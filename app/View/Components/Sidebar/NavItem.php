<?php

namespace App\View\Components\Sidebar;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class NavItem extends Component
{
    public $title;
    public $route;
    public $icon;
    public $label;
    public $routes;
    public $collapseId;
    public $subItems;
    public $roles; // Tambahkan properti roles

    /**
     * Create a new component instance.
     */
    public function __construct($icon, $label, $title = null, $collapseId = null, $routes = [], $subItems = [], $route = null, $roles = [])
    {
        $this->route = $route;
        $this->icon = $icon;
        $this->label = $label;
        $this->routes = $routes;
        $this->collapseId = $collapseId;
        $this->subItems = $subItems;
        $this->title = $title;
        $this->roles = $roles; // Simpan roles
    }

    public function isActive()
    {
        if ($this->route) {
            return request()->routeIs($this->route);
        }

        foreach ($this->routes as $route) {
            if (request()->routeIs($route)) {
                return true;
            }
        }

        return false;
    }

    public function shouldDisplay()
    {
        if (empty($this->roles)) {
            return true; // Tampilkan jika tidak ada peran yang ditentukan
        }

        return auth()->check() && in_array(auth()->user()->role, $this->roles);
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.sidebar.nav-item');
    }
}
