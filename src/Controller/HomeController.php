<?php
/**
 * Created by PhpStorm.
 * User: aurelwcs
 * Date: 08/04/19
 * Time: 18:40
 */

namespace App\Controller;

use App\Model\PartnerManager;
use App\Model\EventManager;

class HomeController extends AbstractController
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
        $eventManager = new EventManager();
        $events = $eventManager->selectEvents();
      
        return $this->twig->render('Home/index.html.twig', ['events' => $events, 'partners' => $partners]);
    }
}
