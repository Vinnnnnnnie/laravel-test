<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/bikes', function () {
    $bikes =
        [
            [
                'id' => 1,
                'make' => 'Kawasaki',
                'model' => 'ER-5 C3',
                'year' => '2003'
            ],
            [
                'id' => 2,
                'make' => 'BMW',
                'model' => 'K1100',
                'year' => '1994'
            ]
        ];
    return view('bikes.index', ['bikes' => $bikes]);
});

Route::get('/bikes/{id}', function ($id) {
    return view('bikes.show', ['id' => $id]);
});
