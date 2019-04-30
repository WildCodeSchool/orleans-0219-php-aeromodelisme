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
    public function members()
    {
        $MembersManager = new MembersManager();
        $Members = $MembersManager->selectAll();

        return $this->twig->render('Member/members.html.twig', ['members' => $Members]);
    }
}