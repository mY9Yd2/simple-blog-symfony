<?php

namespace App\Entity\Traits;

use Doctrine\ORM\Mapping\PrePersist;
use Doctrine\ORM\Mapping\PreUpdate;
use Gedmo\Timestampable\Traits\TimestampableEntity as GedmoTimestampableEntity;

trait  TimestampableEntity
{
    use GedmoTimestampableEntity;

    #[PrePersist]
    #[PreUpdate]
    public function updateTimestamps(): void
    {
        $this->setUpdatedAt(new \DateTime());
        if ($this->getCreatedAt() === null) {
            $this->setCreatedAt(new \DateTime());
        }
    }
}
