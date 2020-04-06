<?php

namespace App\Console\Commands;

use App\Property;
use Illuminate\Console\Command;
use Goutte\Client;
use DOMElement;
use Symfony\Component\DomCrawler\Crawler;

class HabitatSollerChecker extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'habitat-soller { checktype : new or all. By default only the new ones}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Check for new properties on Habitat Soller';

	/**
	 * @var string The url to check for new properties
	 */
	protected $baseUrl = 'http://www.habitatsoller.es';

	/** @var Client */
	protected $httpClient;

	/** @var boolean */
	protected $checkAll;

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
    	$this->setUp();

    	if ($this->checkAll) {
    		$this->checkAllProperties();
	    } else {
    		$this->checkOnlyNewProperties();
	    }


    }

    protected function checkAllProperties()
    {
    	// Search all properties:
    	$searchParams = [
			'estat' => 0,
		    'tipo' => 0,
		    'zona' => 0,
		    'precio_min' => 0,
		    'precio_max' => 0,
		    'nhabitaciones' => 0,
		    'ckbPiscina' => 0,
		    'ckbJardin' => 0,
		    'ordenar' => 0
 	    ];
    	$propertyListPage = $this->httpClient->request(
    		'POST', $this->baseUrl . '/Galeria.php', $searchParams
	    );

    	//For each property, find its link:
	    $propertyLinks = $propertyListPage->filter('table.Lletres_blaves15 > a');
	    foreach ($propertyListPage as $link) {
	    	//TODO: Treure el link!!
	    }
    }

    protected function checkOnlyNewProperties()
    {
	    $homePage = $this->httpClient->request('GET', $this->baseUrl);
	    $this->findNewProperties($homePage);
    }

    protected function findNewProperties(Crawler $homePage)
    {
	    $homeProperties = $homePage->filter('.resultats');
	    foreach ($homeProperties as $property) {
	    	if ($this->isANewProperty($property)) {
			    $this->addToDatabase($property);
		    }
	    }
    }

    protected function setUp()
    {
	    $this->httpClient = new Client();

	    $this->checkAll = $this->argument('checktype') === 'all' ? true : false;
    }


	protected function isANewProperty(DOMElement $property)
	{
		return $property->firstChild->nodeValue === 'Novedad';
	}

	protected function propertyLink(DOMElement $property)
	{
		$propertyLink = '';
		$links = $property->getElementsByTagName('a');
		if ($links->length > 0) {
			$propertyLink = $links->item(0)->getAttribute('href');
		}

		return $propertyLink;
	}

	protected function collectPropertyInfo(Crawler $propertyPage)
	{
		$propertyDesc = $propertyPage->filter('.ficha_esq');
		$propertyValues = $propertyPage->filter('.ficha_dreta');

		$keys = [];
		$values = [];
		foreach ($propertyDesc as $description) {
			$keys[] = $description->nodeValue;
		}

		foreach ($propertyValues as $value) {
			$values[] = $value->nodeValue;
		}

		return array_combine($keys, $values);
	}

	protected function addToDatabase(DOMElement $htmlProperty)
	{
		$link = $this->propertyLink($htmlProperty);
		if ($link !== '') {
			$propertyPage = $this->httpClient->request('GET', $link);
			$propertyInfo = $this->collectPropertyInfo($propertyPage);
			Property::firstOrCreate(
				[
					'type' => Property::resolveType($propertyInfo["Tipo"]),
					'status' => Property::resolveStatus($propertyInfo['Estado']),
					'rooms' => $propertyInfo['Habitaciones'],
					'bathrooms' => $propertyInfo['Nº Baños'],
					'location' => $propertyInfo['Zona'],
					'has_swimming_pool' => Property::resolveBoolean($propertyInfo['Piscina']),
					'has_garden' => Property::resolveBoolean($propertyInfo['Jardín']),
					'has_terrace' => Property::resolveBoolean($propertyInfo['Terraza']),
					'has_parking' => Property::resolveBoolean($propertyInfo['Aparcamiento']),
					'constructed_square_meters' => Property::resolveSquareMeters($propertyInfo['Superfície']),
					'plot_square_meters' => Property::resolveSquareMeters($propertyInfo['Terreno']),
					'price' => Property::resolvePrice($propertyInfo['Precio']),
				],
				[
					'link' => $propertyPage->getUri()
				]
			);
		}
	}
}
