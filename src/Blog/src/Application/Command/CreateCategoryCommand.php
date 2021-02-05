<?php

declare(strict_types=1);

namespace Doc\Blog\Application\Command;

class CreateCategoryCommand
{
    public function __construct(
        public string $name,
        public ?string $description = null
    ) {
    }
}
