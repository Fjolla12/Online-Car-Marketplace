<?php
require_once __DIR__ . '/Car.php';

class LuxuryCar extends Car {
    private string $features;
    private bool $chauffeurAvailable;

    public function __construct(
        int $id,
        string $brand,
        string $model,
        int $year,
        float $price,
        int $mileage,
        string $fuelType,
        string $condition,
        string $sellerName,
        string $features,
        bool $chauffeurAvailable = false
    ) {
        parent::__construct($id, $brand, $model, $year, $price, $mileage, $fuelType, $condition, $sellerName);
        $this->features           = $features;
        $this->chauffeurAvailable = $chauffeurAvailable;
    }

    public function getFeatures(): string      { return $this->features; }
    public function isChauffeurAvailable(): bool { return $this->chauffeurAvailable; }

    public function isLuxury(): bool { return true; }

    public function getSummary(): string {
        return parent::getSummary() . " [LUXURY]";
    }
}
