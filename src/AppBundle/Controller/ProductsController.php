<?php

namespace AppBundle\Controller;

//importer annotation Route
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;

//importer annotation method
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;


// utilisé pour importer les request/response
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

// controller class mère : méthode render()
use Symfony\Bundle\FrameworkBundle\Controller\Controller;


use AppBundle\Entity\Product;

class ProductsController extends Controller
{
    //   const PRODUCTS_TEST = [
  //   ['id' => 1, 'reference' => 'Bonjour'],
  //   ['id' => 2, 'reference' => 'Ca va ?'],
  //   ['id' => 3, 'reference' => 'Hahaha'],
  //   ['id' => 4, 'reference' => 'lol']
  // ];


  /**
   *
   * @Route(
   * "/products.{_format}",
   * defaults={"_format": "html"},
   * requirements={
   *  "_format": "html|json"
   *  }
   *  )
   * @Method("GET")
   *
   */
  public function indexAction(Request $request)
  {
      $products = $this->getDoctrine()
      ->getRepository('AppBundle:Product')
      ->findAll();


      switch ($request->getRequestFormat()) {
      case "json":
        return $this->json($products);
      case "html":
        return $this->render("products/index.html.twig", compact('products'));
    }
  }
 // compact('product') =['product' => $product]

  /**
   *
   * @Route("/products/{id}.{_format}",
   * defaults={"_format": "html"},
   * requirements={
   *  "_format": "html|json",
   *  "id": "\d+"
   * }
   * )
   * @Method("GET")
   *
   */
  public function showAction(int $id, Request $request)
  {
      $product = $this->getDoctrine()
        ->getRepository('AppBundle:Product')
        ->find($id);

      switch ($request->getRequestFormat()) {
          case "json":
            return $this->json($product);
          case "html":
            return $this->render("products/show.html.twig", compact('product')

              //compact('product') equivaut à ['product' => $product]
            );
        }


      return $this->json(['error' => 'Product '.$id." not found"]);
  }

  /**
   *
   * @Route("/products/{id}/edit"
   * )
   *
   * @Method({"GET" ,"PUT", "PATCH"})
   *
   */
  public function editAction(Request $request, int $id)
  {

    $product = $this->getDoctrine()
      ->getRepository('AppBundle:Product')
      ->find($id);

      if ($request->getMethod() === 'GET') {
              if ($product) {
                  return $this->render("products/edit.html.twig", compact('product'));
        }else {
          throw $this->createNotFoundException('product not found');
        }
      } elseif ($request->getMethod() === 'PATCH' || 'PUT') {
        $reference = $request->request->get('reference');
        $price = $request->request->get('price');

        $product->setReference($reference);
        $product->setPrice($price);

        $em = $this->getDoctrine()->getManager();
        $em->flush();

          $this->addFlash(
         'message',
         'Product change !'
        );
          return $this->redirectToRoute('app_products_index');
      }



      return new Response("editer le produit numéro : ".$id." dans la base de données");
  }

  /**
   *
   * @Route("/products/create.{_format}",
   * defaults={"_format": "html"},
   * requirements={
   *  "_format": "html|json"
   *  })
   * @Method({"GET", "POST"})
   *
   */
  public function createAction(Request $request)
  {
      if ($request->getMethod() === 'GET') {
          return $this->render("products/create.html.twig");
      } elseif ($request->getMethod() === 'POST') {
          $reference = $request->request->get('reference');
          $price = $request->request->get('price');

          $product = new Product();
          $product->setReference($reference);
          $product->setPrice($price);

          $em = $this->getDoctrine()->getManager();
          $em->persist($product);
          $em->flush();


          switch ($request->getRequestFormat()) {
          case "json":
            return $this->json(['notice' => 'Votre produit a bien été créé']);
            break;
          case "html":
            $this->addFlash(
              'message',
              'Product create !'
            );
            return $this->redirectToRoute('app_products_index');
            break;
          }
      }
  }

  /**
   *
   *
   * @Route("/products/{id}/delete.{_format}",
   * defaults={"_format": "html"},
   * requirements={
   *  "_format": "html|json"
   *  })
   * @Method({"DELETE", "GET"})
   *
   */
  public function deleteAction(Request $request, int $id)
  {


          $entity = $this->getDoctrine()
          ->getEntityManager();

          $product = $entity->getRepository('AppBundle:Product')
          ->find($id);

          $entity->remove($product);
          $entity->flush();
          switch ($request->getRequestFormat()) {
         case "json":
          if($product){
            return $this->json(['notice' => 'Votre produit a bien été supprimé']);
          }
         case "html":
          if($product){
            $this->addFlash(
              'message',
              'Product delete !'
            );
            return $this->redirectToRoute('app_products_index');
          }
       }

  }
}
