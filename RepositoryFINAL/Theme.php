<?php
// Theme.php
class Theme {
    public function __construct (
        private ?int $themeId,
        private string $libelle
    ) {}

    public function getThemeId(): ?int {
        return $this->themeId;
    }

    public function getLibelle(): string {
        return $this->libelle;
    }

    public function setThemeId(int $themeId): void {
        $this->themeId = $themeId;
    }
}
?>