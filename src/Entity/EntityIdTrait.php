<?php
/**
 * Julien Rajerison <julienrajerison5@gmail.com>.
 **/

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Class EntityIdTrait.
 */
trait EntityIdTrait
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue(strategy="UUID")
     * @ORM\Column(type="guid")
     */
    protected $id;

    /**
     * @return string|null uuid
     */
    public function getId(): ?string
    {
        return $this->id;
    }
}
