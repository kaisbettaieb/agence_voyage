<?php

namespace App\Controller;

use App\Entity\Client;
use App\Entity\Location;
use App\Entity\Reservation;
use App\Entity\Vehicule;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class VoitureController extends AbstractController
{
    /**
     * @Route("/voitures/search", name="voitures_search")
     */
    public function index(Request $request): Response
    {
        $type_voiture = $request->request->get("inputType");
        $arrivee = $request->request->get("inputArrivee");
        $depart = $request->request->get("inputDepart");
        $checkin = $request->request->get("prise_en_charge");
        $checkout = $request->request->get("restitution");
        $em = $this->getDoctrine()->getManager();
        $vehicules = $em->getRepository(Vehicule::class)->findBy(
            array("type_vehicule" => $type_voiture)
            );
        return $this->render('voiture/offres.html.twig', [
            'voitures' => $vehicules,
        ]);
    }
    /**
     * @Route("/api/voitures/{id}", name="details_voiture", methods={"GET"})
     */
    public function apiDetailsVoiture($id): Response
    {
        $em = $this->getDoctrine()->getManager();
        $id = (int) $id;
        $voiture =  $em->getRepository(Vehicule::class)->find($id);

        $res = ["immatricule" => $voiture->getNumeroImmatriculation(),
            "type_vehicule" => $voiture->getTypeVehicule(),
            "marque" => $voiture->getMarque(),
            "prix_jours" => $voiture->getPrixHorsTaxesJours(),
            "km_inclus" => $voiture->getKmInclus(),
            "model" => $voiture->getModel(),
            "agence" => $voiture->getAgence()->getNom()];
        return new JsonResponse($res, 200, array('Content-Type' => 'application/json'));
    }

    /**
     * @Route("/api/voitures/reserver", name="reserver_voiture", methods={"POST"})
     */
    public function reserverVoiture(Request $request): Response
    {
        $em = $this->getDoctrine()->getManager();
        $client = $this->get('security.token_storage')->getToken()->getUser();

        $voiture_id = $request->request->get("voiture_id");
        $voiture = $em->getRepository(Vehicule::class)->find((int)$voiture_id);

        $date_prise = $request->request->get("date_prise");
        $date_restitution = $request->request->get("date_restitution");

        $location = new Location();
        $location->setVoiture($voiture);
        $location->setDatePriseCharge(new \DateTime($date_prise));
        $location->setDateRestitution(new \DateTime($date_restitution));
        $location->setAgence($voiture->getAgence());

        $reservation = new Reservation();
        $reservation->setClient($client);
        $reservation->setDateReservation(new \DateTime);
        $reservation->addLocation($location);
        $location->setReservation($reservation);
        $em->persist($reservation);
        $em->persist($location);
        $em->flush();
        return new Response($voiture_id);
    }
}
