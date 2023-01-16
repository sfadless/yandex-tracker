<?php

declare(strict_types=1);

namespace Sfadless\YandexTracker\User;

use DateTime;
use Exception;
use JsonSerializable;
use Sfadless\YandexTracker\Reference\Traits\SelfUrlTrait;
use Sfadless\YandexTracker\Task\Employee;

/**
 * User
 * @author Alexander Srokin <alexander.srokin@gmail.com>
 */
final class User extends Employee implements JsonSerializable
{
    private ?string $login = null;
    private ?string $trackerUid = null;
    private ?string $passportUid = null;
    private ?string $firstName = null;
    private ?string $lastName = null;
    private ?string $email = null;
    private bool $external;
    private bool $hasLicense;
    private bool $dismissed;
    private bool $useNewFilters;
    private bool $disableNotifications;
    private bool $welcomeMailSent;
    private ?DateTime $firstLoginDate;
    private ?DateTime $lastLoginDate;

    use SelfUrlTrait;

    /**
     * @throws Exception
     */
    public function __construct(array $data)
    {
        parent::__construct((string)$data["uid"], $data["self"], $data["display"]);

        $this->login = $data["login"] ?? null;
        $this->trackerUid = (string)$data["trackerUid"] ?? null;
        $this->passportUid = (string)$data["passportUid"] ?? null;
        $this->firstName = $data["firstName"] ?? null;;
        $this->lastName = $data["lastName"] ?? null;;
        $this->email = $data["email"] ?? null;;
        $this->external = $data["external"] ?? false;
        $this->hasLicense = $data["hasLicense"] ?? false;
        $this->dismissed = $data["dismissed"] ?? false;
        $this->useNewFilters = $data["useNewFilters"] ?? false;
        $this->disableNotifications = $data["disableNotifications"] ?? false;
        $this->welcomeMailSent = $data["welcomeMailSent"] ?? false;
        $this->firstLoginDate = isset($data["firstLoginDate"]) ? new DateTime($data["firstLoginDate"]) : null;
        $this->lastLoginDate = isset($data["lastLoginDate"]) ? new DateTime($data["lastLoginDate"]) : null;
    }

    public function getLogin(): ?string
    {
        return $this->login;
    }

    public function getTrackerUid(): ?string
    {
        return $this->trackerUid;
    }

    public function getPassportUid(): ?string
    {
        return $this->passportUid;
    }

    public function getFirstName(): ?string
    {
        return $this->firstName;
    }

    public function getLastName(): ?string
    {
        return $this->lastName;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function isExternal(): bool
    {
        return $this->external;
    }

    public function isHasLicense(): bool
    {
        return $this->hasLicense;
    }

    public function isDismissed(): bool
    {
        return $this->dismissed;
    }

    public function isUseNewFilters(): bool
    {
        return $this->useNewFilters;
    }

    public function isDisableNotifications(): bool
    {
        return $this->disableNotifications;
    }

    public function isWelcomeMailSent(): bool
    {
        return $this->welcomeMailSent;
    }

    public function getFirstLoginDate(): ?DateTime
    {
        return $this->firstLoginDate;
    }

    public function getLastLoginDate(): ?DateTime
    {
        return $this->lastLoginDate;
    }

    public function jsonSerialize(): array
    {
        return [
            "id" => $this->id,
            "login" => $this->login,
            "firstName" => $this->firstName,
            "lastName" => $this->lastName,
            "display" => $this->display,
            "email" => $this->email,
            "selfUrl" => $this->selfUrl,
        ];
    }
}

