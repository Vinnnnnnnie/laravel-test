<?php

namespace App;

enum Measurement: string
{
    case Gram = 'g';
    case Kilogram = 'kg';
    case Milliliter = 'ml';
    case Liter = 'l';
    case Teaspoon = 'tsp';
    case Tablespoon = 'tbsp';
    case Cup = 'cup';
}
