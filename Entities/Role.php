<?php
// Role.php
namespace Entities;
class Role
{

    public function __construct(
        private ?int   $roleId,
        private string $libelle
    ) {}

    public function getRoleId(): ?int
    {
        return $this->roleId;
    }

    public function getLibelle(): string
    {
        return $this->libelle;
    }

    public function setRoleId(int $id): void
    {
        $this->roleId = $id;
    }
}

?>