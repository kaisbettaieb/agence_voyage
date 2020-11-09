<?php

namespace App\Controller;

use App\Entity\Facture;
use App\Entity\Reservation;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class BackEndController extends AbstractController
{
    /**
     * @Route("/profile/reservations", name="profile_reservation")
     */
    public function profileReservation(): Response
    {
        $user = $this->get('security.token_storage')->getToken()->getUser();
        if ($this->isGranted('ROLE_USER') == false) {
            return $this->redirectToRoute("homepage");
        } else {
            $reservations = $this->getDoctrine()->getManager()->getRepository(Reservation::class)->findBy(
                array("client" => $user->getId())
            );
            $reservationChambres = array();
            $reservationAvions = array();
            $reservationLocations = array();
            foreach ($reservations as $reservation) {
                if ($reservation->getLocationChambres())
                    array_push($reservationChambres, $reservation);
                if ($reservation->getBilletAvions())
                    array_push($reservationAvions, $reservation);
                if ($reservation->getLocations())
                    array_push($reservationLocations, $reservation);
            }
            return $this->render("back_end/reservations.html.twig", [
                "reservationChambres" => $reservationChambres,
                "reservationAvions" => $reservationAvions,
                "reservationLocation" => $reservationLocations
            ]);

        }
    }

    /**
     * @Route("/reservations/facture/{type}/{id}", name="reserver_facture")
     */
    public function reservationFacture($type, $id): Response
    {
        $reservation = $this->getDoctrine()->getRepository(Reservation::class)->find($id);
        return $this->render("back_end/facture.html.twig", [
            "reservation" => $reservation,
            "type" => $type
        ]);
    }

    /**
     * @Route("/facture/reserver", name="facture_reserver")
     */
    public function factureReserver(Request $request): Response
    {
        $facture = new Facture();
        $em = $this->getDoctrine()->getManager();
        $reservation = $em->getRepository(Reservation::class)->find($request->request->get("id"));
        $facture->setReservation($reservation);
        $facture->setDateFacture(new \DateTime($request->request->get("date")));
        $facture->setModeReglement($request->request->get("reglement"));
        $reservation->addFacture($facture);
        $em->persist($facture);
        $em->flush();
        return new Response("done");

    }

    /**
     * @Route("/profile/factures", name="profile_factures")
     */

    public function profileFactures(): Response
    {
        $user = $this->get('security.token_storage')->getToken()->getUser();
        $em = $this->getDoctrine()->getManager();
        $reservations = $em->getRepository(Reservation::class)->findBy(
            array("client" => $user->getId())
        );
        $factures = [];
        foreach ($reservations as $reservation) {
            if ($reservation->getFactures()) {
                if ($reservation->getClient()->getId() == $user->getId()) {
                    foreach ($reservation->getFactures() as $facture) {
                        array_push($factures, $facture);
                    }
                }
            }
        }
        return $this->render("back_end/profile_factures.html.twig", [
            "factures" => $factures
        ]);
    }
}
