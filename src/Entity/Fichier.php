<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

class Fichier
{
    /**
     * @ORM\Column(type="string")
     */
    private $Filename;

    public function getFileName()
    {
        return $this->Filename;
    }

    public function setFilename($Filename)
    {
        $this->Filename = $Filename;

        return $this;
    }
}