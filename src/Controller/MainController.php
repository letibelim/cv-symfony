<?php
/**
 * Created by PhpStorm.
 * User: tlegrand
 * Date: 25/07/18
 * Time: 12:53
 */

namespace App\Controller;


use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Routing\Annotation\Route;

class MainController extends Controller
{
    /**
     * @Route("/", name="main")
     */
    public function mainPage()
    {
        return $this->render('main.html.twig');
    }
}