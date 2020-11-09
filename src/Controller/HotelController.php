<?php

namespace App\Controller;

use App\Entity\Chambre;
use App\Entity\Hotel;
use App\Entity\LocationChambre;
use App\Entity\Reservation;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class HotelController extends AbstractController
{
    /**
     * @Route("/hotels/offres", name="hotels_search")
     */
    public function index(Request $request): Response
    {
        $ville = $request->request->get("ville");
        $nom_hotel = $request->request->get("hotel");
        $check_in = $request->request->get("check-in");
        $check_out = $request->request->get("check-out");
        $em = $this->getDoctrine()->getManager();
        /*$hotels = $em->getRepository(Hotel::class)->findBy(
            array("ville" => $ville)
        );*/

        /*$hotels = $em->getRepository(Hotel::class)->findBy(
            array(
                '$or' => array(
                    array('ville' => $ville),
                    array('nom' => $nom_hotel),
                ),
            ));*/
        $qb =  $em->getRepository(Hotel::class)->createQueryBuilder('cm');
        $qb->select('cm')
            ->where($qb->expr()->orX(
                $qb->expr()->eq('cm.ville', ':ville'),
                $qb->expr()->eq('cm.nom', ':nom')
            ))
            ->setParameter('ville', $ville)
            ->setParameter('nom', $nom_hotel);
        $hotels = $qb->getQuery()->getResult();//or more
        return $this->render('hotel/hotels.html.twig', [
            'hotels' => $hotels,
        ]);
    }

    /**
     * @Route("/hotels/{id}", name="hotel_details")
     */
    public function hotelDetails($id): Response
    {
        $em = $this->getDoctrine()->getManager();
        $id = (int)$id;
        $hotel = $em->getRepository(Hotel::class)->find($id);
        $chambres = [];
        foreach ($hotel->getChambres() as $chambre) {
            $chambres[] = ["id" => $chambre->getId(),
                "prix" => $chambre->getPrix(),
                "type" => $chambre->getType()];
        }
        $data = ["nom" => $hotel->getNom(),
            "adresse" => $hotel->getAdresse(),
            "ville" => $hotel->getVille(),
            "chambres" => $chambres];

        return new JsonResponse($data, 200, array('Content-Type' => 'application/json'));
    }

    /**
     * @Route("/reserver/hotel", name="reserver_hotel", methods={"POST"})
     */
    public function reserverHotel(Request $request): Response
    {
        $client = $this->get('security.token_storage')->getToken()->getUser();
        $em = $this->getDoctrine()->getManager();
        $hotel = $em->getRepository(Hotel::class)->find((int)$request->request->get("hotel_id"));
        $chambre = $em->getRepository(Chambre::class)->findOneBy(
           array("type" => $request->request->get("chambre"),
                "hotel" => $hotel)
       );

        $date_reservation = new \DateTime($request->request->get("date_reservation"));
        $date_sorite = new \DateTime($request->request->get("date_sortie"));
        $adultes = $request->request->get("adultes");
        $enfants = $request->request->get("enfants");
        $nuits = $date_sorite->diff($date_reservation)->d;

        $location_chambre = new LocationChambre();
        $location_chambre->setNbrNuits($nuits);
        $location_chambre->setChambre($chambre);
        $location_chambre->setDateEntree($date_reservation);
        $location_chambre->setDateSortie($date_sorite);

        $reservation = new Reservation();
        $reservation->setClient($client);
        $reservation->setDateReservation($date_reservation);
        $reservation->setNbrBebes($enfants);
        $reservation->setNbrAdultes($adultes);
        $reservation->setNbrNuits($nuits);
        $reservation->addLocationChambre($location_chambre);

        $location_chambre->setReservation($reservation);
        $em->persist($location_chambre);
        $em->persist($reservation);

        $em->flush();

        return new Response("done");
    }
}
