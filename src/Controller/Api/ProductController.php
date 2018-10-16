<?php
namespace App\Controller\Api;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use FOS\RestBundle\Controller\FOSRestController;
use FOS\RestBundle\Controller\Annotations as Rest;
use App\Entity\Product;
use App\Entity\Category;
use Symfony\Component\Serializer\Serializer;
use Symfony\Component\Serializer\Encoder\XmlEncoder;
use Symfony\Component\Serializer\Encoder\JsonEncoder;
use Symfony\Component\Serializer\Normalizer\ObjectNormalizer;
use \Datetime;
use FOS\RestBundle\View\View;

class ProductController extends StoreController  //Controller
{
    /**
     * @Route("/api/products")
     * @Method("GET")
     */
    public function list()
    {
		$products = $this->getDoctrine()
			->getRepository(Product::class)
			->findAll();
        return new Response($products);
    }	
	 
	/**
     * @Route("/api/product/{id}")
     * @Method("GET")
     */
    public function listOneById($id)
    {		
		$product = $this->getDoctrine()
			->getRepository(Product::class)
			->find($id);

		if (!$product) {
			return new Response("{}");
		}		
					
		$category = $this->getDoctrine()
			->getRepository(Category::class)
			->find($product->getCategory());
		
		$product2 = [];
		$product2["name"] = $product->getName();
		$product2["category"] = $category->getName();
		$product2["SKU"] = $product->getSKU();
		$product2["price"] = $product->getPrice();
		$product2["quantity"] = $product->getQuantity();

		$encoders = array(new XmlEncoder(), new JsonEncoder());
		$normalizers = array(new ObjectNormalizer());
		$serializer = new Serializer($normalizers, $encoders);
		return new Response(json_encode($product2));
    }
	
	/**
     * @Route("/api/products")
     * @Method("POST")
     */
    public function add(Request $request)
    {
		if(parent::auth($request)) {
			$product = new Product();
			$product->setName($request->get('name'));
			
			$categoryName = $request->get('category');
			$category = $this->getDoctrine()
				->getRepository(Category::class)
				->findOneBy(['name'=>$categoryName]);
			if(!$category) {//create a category
				$newId = $this->getDoctrine()
					->getRepository(Category::class)
					->addOne($categoryName);
				if(!$newId) {
					return new Response("Error adding a new category");
				}						
				$product->setCategory($newId);
			} else {
				$product->setCategory($category->getId());
			}
				
			$product->setSKU($request->get('sku'));
			$product->setPrice($request->get('price'));
			$product->setQuantity($request->get('quantity'));
			$product->setCreatedAt(DateTime::createFromFormat('Y-m-d H:i:s', date('Y-m-d H:i:s')));
			
			if(!$this->getDoctrine()->getRepository(Product::class)->addOne($product)) {
				return new Response("Error adding a new product");
			}
			$encoders = array(new XmlEncoder(), new JsonEncoder());
			$normalizers = array(new ObjectNormalizer());
			$serializer = new Serializer($normalizers, $encoders);
			return new Response($serializer->serialize($product, 'json'));
		} else {
			return new Response("not authenticated");
		}
	}
	
	/**
     * @Route("/api/product/{id}")
     * @Method("PUT")
     */
    public function update(int $id, Request $request)
    {		
		if(parent::auth($request)) {
			$product = $this->getDoctrine()
				->getRepository(Product::class)
				->findOneBy(['id'=>intval($id)]);
				
			if($product) {
				if(!empty($request->get('name'))) {
					$product->setName($request->get('name'));
				}
				
				$categoryName = $request->get('category');
				if(!empty($categoryName)) {
					$category = $this->getDoctrine()
						->getRepository(Category::class)
						->findOneBy(['name'=>$categoryName]);
					if(!$category) {//create a category
						$newId = $this->getDoctrine()
							->getRepository(Category::class)
							->addOne($categoryName);
						if(!$newId) {
							return new Response("Error adding a new category");
						}						
						$product->setCategory($newId);
					} else {
						$product->setCategory($category->getId());
					}				
				}
				if(!empty($request->get('sku'))) {
					$product->setSKU($request->get('sku'));
				}
				if(!empty($request->get('price'))) {
					$product->setPrice($request->get('price'));
				}
				if(!empty($request->get('quantity'))) {
					$product->setQuantity($request->get('quantity'));
				}
				$product->setModifiedAt(DateTime::createFromFormat('Y-m-d H:i:s', date('Y-m-d H:i:s')));
				$this->getDoctrine()->getRepository(Product::class)->updateOne($product);
				$encoders = array(new XmlEncoder(), new JsonEncoder());
				$normalizers = array(new ObjectNormalizer());
				$serializer = new Serializer($normalizers, $encoders);
				return new Response($serializer->serialize($product, 'json'));
			} else {
				return new Response("{}");
			}
		} else {
			return new Response("not authenticated");
		}
	}
	
	/**
     * @Route("/api/product/{id}")
     * @Method("DELETE")
     */
    public function delete(int $id)
    {		
		if(parent::auth($request)) {
			$product = $this->getDoctrine()
				->getRepository(Product::class)
				->findOneBy(['id'=>intval($id)]);
				
			if($product) {
				$this->getDoctrine()->getRepository(Product::class)->deleteOne($product);
				$encoders = array(new XmlEncoder(), new JsonEncoder());
				$normalizers = array(new ObjectNormalizer());
				$serializer = new Serializer($normalizers, $encoders);
				return new Response($serializer->serialize($product, 'json'));
			} else {
				return new Response("{}");
			}
		} else {
			return new Response("not authenticated");
		}
	}
}