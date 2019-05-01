<?php
namespace App\Controller;

use App\Model\MemberManager;

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
        $MemberManager = new MemberManager();
        $Members = $MemberManager->selectAll();
        return $this->twig->render('Member/index.html.twig', ['members' => $Members]);
    }
}
