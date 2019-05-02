<?php
namespace App\Controller;

use App\Model\MemberManager;
use App\Model\PartnerManager;

/**
 * Class MemberController
 *
 */
class MemberController extends AbstractController
{
    /**
     * Display members listing
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

        $MemberManager = new MemberManager();
        $Members = $MemberManager->selectAll();
        return $this->twig->render('Member/index.html.twig', ['members' => $Members, 'partners' => $partners]);
    }
}
