<?php

namespace spec\Doc\Blog\Domain\Model;

use DateTimeInterface;
use Doc\Blog\Domain\Model\Category;
use Doc\Blog\Domain\Model\Exceptions\InvalidCategoryDescriptionException;
use Doc\Blog\Domain\Model\Exceptions\InvalidCategoryNameException;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;
use Ramsey\Uuid\Uuid;

class CategorySpec extends ObjectBehavior
{
    function it_is_created_through_a_static_constructor()
    {
        $uuid = $this->generateUuid();

        $this->beConstructedThrough('create', [
            $uuid,
            'name',
            'The optional description',
        ]);

        $this->ID()->shouldReturn($uuid);
        $this->getName()->shouldReturn('name');
        $this->getDescription()->shouldReturn('The optional description');
    }

    function its_name_should_have_a_min_length_of_3_characters()
    {
        $this->beConstructedThrough('create', [
            $this->generateUuid(),
            'tu',
            Argument::any(),
        ]);

        $this->shouldThrow(InvalidCategoryNameException::class)->duringInstantiation();
    }

    function its_name_should_have_a_max_length_of_15_characters()
    {
        $this->beConstructedThrough('create', [
            $this->generateUuid(),
            'tipazidosjcjiekfhqyhduiapu',
            Argument::any(),
        ]);

        $this->shouldThrow(InvalidCategoryNameException::class)->duringInstantiation();
    }

    function its_description_should_have_a_max_length_of_255_characters()
    {
        $this->beConstructedThrough('create', [
            $this->generateUuid(),
            'name',
            $this->tooLongDescription(),
        ]);

        $this->shouldThrow(InvalidCategoryDescriptionException::class)->duringInstantiation();
    }

    function its_description_can_be_null_or_empty()
    {
        $this->beConstructedThrough('create', [
            $this->generateUuid(),
            'name',
        ]);

        $this->shouldNotThrow(InvalidCategoryDescriptionException::class)->duringInstantiation();

        $this->getDescription()->shouldBeNull();
    }

    function it_hydrates_the_creation_date_with_a_datetime_interface()
    {
        $this->beConstructedThrough('create', [
            $this->generateUuid(),
            'name',
        ]);

        $this->createdAt()->shouldImplement(DateTimeInterface::class);
    }

    private function tooLongDescription(): string
    {
        return <<<DESCRIPTION
The wave crashed and hit the sandcastle head-on. The sandcastle began to melt under the waves force and as the wave receded, half the sandcastle was gone. The next wave hit, not quite as strong, but still managed to cover the remains of the sandcastle and take more of it away. The third wave, a big one, crashed over the sandcastle completely covering and engulfing it. When it receded, there was no trace the sandcastle ever existed and hours of hard work disappeared forever.
DESCRIPTION;
    }

    private function generateUuid()
    {
        return Uuid::uuid4();
    }
}
