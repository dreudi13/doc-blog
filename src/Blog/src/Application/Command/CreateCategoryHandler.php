<?php

declare(strict_types=1);

namespace Doc\Blog\Application\Command;

use Doc\Blog\Domain\Model\Category;
use Doc\Blog\Domain\Model\CategoryRepositoryInterface;
use Ramsey\Uuid\Uuid;

class CreateCategoryHandler
{
    public function __construct(
        private CategoryRepositoryInterface $repository
    ) {
    }

    public function handle(CreateCategoryCommand $command): string
    {
        $uuid = Uuid::uuid4();

        $category = Category::create(
            $uuid,
            $command->name,
            $command->description
        );

        $this->repository->save($category);

        return $category->ID()->toString();
    }
}
