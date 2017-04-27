<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table(name="products")
 */

class Product{

  /**
   * @ORM\Column(type="integer")
   * @ORM\Id
   * @ORM\GeneratedValue(strategy="AUTO")
   *
   */
  private $id;

  /**
   *  @ORM\Column(type="string", lenght=100)
   *
   */
  private $reference;

  /**
   *  @ORM\Column(type="decimal", scale=2)
   *
   */
  private $price;
}
