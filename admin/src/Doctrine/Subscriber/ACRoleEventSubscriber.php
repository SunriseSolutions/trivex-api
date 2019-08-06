<?php

namespace App\Doctrine\Subscriber;

use App\Entity\Organisation\Person\Authorisation\ACRole;
use App\Message\Message;
use Doctrine\Common\EventSubscriber;
use Doctrine\Common\Persistence\Event\LifecycleEventArgs;
use App\Util\AwsSnsUtil;
use Doctrine\ORM\Events;

class ACRoleEventSubscriber implements EventSubscriber {

    private $awsSnsUtil;

    public function __construct(AwsSnsUtil $awsSnsUtil) {
        $this->awsSnsUtil = $awsSnsUtil;
    }

    /**
     * {@inheritdoc}
     */
    public function getSubscribedEvents(){
        return [
            Events::postPersist,
            Events::postUpdate,
            Events::postRemove,
        ];
    }

    public function postPersist(LifecycleEventArgs $args) {
        $object = $args->getObject();
        if (!$object instanceof ACRole) return;
        $object->organisationUuid = $object->getOrganisation()->getUuid();
        return $this->awsSnsUtil->publishMessage($object, Message::OPERATION_POST);
    }

    public function postUpdate(LifecycleEventArgs $args) {
        $object = $args->getObject();
        if (!$object instanceof ACRole) return;
        $object->organisationUuid = $object->getOrganisation()->getUuid();
        return $this->awsSnsUtil->publishMessage($object, Message::OPERATION_PUT);
    }

    public function postRemove(LifecycleEventArgs $args) {
        $object = $args->getObject();
        if (!$object instanceof ACRole) return;
        $object->organisationUuid = $object->getOrganisation()->getUuid();
        return $this->awsSnsUtil->publishMessage($object, Message::OPERATION_DELETE);
    }
}