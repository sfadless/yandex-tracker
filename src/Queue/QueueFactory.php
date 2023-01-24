<?php

declare(strict_types=1);

namespace Sfadless\YandexTracker\Queue;

use Symfony\Component\OptionsResolver\OptionsResolver;

/**
 * QueueFactory
 *
 * @author Pavel Golikov <pgolikov327@gmail.com>
 */
final class QueueFactory
{
    public static function createFromArray(array $data) : Queue
    {
        $resolver = new OptionsResolver();

        self::configureResolver($resolver);

        $resolver->resolve($data);

        $queue = new Queue(
            (string) $data[QueueOptions::ID],
            $data[QueueOptions::KEY],
            $data[QueueOptions::NAME],
            $data[QueueOptions::DESCRIPTION] ?? ''
        );

        $queue
            ->setSelfUrl($data[QueueOptions::SELF_URL])
            ->setVersion($data[QueueOptions::VERSION])
        ;

        return $queue;
    }

    private static function configureResolver(OptionsResolver $resolver) : void
    {
        $resolver
            ->setDefined([
                QueueOptions::SELF_URL,
                QueueOptions::ID,
                QueueOptions::KEY,
                QueueOptions::VERSION,
                QueueOptions::NAME,
                QueueOptions::DESCRIPTION,
                QueueOptions::LEAD,
                QueueOptions::ASSIGN_AUTO,
                QueueOptions::DEFAULT_TYPE,
                QueueOptions::DEFAULT_PRIORITY,
                QueueOptions::ALLOW_EXTRA_MAILING,
                QueueOptions::DENY_VOTING,
                QueueOptions::DENY_CONDUCTOR_AUTOLINK,
                QueueOptions::DENY_TRACKER_AUTOLINK,
                QueueOptions::USE_COMPONENT_PERMISSIONS_INTERSECTION,
                QueueOptions::USE_LATEST_SIGNATURE,
                QueueOptions::ISSUE_TYPES_CONFIG,
                QueueOptions::WORKFLOWS,
                QueueOptions::VERSIONS,
                QueueOptions::ISSUE_TYPES,
                QueueOptions::ADD_ISSUE_KEY_IN_EMAIL,
                QueueOptions::WORK_FLOW_ACTIONS_STYLE,
            ])
        ;
    }
}