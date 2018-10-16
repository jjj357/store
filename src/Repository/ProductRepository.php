<?php

namespace App\Repository;

use App\Entity\Product;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;
use App\Entity\Category;
use Psr\Log\LoggerInterface;
use \Datetime;

/**
 * @method Product|null find($id, $lockMode = null, $lockVersion = null)
 * @method Product|null findOneBy(array $criteria, array $orderBy = null)
 * @method Product[]    findAll()
 * @method Product[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ProductRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, Product::class);
    }

//    /**
//     * @return Product[] Returns an array of Product objects
//     */
    
    public function findAll()
    {
		$conn = $this->getEntityManager()->getConnection();

		$sql = "
			SELECT p.name, c.name as 'category', p.sku, p.price, p.quantity FROM product p
			JOIN category c
			on c.id = p.category
			ORDER BY p.id
			";
		$stmt = $conn->prepare($sql);
		$stmt->execute();

		// returns an array of arrays (i.e. a raw data set)
		return json_encode($stmt->fetchAll());
        
    }
        
    public function findOneById($id)
    {
        $result = $this->createQueryBuilder('p')
        // p.category refers to the "category" property on product
        ->innerJoin('p.category', 'c')
        // selects all the category data to avoid the query
        ->addSelect('c')
        ->andWhere('p.id = :id')
        ->setParameter('id', $productId)
        ->getQuery()
        ->getOneOrNullResult();
        return json_encode($result);
    }
	
	public function addOne($product) {
		try {
			$em = $this->getEntityManager();
			$em->persist($product);
			$em->flush();

			return $product->getId();;

		} catch (Exception $e) {
			return 0;
		}
	}
    
	public function updateOne($product) {
		try {
			$em = $this->getEntityManager();
			$product = $em->merge($product);
			$em->flush();

			return $product->getId();;

		} catch (Exception $e) {
			return 0;
		}
	}
	
	public function deleteOne($product) {
		try {
			$em = $this->getEntityManager();
			$em->remove($product);
			$em->flush();

			return $product->getId();;

		} catch (Exception $e) {
			return 0;
		}
	}
}
