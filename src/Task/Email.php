<?php

declare(strict_types=1);

namespace Sfadless\YandexTracker\Task;

/**
 * Class Email
 * @author Alexander Srokin <alexander.srokin@gmail.com>
 */
final class Email
{
    private ?string $subject = null;
    private ?string $text = null;
    private ?string $from = null;
    private ?array $to = [];
    private ?array $cc = [];
    private ?string $status = null;
    private ?string $error = null;
    private ?string $hideTextInComments = null;
    private array $addrInvalid = [];
    private array $addrUnsent = [];

    public function getSubject(): ?string
    {
        return $this->subject;
    }

    public function setSubject(?string $subject): Email
    {
        $this->subject = $subject;
        return $this;
    }

    public function getText(): ?string
    {
        return $this->text;
    }

    public function setText(?string $text): Email
    {
        $this->text = $text;
        return $this;
    }

    public function getFrom(): ?string
    {
        return $this->from;
    }

    public function setFrom(?string $from): Email
    {
        $this->from = $from;
        return $this;
    }

    public function getTo(): ?array
    {
        return $this->to;
    }

    public function setTo(?array $to): Email
    {
        $this->to = $to;
        return $this;
    }

    public function getCc(): ?array
    {
        return $this->cc;
    }

    public function setCc(?array $cc): Email
    {
        $this->cc = $cc;
        return $this;
    }

    public function getStatus(): ?string
    {
        return $this->status;
    }

    public function setStatus(?string $status): Email
    {
        $this->status = $status;
        return $this;
    }

    public function getError(): ?string
    {
        return $this->error;
    }

    public function setError(?string $error): Email
    {
        $this->error = $error;
        return $this;
    }

    public function getHideTextInComments(): ?string
    {
        return $this->hideTextInComments;
    }

    public function setHideTextInComments(?string $hideTextInComments): Email
    {
        $this->hideTextInComments = $hideTextInComments;
        return $this;
    }

    public function getAddrInvalid(): array
    {
        return $this->addrInvalid;
    }

    public function setAddrInvalid(array $addrInvalid): Email
    {
        $this->addrInvalid = $addrInvalid;
        return $this;
    }

    public function getAddrUnsent(): array
    {
        return $this->addrUnsent;
    }

    public function setAddrUnsent(array $addrUnsent): Email
    {
        $this->addrUnsent = $addrUnsent;
        return $this;
    }

    public static function fromResponse(array $response): self
    {
        return (new Email())
            ->setSubject($response['subject'])
            ->setText($response['text'] ?? '')
            ->setFrom($response['info']['from'])
            ->setTo($response['info']['to'])
            ->setCc($response['info']['cc'] ?? [])
            ->setFrom($response['info']['from'] ?? [])
            ->setStatus($response['status'])
            ->setError($response['error'])
            ->setAddrInvalid($response['addrInvalid'])
            ->setAddrUnsent($response['addrUnsent'])
            ->setHideTextInComments($response['hideTextInComments'])
        ;
    }
}