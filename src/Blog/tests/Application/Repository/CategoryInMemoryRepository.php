<?php

declare(strict_types=1);

namespace Doc\Blog\Test\Application\Repository;

use Doc\Blog\Domain\Model\Category;
use Doc\Blog\Domain\Model\CategoryRepositoryInterface;

class CategoryInMemoryRepository implements CategoryRepositoryInterface
{
    public function __construct(
        private array $categories = []
    ) {
    }

    public function save(Category $category): void
    {
        $this->categories[$category->ID()->toString()] = $category;
    }

    public function getCategories(): array
    {
        return $this->categories;
    }
}
