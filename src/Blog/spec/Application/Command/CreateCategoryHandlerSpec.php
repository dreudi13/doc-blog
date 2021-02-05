<?php

namespace spec\Doc\Blog\Application\Command;

use Doc\Blog\Application\Command\CreateCategoryCommand;
use Doc\Blog\Application\Command\CreateCategoryHandler;
use Doc\Blog\Domain\Model\Category;
use Doc\Blog\Domain\Model\CategoryRepositoryInterface;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class CreateCategoryHandlerSpec extends ObjectBehavior
{
    function let(CategoryRepositoryInterface $repository)
    {
        $this->beConstructedWith($repository);
    }

    function it_handles_a_command_and_return_a_value()
    {
        $command = new CreateCategoryCommand('the_name');

        $value = $this->handle($command);

        $value->shouldbeString();
    }

    function it_stores_a_naw_category_in_the_database(CategoryRepositoryInterface $repository)
    {
        $command = new CreateCategoryCommand('the_name');

        $value = $this->handle($command);

        $repository->save(Argument::type(Category::class))->shouldHaveBeenCalled();
    }
}
