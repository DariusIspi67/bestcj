<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    $courses = [
        ['name' => 'How to TrAIn Your Grid: The Hidden World of Sustainable Energy', 'city' => 'Zagreb', 'country' => 'Croatia', 'dates' => '4 April - 12 April 2027', 'deadline' => '15 Mar', 'spot' => 'Ban Jelačić Square', 'lat' => 45.81306, 'lng' => 15.97722, 'x' => 20, 'y' => 30, 'apply' => 'https://www.best.eu.org/event/details.jsp?activity=k3bk10u'],
        ['name' => 'Beyond the taste: Fermentation, Innovation and Sustainability ', 'city' => 'Thessaloniki', 'country' => 'Greece', 'dates' => '11 April - 19 April 2027', 'deadline' => '15 Mar', 'spot' => 'White Tower of Thessaloniki', 'lat' => 40.626406, 'lng' => 22.948423, 'x' => 70, 'y' => 25, 'apply' => 'https://www.best.eu.org/event/details.jsp?activity=i4afz1r'],
        ['name' => 'Project Piltover: Engineering Sustainable Smart Cities', 'city' => 'Athens', 'country' => 'Greece', 'dates' => '18 April - 26 April 2027', 'deadline' => '15 Mar', 'spot' => 'Acropolis of Athens', 'lat' => 37.971532, 'lng' => 23.725749, 'x' => 45, 'y' => 55, 'apply' => 'https://www.best.eu.org/event/details.jsp?activity=k3bk10z'],
        ['name' => 'The Physics of Boo! Science has never been this scary', 'city' => 'Valencia', 'country' => 'Spain', 'dates' => '25 April - 2 May 2027', 'deadline' => '15 Mar', 'spot' => 'City of Arts and Sciences', 'lat' => 39.4549, 'lng' => -0.3500, 'x' => 80, 'y' => 68, 'apply' => 'https://www.best.eu.org/event/details.jsp?activity=m2co302'],
        ['name' => 'AI need a hero: Innovating the Future with AI ', 'city' => 'Turin', 'country' => 'Italy', 'dates' => '2 May - 9 May 2027', 'deadline' => '15 Mar', 'spot' => 'Mole Antonelliana', 'lat' => 45.0686, 'lng' => 7.6930, 'x' => 25, 'y' => 72, 'apply' => 'https://www.best.eu.org/event/details.jsp?activity=i4afz1o'],
    ];
    return view('home', compact('courses'));
})->name('home');

Route::middleware(['auth', 'verified'])->group(function () {
    Route::inertia('dashboard', 'Dashboard')->name('dashboard');
});

require __DIR__.'/settings.php';
