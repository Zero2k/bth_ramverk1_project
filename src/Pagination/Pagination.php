<?php

namespace Vibe\Pagination;

use \Anax\DI\InjectionAwareInterface;
use \Anax\DI\InjectionAwareTrait;
use \Anax\Configure\ConfigureInterface;
use \Anax\Configure\ConfigureTrait;

/**
 * Paginate class to paginate thourgh questions.
 */
class Pagination implements ConfigureInterface, InjectionAwareInterface
{
    use InjectionAwareTrait, ConfigureTrait;



    public function renderPagination($tableCount, $offset, $limit, $currentPage, $di)
    {
        $pages = ceil($tableCount / $limit);

        $row = "";
        for ($i = 1; $i <= $pages; $i++) {
            $page = $di->get("url")->create("questions?page=$i");
            $active = $currentPage == $i ? "active" : "";

            $row .= "<li class='page-item $active'><a class='page-link' href='$page'>$i</a></li>";
        }
        return $row;
    }
}
