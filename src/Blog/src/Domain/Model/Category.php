<?php

declare(strict_types=1);

namespace Doc\Blog\Domain\Model;

use DateTimeImmutable;
use DateTimeInterface;
use Doc\Blog\Domain\Model\Exceptions\{
    InvalidCategoryDescriptionException,
    InvalidCategoryNameException
};
use Ramsey\Uuid\UuidInterface;

class Category
{
    private function __construct(
        private UuidInterface $uuid,
        private string $name,
        private ?string $description,
        private DateTimeInterface $createdAt
    ) {
    }

    public static function create(UuidInterface $uuid, string $name, ?string $description = null)
    {
        if (strlen($name) < 3 || strlen($name) > 15) {
            throw new InvalidCategoryNameException();
        }

        if (
            null !== $description &&
            is_string($description) &&
            strlen($description) > 255
        ) {
            throw new InvalidCategoryDescriptionException();
        }

        $category = new Category($uuid, $name, $description, new DateTimeImmutable());

        return $category;
    }

    public function ID(): UuidInterface
    {
        return $this->uuid;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function createdAt(): DateTimeInterface
    {
        return $this->createdAt;
    }
}
