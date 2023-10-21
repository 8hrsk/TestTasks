<?php

class russianPost extends Shipment {
    private $RPServiceData;

    public function getShipmentCost($weight) {
        if ($weight <= 10) {
            return $weight * 100;
        } else {
            return $weight * 1000;
        }
    }

    public function generateWeight() { // просто для разнообразия
        return rand(1, 100);
    }
}