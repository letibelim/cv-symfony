<?php
/**
 * Created by PhpStorm.
 * User: tlegrand
 * Date: 25/07/18
 * Time: 12:53
 */

namespace App\Controller;


use App\Form\ContactType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Routing\Annotation\Route;

class MainController extends Controller
{
    /**
     * @Route("/", name="main")
     */
    public function mainPage()
    {

        $form = $this->createForm(ContactType::class);
        $form->add('submit', SubmitType::class, ['label' => 'Envoyez !']);
        return $this->render('main.html.twig', ['form' => $form->createView()]);
    }
}