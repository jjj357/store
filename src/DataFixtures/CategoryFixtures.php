<?php
namespace App\DataFixtures;

use App\Entity\Product;
use App\Entity\Category;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use \Datetime;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;


class CategoryFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
		$string = file_get_contents(__DIR__ . "../../../electronic-catalog.json");
        $data = json_decode($string, true);
		$categories = [];
		
		foreach($data['products'] as $product) {			
			if(!in_array($product['category'], $categories)) {
				$categories[] = $product['category'];
			}
		}

		foreach($categories as $category) {
			$entity = new Category();
			$entity->setName($category);
			$entity->setCreatedAt(DateTime::createFromFormat('Y-m-d H:i:s', date('Y-m-d H:i:s')));

			$manager->persist($entity);
			$manager->flush();
		}		
    }
}