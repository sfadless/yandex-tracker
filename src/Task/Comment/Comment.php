<?php

declare(strict_types=1);

namespace Sfadless\YandexTracker\Task\Comment;

/**
 * Comment
 *
 * @author Pavel Golikov <pgolikov327@gmail.com>
 */
final class Comment
{
    use CommentTrait;

    /**
     * Comment constructor.
     * @param CommentDTO $commentDTO
     */
    public function __construct(CommentDTO $commentDTO)
    {
        $this->id = $commentDTO->getId();
        $this->longId = $commentDTO->getLongId();
        $this->text = $commentDTO->getText();
        $this->createdBy = $commentDTO->getCreatedBy();
        $this->updatedBy = $commentDTO->getUpdatedBy();
        $this->createdAt = $commentDTO->getCreatedAt();
        $this->updatedAt = $commentDTO->getUpdatedAt();
        $this->version = $commentDTO->getVersion();
        $this->type = $commentDTO->getType();
        $this->transport = $commentDTO->getTransport();
        $this->selfUrl = $commentDTO->getSelfUrl();
    }
}