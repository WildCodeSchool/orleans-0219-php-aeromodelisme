<?php

namespace App\Controller;

use App\Model\PartnerManager;

class ActivitiesController extends AbstractController
{
    /**
     * @return string
     * @throws \Twig\Error\LoaderError
     * @throws \Twig\Error\RuntimeError
     * @throws \Twig\Error\SyntaxError
     */
    public function index()
    {
        $partnerManager = new PartnerManager();
        $partners = $partnerManager->selectAll();

        return $this->twig->render('Activities/index.html.twig', ['partners' => $partners]);
    }
}
