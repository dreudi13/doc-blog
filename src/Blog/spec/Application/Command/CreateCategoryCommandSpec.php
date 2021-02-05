<?php

namespace spec\Doc\Blog\Application\Command;

use Doc\Blog\Application\Command\CreateCategoryCommand;
use PhpSpec\ObjectBehavior;

class CreateCategoryCommandSpec extends ObjectBehavior
{
    function it_is_a_DTO_for_Category()
    {
        $this->beConstructedWith(
            'category_name',
            'THe description can be empty or null'
        );
    }
}
