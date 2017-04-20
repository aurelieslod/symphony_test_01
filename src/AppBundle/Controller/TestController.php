<?php

namespace AppBundle\Controller;

// utilisé pour importer les annotations
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;


// utilisé pour importer les request/response
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

// controller class mère : méthode render()
use Symfony\Bundle\FrameworkBundle\Controller\Controller;


class TestController extends Controller{

  /**
   *
   * @Route("/test/{username}",
   * name="test",
   * requirements={"username": "\D+"})
   *
   */
  public function indexAction(Request $request, $username = "Holie"){
    // return new Response();

    return $this->render('test/index.html.twig', [
      'username' => $username
    ]);

  }


  /**
   *
   * @Route("/test/{page}",
   * name="test_show",
   * requirements={"page": "\d+"})
   *
   */
  public function showAction($page){
    return new Response("Ma page est ".$page);
  }
}


 ?>
