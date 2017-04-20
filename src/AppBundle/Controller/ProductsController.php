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



class ProductsController extends Controller{

  /**
   *
   * @Route("/products"),
   * @Method("GET")
   *
   */
  public function indexAction(){
    return new Response("afficher la liste des produits");
  }


  /**
   *
   * @Route("/products/{id}"),
   * @Method("GET")
   *
   */
  public function showAction($id){
    return new Response("afficher le produit numéro : ".$id);
  }

  /**
   *
   * @Route("/products/{id}"),
   * @Method({"PUT", "PATCH"})
   *
   */
  public function editAction($id){
    return new Response("editer le produit numéro : ".$id);
  }

  /**
   *
   * @Route("/products"),
   * @Method("POST")
   *
   */
  public function createAction(){
    return new Response("créer un nouveau produit");
  }

  /**
   *
   * @Route("/products/{id}"),
   * @Method("DELETE")
   *
   */
  public function deleteAction($id){
    return new Response("supprimer le produit numéro : ".$id);
  }

}


 ?>
