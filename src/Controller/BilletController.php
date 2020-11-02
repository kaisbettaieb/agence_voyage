<?php

namespace App\Controller;

use App\Entity\BilletAvion;
use App\Entity\Client;
use App\Entity\Offre;
use App\Entity\Reservation;
use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Serializer\Encoder\JsonEncoder;
use Symfony\Component\Serializer\Normalizer\ObjectNormalizer;
use Symfony\Component\Serializer\Serializer;

class BilletController extends AbstractController
{
    /**
     * @Route("/billets", name="search_billets")
     */
    public function index(Request $request): Response
    {

        $em = $this->getDoctrine()->getManager();
        $offres = $em->getRepository(Offre::class)->findAll();

        $start = $request->request->get("start");
        $destination = $request->request->get("destination");
        $adult = $request->request->get("adult");
        $children = $request->request->get("children");
        $check_in = $request->request->get("check-in");
        $checkout = $request->request->get("check-out");
        $results = new ArrayCollection();
        foreach ($offres as $offre) {
            if ($offre->getDepart() == $start || $offre->getArrivee() == $destination) {
                // $offre->getSiegesDisponible() > $adult + $children; $offre->getDateDepart() =< $check_in
                // || $offre->getDateArrivee() >= $checkout
                $results->add($offre);
            }
        }
        return $this->render('billet/offres.html.twig', [
            "offres" => $results
        ]);
    }

    /**
     * @Route("/reserver", name="reserver_offre", methods={"POST"})
     */
    public function reserverOffre(Request $request): Response
    {
        $em = $this->getDoctrine()->getManager();
        $client = $this->get('security.token_storage')->getToken()->getUser();

        $offre_id = $request->request->get("offre_id");
        $offre = $em->getRepository(Offre::class)->find((int)$offre_id);

        $children = $request->request->get("children");
        $adults = $request->request->get("adults");
        $prixBillet = $offre->getPrix();

        $billet = new BilletAvion();
        $billet->setCompagnieAvion($offre->getCompagnieAvion());
        $billet->setPrixHorsTaxes(($children+$adults) * $prixBillet);
        $billet->setNumSiege($children + $adults);
        $billet->setAeroportArrive($offre->getArrivee());
        $billet->setAeroportDepart($offre->getDepart());
        $billet->setDateDepart($offre->getDateDepart());
        $billet->setHeureDepart($offre->getHeureDepart());
        $billet->setDateArrivee($offre->getDateArrivee());
        $billet->setHeureArrive($offre->getHeureArrivee());

        $reservation = new Reservation();
        $reservation->setClient($client);
        $reservation->setDateReservation(new \DateTime);
        $reservation->setNbrAdultes($adults);
        $reservation->setNbrBebes($children);
        $reservation->addBilletAvion($billet);
        $billet->setReservation($reservation);
        $em->persist($reservation);
        $em->persist($billet);
        $em->flush();
        return new Response($offre_id);
    }

    /**
     * @Route("/api/billets/{id}", name="details_billet", methods={"GET"})
     */
    public function apiDetailsOffre($id): Response
    {
        $em = $this->getDoctrine()->getManager();
        $id = (int) $id;
        $offre =  $em->getRepository(Offre::class)->find($id);

        //$serializedEntity = $this->container->get('serializer')->serialize($offre, 'json');
        $res = ["depart" => $offre->getDepart(),
            "arrivee" => $offre->getArrivee(),
            "prix" => $offre->GetPrix(),
            "date_depart" => $offre->getDateDepart(),
            "heure_depart" => $offre->getHeureDepart(),
            "date_arrivee" => $offre->getDateArrivee(),
            "heure_arrivee" => $offre->getHeureArrivee(),
            "sieges" => $offre->getSiegesDisponible(),
            "compagnie" => $offre->getCompagnieAvion()->getNom()];
        return new JsonResponse($res, 200, array('Content-Type' => 'application/json'));
    }
}
