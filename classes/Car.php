<?php

class Car {
    private int $id;
    private string $brand;
    private string $model;
    private int $year;
    private float $price;
    private int $mileage;
    private string $fuelType;
    private string $condition;
    private string $sellerName;

    public function __construct(
        int $id,
        string $brand,
        string $model,
        int $year,
        float $price,
        int $mileage,
        string $fuelType,
        string $condition,
        string $sellerName
    ) {
        $this->id         = $id;
        $this->brand      = $brand;
        $this->model      = $model;
        $this->year       = $year;
        $this->price      = $price;
        $this->mileage    = $mileage;
        $this->fuelType   = $fuelType;
        $this->condition  = $condition;
        $this->sellerName = $sellerName;
    }

    public function getId(): int         { return $this->id; }
    public function getBrand(): string   { return $this->brand; }
    public function getModel(): string   { return $this->model; }
    public function getYear(): int       { return $this->year; }
    public function getPrice(): float    { return $this->price; }
    public function getMileage(): int    { return $this->mileage; }
    public function getFuelType(): string  { return $this->fuelType; }
    public function getCondition(): string { return $this->condition; }
    public function getSellerName(): string { return $this->sellerName; }

    public function setPrice(float $price): void {
        if ($price < 0) throw new InvalidArgumentException("Çmimi nuk mund të jetë negativ.");
        $this->price = $price;
    }

    public function setMileage(int $mileage): void {
        $this->mileage = $mileage;
    }

    public function isLuxury(): bool {
        return false;
    }

    public function getSummary(): string {
        return "{$this->year} {$this->brand} {$this->model} — €" . number_format($this->price);
    }
}
