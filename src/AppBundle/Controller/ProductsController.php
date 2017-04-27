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

class ProductsController extends Controller
{
    const PRODUCTS_TEST = [
    ['id' => 1, 'reference' => 'AFR-1'],
    ['id' => 2, 'reference' => 'AFR-2'],
    ['id' => 3, 'reference' => 'AFR-3'],
    ['id' => 4, 'reference' => 'AFR-4']
  ];


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
      switch ($request->getRequestFormat()) {
      case "json":
        return $this->json(self::PRODUCTS_TEST);
      case "html":
        return $this->render("products/index.html.twig", [
          'products' => self::PRODUCTS_TEST,
        ]);
    }
  }


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
      foreach (self::PRODUCTS_TEST as $product) {
          if ($product['id'] === $id) {
              switch ($request->getRequestFormat()) {
          case "json":
            return $this->json($product);
          case "html":
            return $this->render("products/show.html.twig", [
              'product' => $product,
              //compact('product') equivaut à ['product' => $product]
            ]);
        }
          }
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
      if ($request->getMethod() === 'GET') {
          foreach (self::PRODUCTS_TEST as $product) {
              if ($product['id'] === $id) {
                  return $this->render("products/edit.html.twig", [
            'product' => $product
          ]);
              }
          }
      } elseif ($request->getMethod() === 'PATCH') {
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
   * @Route("/products/create"
   * )
   * @Method({"GET", "POST"})
   *
   */
  public function createAction(Request $request)
  {
      if ($request->getMethod() === 'GET') {
          return $this->render("products/create.html.twig");
      } else {
        $this->addFlash(
         'message',
         'Product create !'
        );
        return $this->redirectToRoute('app_products_index');
          // return new Response("nouveau produit créé dans la base de données");
      }
  }

  /**
   *
   * @Route("/products/{id}/delete"
   * )
   * @Method({"DELETE", "GET"})
   *
   */
  public function deleteAction(Request $request, int $id)
  {
      if ($request->getMethod() === 'GET') {
          foreach (self::PRODUCTS_TEST as $product) {
              if ($product['id'] === $id) {
                  return $this->render("products/delete.html.twig", [
          'product' => $product
        ]);
              }
          }
      } elseif ($request->getMethod() === 'DELETE') {
        $this->addFlash(
         'message',
         'Product delete !'
        );
        return $this->redirectToRoute('app_products_index');
      }
  }
}
