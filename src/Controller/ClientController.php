<?php

namespace App\Controller;

use App\Entity\Client;
use App\Form\ClientForm;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\Authentication\Token\UsernamePasswordToken;
use Symfony\Component\Security\Http\Event\InteractiveLoginEvent;

class ClientController extends AbstractController
{
    /**
     * @Route("/client", name="client")
     */
    public function index(): Response
    {
        return $this->render('client/index.html.twig', [
            'controller_name' => 'ClientController',
        ]);
    }

    /**
     * @Route("/register", name="ajout_client", methods={"GET", "PUT"})
     * Cette fonction a pour but est d'afficher la page d'ajout d"un client
     */
    public function ajoutClientPage(Request $request): Response
    {
        $client = new Client();
        $form = $this->createForm(ClientForm::class, $client, ['method' => 'PUT']);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            // $form->getData() holds the submitted values
            // but, the original `$task` variable has also been updated
            $client = $form->getData();

            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($client);
            $entityManager->flush();

            return new Response("ajouter success");
        }

        return $this->render('client/ajout_client.html.twig', [
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/ajout_client_id", name="ajout_client_put", methods={"PUT"})
     */
    function ajoutClientPut(Request $request): Response
    {
        $nom = $request->query->get("client_nom");
        $prenom = $request->query->get("client_prenom");
        $telephone = $request->query->get("client_telephone");
        $adresse = $request->query->get("client_adresse");
        $date_naissance = $request->query->get("client_date_naissance");

        return new Response(
            '<html><body>' . $nom . '</body></html>'
        );
    }

    /**
     * @Route("/login", name="login_client", methods={"GET","POST"})
     */
    function loginClient(Request $request): Response
    {
        $email = $request->request->get("email");
        $password = $request->request->get("password");
        $em = $this->getDoctrine()->getManager();
        $user = $em->getRepository(Client::class)->findOneBy(
            array("email" => $email, "password" => md5($password))
        );

        if ($user) {
                $token = new UsernamePasswordToken($user, null, 'main', $user->getRoles());
                $this->get('security.token_storage')->setToken($token);
                $this->get('session')->set('_security_main', serialize($token));
                $event = new InteractiveLoginEvent($request, $token);
                return new JsonResponse(["connected" => true]);

        } else {
            return new JsonResponse(["connected" => false]);
        }

    }

    /**
     * @Route("/logout", name="logout_client")
     */
    function logoutClient(Request $request): Response
    {
        // controller can be blank: it will never be executed!
        throw new \Exception('Don\'t forget to activate logout in security.yaml');
    }
}
