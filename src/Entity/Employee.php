<?php

namespace App\Entity;

use App\Repository\EmployeeRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: EmployeeRepository::class)]
class Employee extends User
{
 
    #[ORM\Column(length: 255)]
    private ?string $empNumber = null;

    #[ORM\Column]
    private ?bool $isAdminRole = null;


    public function getEmpNumber(): ?string
    {
        return $this->empNumber;
    }

    public function setEmpNumber(string $empNumber): static
    {
        $this->empNumber = $empNumber;

        return $this;
    }

    public function isIsAdminRole(): ?bool
    {
        return $this->isAdminRole;
    }

    public function setIsAdminRole(bool $isAdminRole): static
    {
        $this->isAdminRole = $isAdminRole;

        return $this;
    }
}
