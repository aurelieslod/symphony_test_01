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
   * @route("/test", name="test")
   *
   */
  public function indexAction(Request $request){
    // return new Response();

    return $this->render('test/index.html.twig', [
      'username' => 'Holie'
    ]);

  }
}


 ?>
