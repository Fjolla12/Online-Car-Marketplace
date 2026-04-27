<?php
$brands = ['BMW', 'Mercedes', 'Audi', 'Toyota', 'Ford', 'Volkswagen', 'Porsche', 'Lamborghini'];

$fuelTypes = [
    'petrol'   => 'Benzinë',
    'diesel'   => 'Naftë',
    'electric' => 'Elektrik',
    'hybrid'   => 'Hibrid',
];

$sellers = [
    ['id' => 1, 'name' => 'Auto Prishtina',  'city' => 'Prishtinë', 'rating' => 4.8],
    ['id' => 2, 'name' => 'Prizren Motors',  'city' => 'Prizren',   'rating' => 4.5],
    ['id' => 3, 'name' => 'Gjakova Auto',    'city' => 'Gjakovë',   'rating' => 4.7],
    ['id' => 4, 'name' => 'Peja Car Center', 'city' => 'Pejë',      'rating' => 4.3],
];

$cars = [
    new Car(1, 'BMW',        '320d',    2019, 18500, 85000,  'Naftë',   'used', 'Auto Prishtina', 'images/corolla.jpg'),
    new Car(2, 'Toyota',     'Corolla', 2021, 21000, 30000,  'Benzinë', 'used', 'Prizren Motors', 'images/corolla.jpg'),
    new Car(3, 'Volkswagen', 'Golf 7',  2018, 14500, 120000, 'Naftë',   'used', 'Gjakova Auto',   'images/corolla.jpg'),
    new Car(4, 'Ford',       'Focus',   2020, 16000, 60000,  'Benzinë', 'used', 'Peja Car Center','images/corolla.jpg'),
    new Car(5, 'Audi',       'A4',      2022, 35000, 15000,  'Naftë',   'used', 'Auto Prishtina', 'images/corolla.jpg'),
    new Car(6, 'Toyota',     'RAV4',    2023, 42000, 5000,   'Hibrid',  'new',  'Prizren Motors', 'images/corolla.jpg'),
    new Car(7, 'Volkswagen', 'Passat',  2017, 12000, 150000, 'Naftë',   'used', 'Gjakova Auto',   'images/corolla.jpg'),
    new Car(8, 'Ford',       'Mustang', 2020, 48000, 20000,  'Benzinë', 'used', 'Auto Prishtina', 'images/corolla.jpg'),

    new LuxuryCar(9,  'Mercedes',   'S-Class',   2022, 95000,  8000,  'Hibrid',  'used', 'Auto Prishtina',
        'Panoramic roof, Massage seats, Burmester Sound', true, 'images/s-class.jpg'),

    new LuxuryCar(10, 'BMW',        'M5',        2021, 88000,  12000, 'Benzinë', 'used', 'Prizren Motors',
        'Carbon fiber trim, Harman Kardon, Head-up display', false, 'images/m5.jpg'),

    new LuxuryCar(11, 'Porsche',    'Cayenne',   2023, 115000, 3000,  'Hibrid',  'new',  'Auto Prishtina',
        'Sport Chrono, PASM, Bose Surround', true, 'images/cayenne.jpg'),

    new LuxuryCar(12, 'Lamborghini','Huracán',   2020, 220000, 5000,  'Benzinë', 'used', 'Gjakova Auto',
        'Full carbon interior, Lifting system, Sensonum Audio', false, 'images/huracan.jpg'),
];
