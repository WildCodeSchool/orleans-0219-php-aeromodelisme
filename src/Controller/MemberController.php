<?php


namespace App\Controller;

use App\Model\MembersManager;

/**
 * Class ItemController
 *
 */
class MemberController extends AbstractController
{


    /**
     * Display item listing
     *
     * @return string
     * @throws \Twig\Error\LoaderError
     * @throws \Twig\Error\RuntimeError
     * @throws \Twig\Error\SyntaxError
     */
    public function index()
    {
        $MembersManager = new MembersManager();
        $Members = $MembersManager->selectAll();

        return $this->twig->render('Member/index.html.twig', ['members' => $Members]);
    }
}
