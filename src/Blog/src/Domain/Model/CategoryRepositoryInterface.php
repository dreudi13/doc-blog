<?php

declare(strict_types=1);

namespace Doc\Blog\Domain\Model;

interface CategoryRepositoryInterface
{
    public function save(Category $category): void;

    public function getCategories(): array;
}
