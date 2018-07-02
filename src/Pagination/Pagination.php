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
        $prevlink = ($currentPage > 1) ? "<li class='page-item'><a class='page-link' href='?page=" . ($currentPage - 1) . "'>Previus</a></li>" : "";
        $nextlink = ($currentPage < $pages) ? "<li class='page-item'><a class='page-link' href='?page=" . ($currentPage + 1) . "'>Next</a></li>" : "";

        $row = "";
        $row .= $prevlink;
        for ($i = 1; $i <= $pages; $i++) {
            $page = $di->get("url")->create("?page=$i");
            $active = $currentPage == $i ? "active" : "";
            
            $row .= "<li class='page-item $active'><a class='page-link' href='$page'>$i</a></li>";
        }
        $row .= $nextlink;
        return $row;
    }
}
