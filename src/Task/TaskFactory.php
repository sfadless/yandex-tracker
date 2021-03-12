<?php

declare(strict_types=1);

namespace Sfadless\YandexTracker\Task;

use DateTime;
use Exception;
use Sfadless\YandexTracker\Reference\FullReference;
use Symfony\Component\OptionsResolver\OptionsResolver;

/**
 * TaskFactory
 *
 * @author Pavel Golikov <pgolikov327@gmail.com>
 */
final class TaskFactory
{
    /**
     * @param array $data
     * @return Task
     * @throws Exception
     */
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
            ->setUpdatedBy($this->getEmployee($data['updatedBy']))
            ->setAssignee($this->getEmployee($data['assignee']))
            ->setFollowers($this->getEmployeesList($data['followers']))
            ->setStatus($this->getFullReference($data['status']))
            ->setResolution($this->getFullReference($data['resolution']))
            ->setSelfUrl($data[TaskOptions::SELF_URL])
            ->setType($this->getFullReference($data[TaskOptions::TYPE]))
            ->setQueue($this->getFullReference($data[TaskOptions::QUEUE]))
            ->setPriority($this->getFullReference($data[TaskOptions::PRIORITY]))
            ->setCreatedAt(new DateTime($data["createdAt"]))
            ->setUpdatedAt(new DateTime($data["updatedAt"]))
        ;

        return $task;
    }

    /**
     * @param OptionsResolver $resolver
     */
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
                TaskOptions::FOLLOWERS,
                TaskOptions::ASSIGNEE,
                TaskOptions::COMMENT_WITHOUT_EXTERNAL_MESSAGE_COUNT,
                TaskOptions::VOTES,
                TaskOptions::COMMENT_WITH_EXTERNAL_MESSAGE_COUNT,
                TaskOptions::QUEUE,
                TaskOptions::UPDATED_AT,
                TaskOptions::STATUS,
                TaskOptions::FAVORITE,
                TaskOptions::SPRINT,
                TaskOptions::BOARDS,
                TaskOptions::PREVIOUS_STATUS,
                TaskOptions::RESOLUTION,
                TaskOptions::RESOLVED_AT,
                TaskOptions::RESOLVED_BY,
            ])
            ->setDefaults([
                TaskOptions::DESCRIPTION => null,
                TaskOptions::FOLLOWERS => [],
                TaskOptions::ASSIGNEE => null,
                TaskOptions::SPRINT => null,
                TaskOptions::PREVIOUS_STATUS => null,
                TaskOptions::RESOLUTION => null,
                TaskOptions::RESOLVED_AT => null,
                TaskOptions::RESOLVED_BY => null,
                TaskOptions::BOARDS => [],
            ]);
        ;
    }

    /**
     * @param array|null $data
     * @return FullReference|null
     */
    private function getFullReference(?array $data) : ?FullReference
    {
        return (is_null($data)) ? null : new FullReference($data['id'], $data['key'], $data['display'], $data['self']);
    }

    /**
     * @param array|null $data
     * @return Employee|null
     */
    private function getEmployee(?array $data) : ?Employee
    {
        return (is_null($data)) ? null : new Employee($data['id'], $data['self'], $data['display']);
    }

    /**
     * @param array $data
     * @return Employee[]
     */
    private function getEmployeesList(array $data) : array
    {
        $result = [];
        foreach ($data as $employee) {
            $result[] =  new Employee($employee['id'], $employee['self'], $employee['display']);
        }

        return $result;
    }
}