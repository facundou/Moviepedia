<?php

namespace Peli;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;
use GuzzleHttp\Client;
use Symfony\Component\Console\Helper\Table;


class Show extends Command
{
    public function configure()
    {
        $this->setName('Show')
            ->setDescription('Con este comando podes ver informacion de una pelicula')
            ->addArgument('pelicula', InputArgument::REQUIRED, 'Nombre de la pelicula')
            ->addOption('fullplot', null, InputOption::VALUE_REQUIRED, 'Plot full');
    }
    public function execute(InputInterface $input, OutputInterface $output)
    {
        $title = $input->getArgument('pelicula');
        $fullplot = $input->getOption('fullplot');

        //Definicion del cliente
        $client = new Client([
            'base_uri' => 'http://www.omdbapi.com/',
            'timeout'  => 2.0,
        ]);

        //GET de la pelicula
        $response = $client->request('GET', "?apikey=58d24874&t=$title");
        $json_string = $response->getBody()->getContents();
        $json = json_decode($json_string);
        $jsonarray = (array)$json;
        $table = new Table($output);
        $table->setRows([
            ['Title', $jsonarray['Title']],
            ['Year', $jsonarray['Year']],
            ['Rated', $jsonarray['Rated']],
            ['Released', $jsonarray['Released']],
            ['Runtime', $jsonarray['Runtime']],
            ['Genre', $jsonarray['Genre']],
            ['Director', $jsonarray['Director']],
            ['Writer', $jsonarray['Writer']],
            ['Actors', $jsonarray['Actors']],
            ['Plot', $jsonarray['Plot']],
            ['Language', $jsonarray['Language']],
            ['Country', $jsonarray['Country']],
            ['Awards', $jsonarray['Awards']],
            ['Poster', $jsonarray['Poster']],
            ['Metascore', $jsonarray['Metascore']],
            ['imdbRating', $jsonarray['imdbRating']],
            ['imdbVotes', $jsonarray['imdbVotes']],
            ['imdbID', $jsonarray['imdbID']],
            ['Type', $jsonarray['Type']],
            ['DVD', $jsonarray['DVD']],
            ['BoxOffice', $jsonarray['BoxOffice']],
            ['Production', $jsonarray['Production']],
            ['Website', $jsonarray['Website']],
            ['Response', $jsonarray['Response']],
        ]);
        $table->render();
        return 0;
    }
}
