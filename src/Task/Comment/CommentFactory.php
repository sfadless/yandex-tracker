<?php

declare(strict_types=1);

namespace Sfadless\YandexTracker\Task\Comment;

use DateTimeImmutable;
use Exception;
use Sfadless\YandexTracker\Task\Employee;
use Symfony\Component\OptionsResolver\OptionsResolver;

/**
 * CommentFactory
 *
 * @author Pavel Golikov <pgolikov327@gmail.com>
 */
final class CommentFactory
{
    /**
     * @param array $data
     *
     * @return Comment
     * @throws Exception
     */
    public function create(array $data) : Comment
    {
        $commentDTO = new CommentDTO();
        $resolver = new OptionsResolver();

        $this->configureResolver($resolver);
        $data = $resolver->resolve($data);

        $createdBy = $this->createEmployee($data[CommentOptions::CREATED_BY]);

        $updatedBy = $data[CommentOptions::CREATED_BY]['id'] === $data[CommentOptions::UPDATED_BY]['id']
            ? $createdBy
            : $this->createEmployee($data[CommentOptions::UPDATED_BY])
        ;

        $commentDTO
            ->setId((string) $data[CommentOptions::ID])
            ->setSelfUrl($data[CommentOptions::SELF_URL])
            ->setLongId($data[CommentOptions::LONG_ID])
            ->setText($data[CommentOptions::TEXT])
            ->setCreatedBy($createdBy)
            ->setUpdatedBy($updatedBy)
            ->setCreatedAt(new DateTimeImmutable($data[CommentOptions::CREATED_AT]))
            ->setUpdatedAt(new DateTimeImmutable($data[CommentOptions::UPDATED_AT]))
            ->setVersion($data[CommentOptions::VERSION])
            ->setType($data[CommentOptions::TYPE])
            ->setTransport($data[CommentOptions::TRANSPORT])
        ;

        return new Comment($commentDTO);
    }

    private function configureResolver(OptionsResolver $resolver)
    {
        $resolver
            ->setDefined([
                CommentOptions::SELF_URL,
                CommentOptions::ID,
                CommentOptions::LONG_ID,
                CommentOptions::TEXT,
                CommentOptions::UPDATED_BY,
                CommentOptions::CREATED_BY,
                CommentOptions::UPDATED_AT,
                CommentOptions::CREATED_AT,
                CommentOptions::VERSION,
                CommentOptions::TRANSPORT,
                CommentOptions::TYPE
            ])
            ->setAllowedTypes(CommentOptions::SELF_URL, 'string')
            ->setAllowedTypes(CommentOptions::ID, ['string', 'int'])
            ->setAllowedTypes(CommentOptions::LONG_ID, 'string')
            ->setAllowedTypes(CommentOptions::TEXT, 'string')
            ->setAllowedTypes(CommentOptions::CREATED_BY, 'array')
            ->setAllowedTypes(CommentOptions::UPDATED_BY, 'array')
            ->setAllowedTypes(CommentOptions::CREATED_AT, 'string')
            ->setAllowedTypes(CommentOptions::UPDATED_AT, 'string')
            ->setAllowedTypes(CommentOptions::VERSION, 'int')
            ->setAllowedValues(CommentOptions::TYPE, [CommentTypes::STANDARD, CommentTypes::INCOMING, CommentTypes::UOTCOMING])
            ->setAllowedValues(CommentOptions::TRANSPORT, [CommentTransports::INTERNAL, CommentTransports::EMAIL])
        ;
    }

    /**
     * @param array $data
     * @return Employee
     */
    private function createEmployee(array $data) : Employee
    {
        return new Employee($data['id'], $data['self'], $data['display']);
    }
}