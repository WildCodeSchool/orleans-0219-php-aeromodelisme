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
     * Display home page
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

    public function showByYear()
    {
        $partnerManager = new PartnerManager();
        $partners = $partnerManager->selectAll();

        $galleryManager = new GalleryManager();
        $pictures = $galleryManager->selectAll();
        $year=null;

        if ($_SERVER['REQUEST_METHOD'] === 'GET' && !empty($_GET['year'])) {
            $year = $_GET['year'];
            $pictures = $galleryManager->selectByYear($year);
        }

        $years = $galleryManager->selectAllYears();
        return $this->twig->render('Gallery/showByYear.html.twig', ['years'=> $years,
                                                                          'actualYear'=>$year,
                                                                          'pictures'=> $pictures,
                                                                          'partners' => $partners]);
    }
}
