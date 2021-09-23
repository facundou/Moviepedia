#! usr/bin/env php
<?php

require __DIR__ . '/vendor/autoload.php';

use Peli\Show;
use Symfony\Component\Console\Application;

$application = new Application('Peliculas', '1.0.0');

$application->add(new Show);

$application->run();
?>
"https://www.omdbapi.com/?apikey=58d24874&t=$title&plot=full"