<?php

namespace App\Specifications;

class Pagination
{
    public function __construct(
        private int $page = 1,
        private int $perPage = Setting::PAGE_SIZE
    ) {
    }

    public function getPage(): int
    {
        return $this->page;
    }

    public function getPerPage(): int
    {
        return $this->perPage;
    }
}
