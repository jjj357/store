<?php
namespace App\DataFixtures;

use App\Entity\Product;
use App\Entity\Category;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use \Datetime;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;


class ProductFixtures extends Fixture implements DependentFixtureInterface
{
    public function load(ObjectManager $manager)
    {
		$string = file_get_contents(__DIR__ . "../../../electronic-catalog.json");
        $data = json_decode($string, true);
		
		foreach($data['products'] as $product) {
			$entity = new Product();
			$entity->setName($product['name']);
			
			$repository = $manager->getRepository(Category::class);
			$category = $repository->findOneBy(['name' => $product['category']]);
			$entity->setCategory($category->getId());
			
			$entity->setSKU($product['sku']);
			$entity->setPrice(number_format(floatval($product['price']), 2,'.',''));
			$entity->setQuantity(intval($product['quantity']));
			$entity->setCreatedAt(DateTime::createFromFormat('Y-m-d H:i:s', date('Y-m-d H:i:s')));
			$manager->persist($entity);
			$manager->flush();
		}		
    }
	
	public function getDependencies()
    {
        return array(
            CategoryFixtures::class,
        );
    }
}