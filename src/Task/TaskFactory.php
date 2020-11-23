<?php

declare(strict_types=1);

namespace Sfadless\YandexTracker\Task;

use Sfadless\YandexTracker\Reference\FullReference;
use Symfony\Component\OptionsResolver\OptionsResolver;

/**
 * TaskFactory
 *
 * @author Pavel Golikov <pgolikov327@gmail.com>
 */
final class TaskFactory
{
    public function create(array $data) : Task
    {
        $resolver = new OptionsResolver();

        $this->configureResolver($resolver);

        $data = $resolver->resolve($data);

        $task = new Task($data[TaskOptions::ID], $data[TaskOptions::KEY], $data[TaskOptions::SUMMARY]);

        $task
            ->setVersion($data['version'])
            ->setDescription($data['description'])
            ->setSummary($data['summary'])
            ->setCreatedBy($this->getEmployee($data['createdBy']))
            ->setStatus($this->getFullReference($data['status']))
            ->setSelfUrl($data[TaskOptions::SELF_URL])
            ->setType($this->getFullReference($data[TaskOptions::TYPE]))
            ->setQueue($this->getFullReference($data[TaskOptions::QUEUE]))
            ->setPriority($this->getFullReference($data[TaskOptions::PRIORITY]))
        ;

        return $task;
    }

    private function configureResolver(OptionsResolver $resolver)
    {
        $resolver
            ->setDefined([
                TaskOptions::ID,
                TaskOptions::SELF_URL,
                TaskOptions::KEY,
                TaskOptions::VERSION,
                TaskOptions::SUMMARY,
                TaskOptions::STATUS_START_TIME,
                TaskOptions::UPDATED_BY,
                TaskOptions::SLA,
                TaskOptions::DESCRIPTION,
                TaskOptions::TYPE,
                TaskOptions::PRIORITY,
                TaskOptions::CREATED_AT,
                TaskOptions::CREATED_BY,
                TaskOptions::COMMENT_WITHOUT_EXTERNAL_MESSAGE_COUNT,
                TaskOptions::VOTES,
                TaskOptions::COMMENT_WITH_EXTERNAL_MESSAGE_COUNT,
                TaskOptions::QUEUE,
                TaskOptions::UPDATED_AT,
                TaskOptions::STATUS,
                TaskOptions::FAVORITE
            ])
        ;
    }

    private function getFullReference(array $data) : FullReference
    {
        return new FullReference($data['id'], $data['key'], $data['display'], $data['self']);
    }

    private function getEmployee(array $data) : Employee
    {
        return new Employee($data['id'], $data['self'], $data['display']);
    }
}