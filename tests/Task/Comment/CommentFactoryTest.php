<?php

declare(strict_types=1);

namespace Sfadless\YandexTracker\Test\Task\Comment;

use PHPUnit\Framework\TestCase;
use Sfadless\YandexTracker\Task\Comment\CommentFactory;

/**
 * CommentFactoryTest
 *
 * @author Pavel Golikov <pgolikov327@gmail.com>
 */
class CommentFactoryTest extends TestCase
{
    private CommentFactory $commentFactory;

    protected function setUp(): void
    {
        $this->commentFactory = new CommentFactory();
    }

    public function testCreate()
    {
        $comment = $this->commentFactory->create($this->getCommentData());

        $this->assertEquals($comment->getType(), "standard");
        $this->assertEquals($comment->getTransport(), "internal");
        $this->assertEquals($comment->getLongId(), "5fb53a827bc4c1634de30822");
        $this->assertEquals($comment->getSelfUrl(), 'https://api.tracker.yandex.net/v2/issues/FOO_BAR-9999/comments/99999');
        $this->assertEquals($comment->getId(), '30826');
        $this->assertEquals($comment->getText(), 'Второй комментарий, созданный через Api');
        $this->assertEquals($comment->getVersion(), 1);
    }

    private function getCommentData() : array
    {
        return [
            "self" => "https://api.tracker.yandex.net/v2/issues/FOO_BAR-9999/comments/99999",
            "id" => 30826,
            "longId" => "5fb53a827bc4c1634de30822",
            "text" => "Второй комментарий, созданный через Api",
            "createdBy" => [
                "self" => "https://api.tracker.yandex.net/v2/users/1130000041581601",
                "id" => "9990000041255447",
                "display" => "Иван Иванов",
            ],
            "updatedBy" => [
                "self" => "https://api.tracker.yandex.net/v2/users/1130000041581601",
                "id" => "9990000041888888",
                "display" => "Иван Петров",
            ],
            "createdAt" => "2020-11-18T15:15:14.490+0000",
            "updatedAt" => "2020-11-18T15:15:14.490+0000",
            "version" => 1,
            "type" => "standard",
            "transport" => "internal",
        ];
    }
}