<?php
namespace App\DataFixtures;

use App\Entity\Product;
use App\Entity\Category;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use \Datetime;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;


class UserFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
		$string = file_get_contents(__DIR__ . "../../../electronic-catalog.json");
        $data = json_decode($string, true);
		
		foreach($data['users'] as $user) {
			$entity = new User();
			$entity->setName($user['name']);
			
			$repository = $manager->getRepository(User::class);

			$entity->setEmail($user['email']);
			$entity->setPrice(number_format(floatval($user['price']), 2));
			$entity->setQuantity(intval($user['quantity']));
			$entity->setCreatedAt(DateTime::createFromFormat('Y-m-d H:i:s', date('Y-m-d H:i:s')));
			$manager->persist($entity);
			$manager->flush();
		}			
		

    }
}