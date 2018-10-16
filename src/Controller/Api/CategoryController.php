<?php
namespace App\Controller\Api;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use FOS\RestBundle\Controller\Annotations as Rest;
use App\Entity\Category;
use Symfony\Component\Serializer\Serializer;
use Symfony\Component\Serializer\Encoder\XmlEncoder;
use Symfony\Component\Serializer\Encoder\JsonEncoder;
use Symfony\Component\Serializer\Normalizer\ObjectNormalizer;

class CategoryController extends StoreController
{
    /**
     * @Route("/api/categories")
     * @Method("GET")
     */
    public function list()
    {
		$categories = $this->getDoctrine()
			->getRepository(Category::class)
			->findAll();
        $encoders = array(new XmlEncoder(), new JsonEncoder());
		$normalizers = array(new ObjectNormalizer());
		$serializer = new Serializer($normalizers, $encoders);
		return new Response($serializer->serialize($categories, 'json'));
    }
	
	/**
     * @Route("/api/category/{id}")
     * @Method("GET")
     */
    public function listOneById($id)
    {		
		$category = $this->getDoctrine()
			->getRepository(Category::class)
			->find($id);

		if (!$category) {
			return new Response("{}");
		}
		
		$category2 = [];
		$category2["name"] = $category->getName();

		return new Response(json_encode($category2));
    }
}