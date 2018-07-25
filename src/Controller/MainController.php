<?php
/**
 * Created by PhpStorm.
 * User: tlegrand
 * Date: 25/07/18
 * Time: 12:53
 */

namespace App\Controller;


use App\Entity\Contact;
use App\Form\ContactType;
use Doctrine\ORM\EntityManagerInterface;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class MainController extends Controller
{
    /**
     * @Route("/", name="main")
     * @Method("GET")
     */
    public function mainPage()
    {
        $contact = new Contact();
        $form = $this->createForm(ContactType::class, $contact, [
            'action' => $this->generateUrl('contact.creation'),
            'attr' => ['id' => 'contact-form'],
        ]);

        return $this->render('main.html.twig', ['form' => $form->createView()]);
    }

    /**
     * @param Request $request
     * @Route("/validation", name="contact.creation")
     * @Method("POST")
     */
    public function newContact(Request $request, EntityManagerInterface $em, \Swift_Mailer $mailer)
    {
        $contact = new Contact();

        $form = $this->createForm(ContactType::class, $contact);
        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()){
            $contact = $form->getData();
            $em->persist($contact);
            $em->flush();

            $message = (new \Swift_Message('Contact'))
                ->setFrom($contact->getEmail())
                ->setTo('thibault.legrand@gmail.com')
                ->setBody(
                    'Vous avez reçu un message : ' .
                    $contact->getContent(),
                    'text/html'
                )
            ;

            $mailer->send($message);

            $success = true;

        } else {
            $success = false;

        }

        return new JsonResponse(['success' => $success]) ;

    }
}

