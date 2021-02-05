<?php

namespace Doc\Blog\Test\Application\Command;

use Doc\Blog\Application\Command\CreateCategoryCommand;
use Doc\Blog\Application\Command\CreateCategoryHandler;
use Doc\Blog\Test\Application\Repository\CategoryInMemoryRepository;
use PHPUnit\Framework\TestCase;
use Ramsey\Uuid\Uuid;

class CreateCategoryHandlerTest extends TestCase
{
    public function testItHandlesACommandAndReturnTheCategoryIdentifier()
    {
        $repository = new CategoryInMemoryRepository();

        $handler = new CreateCategoryHandler($repository);
        $command = new CreateCategoryCommand('the_name');

        $this->assertCount(0, $repository->getCategories());

        $value = $handler->handle($command);

        $this->assertTrue(Uuid::isValid($value));

        $this->assertCount(1, $repository->getCategories());
    }
}
