<?php

namespace Vibe\Navbar;

use \Anax\DI\InjectionAwareInterface;
use \Anax\DI\InjectionAwareTrait;
use \Anax\Configure\ConfigureInterface;
use \Anax\Configure\ConfigureTrait;

/**
* Navbar class.
*/
class Navbar implements ConfigureInterface, InjectionAwareInterface
{
    use InjectionAwareTrait, ConfigureTrait;
    public function renderNav()
    {
        $navbarData = $this->config;
        $menu = "";
        foreach ($navbarData as $key => $value) {
            foreach ($value as $key => $value) {
                $active = $this->di->get("request")->getRoute() == $value ? "active" : "";
                if ($key == "text") {
                    $text = $value;
                } elseif ($key == "route") {
                    $url = $this->di->get("url")->create($value);
                }
            }
            $menu .= "<li class='nav item $active'><a class='nav-link' href=$url>$text</a></li>";
        }
        return $menu;
    }
}
