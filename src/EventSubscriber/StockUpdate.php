<?php

namespace App\EventSubscriber;

use App\Entity\Component;
use App\Entity\Material;
use App\Entity\Purchase;
use Doctrine\ORM\Event\OnFlushEventArgs;
use Doctrine\ORM\UnitOfWork;

class StockUpdate
{
    public function onFlush(OnFlushEventArgs $event): void
    {
        $em = $event->getEntityManager();
        $uow = $em->getUnitOfWork();

        foreach ($uow->getScheduledEntityInsertions() as $entity) {
            $changeSet = $uow->getEntityChangeSet($entity);
            if ($entity instanceof Purchase || $entity instanceof Component) {
                $this->updateStock($entity, $changeSet, ['scheduled' => 'insertions', 'classMetadata' => $em->getClassMetadata(Material::class)], $uow);
            }
        }

        foreach ($uow->getScheduledEntityUpdates() as $entity) {
            $changeSet = $uow->getEntityChangeSet($entity);
            if ($entity instanceof Purchase || $entity instanceof Component) {
                $this->updateStock($entity, $changeSet, ['scheduled' => 'updates', 'classMetadata' => $em->getClassMetadata(Material::class)], $uow);
            }
        }
    }

    private function updateStock($entity, array $changeSet, array $context, UnitOfWork $unitOfWork): void
    {
        switch ($context['scheduled']) {
            case 'insertions':
                [$oldEntity, $material] = $changeSet['material'];
                if ($material instanceof Material) {
                    if ($entity instanceof Purchase) {
                        $material->setUnits($material->getUnits() + $entity->getUnits());
                    }
                    if ($entity instanceof Component) {
                        $material->setUnits($material->getUnits() - $entity->getUnits());
                    }
                    $unitOfWork->recomputeSingleEntityChangeSet($context['classMetadata'], $material);
                }
                break;
            case 'updates':
                [$oldValue, $newValue] = $changeSet['units'];
                if ($entity instanceof Purchase) {
                    $entity->getMaterial()->setUnits($entity->getMaterial()->getUnits() - $oldValue);
                    $entity->getMaterial()->setUnits($entity->getMaterial()->getUnits() + $newValue);
                }
                if ($entity instanceof Component) {
                    $entity->getMaterial()->setUnits($entity->getMaterial()->getUnits() + $oldValue);
                    $entity->getMaterial()->setUnits($entity->getMaterial()->getUnits() - $newValue);
                }
                $unitOfWork->recomputeSingleEntityChangeSet($context['classMetadata'], $entity->getMaterial());
                break;
        }
    }
}
