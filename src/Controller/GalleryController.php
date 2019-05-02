<?php
/**
 * Created by PhpStorm.
 * User: aurelwcs
 * Date: 08/04/19
 * Time: 18:40
 */

namespace App\Controller;

use App\Model\GalleryManager;
use App\Model\PartnerManager;

class GalleryController extends AbstractController
{

    /**
     * Display gallery page
     *
     * @return string
     * @throws \Twig\Error\LoaderError
     * @throws \Twig\Error\RuntimeError
     * @throws \Twig\Error\SyntaxError
     */
    public function index()
    {
        $partnerManager = new PartnerManager();
        $partners = $partnerManager->selectAll();

        $galleryManager = new GalleryManager();
        $randomPicture = $galleryManager->randomPicture();
        return $this->twig->render('Gallery/index.html.twig', ['randomPicture' => $randomPicture,
            'partners' => $partners]);
    }

    /**
     * Display gallery by year and event
     *
     * @return string
     * @throws \Twig\Error\LoaderError
     * @throws \Twig\Error\RuntimeError
     * @throws \Twig\Error\SyntaxError
     */
    public function showByYearAndEvent()
    {
        $partnerManager = new PartnerManager();
        $partners = $partnerManager->selectAll();

        $galleryManager = new GalleryManager();
        $pictures = $galleryManager->selectAll();
        $year = null;
        $event = null;

        if ($_SERVER['REQUEST_METHOD'] === 'GET' && !empty($_GET['year']) && !empty($_GET['event'])) {
            $year = $_GET['year'];
            $event = $_GET['event'];
            $pictures = $galleryManager->selectByEventAndYear($year, $event);
        }

        $years = $galleryManager->selectAllYears();
        $events = $galleryManager->selectAllEvents();
        return $this->twig->render('Gallery/showByYearAndEvent.html.twig', ['years' => $years,
            'actualYear' => $year,
            'events' => $events,
            'actualEvent' => $event,
            'pictures' => $pictures,
            'partners' => $partners]);
    }
}
