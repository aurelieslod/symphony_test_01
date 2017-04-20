<?php

namespace AppBundle\Controller;

// utilisé pour importer les annotations
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;


// utilisé pour importer les request/response
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class TestController {

  /**
   *
   * @route("/test", name="test")
   *
   */
  public function indexAction(Request $request){
    return new Response("coucou");
  }
}


 ?>
