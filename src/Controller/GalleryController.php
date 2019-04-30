<?php
/**
 * Created by PhpStorm.
 * User: aurelwcs
 * Date: 08/04/19
 * Time: 18:40
 */

namespace App\Controller;

use App\Model\GalleryManager;

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
        $galleryManager = new GalleryManager();
        $randomPicture = $galleryManager->randomPicture();
        return $this->twig->render('Gallery/index.html.twig', ['randomPicture' => $randomPicture]);
    }
}
