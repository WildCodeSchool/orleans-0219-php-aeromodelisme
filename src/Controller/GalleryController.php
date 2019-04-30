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
}
