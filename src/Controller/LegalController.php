<?php
/**
 * Created by PhpStorm.
 * User: aurelwcs
 * Date: 08/04/19
 * Time: 18:40
 */

namespace App\Controller;

class LegalController extends AbstractController
{

    /**
     * Display LegalMentions
     *
     * @return string
     * @throws \Twig\Error\LoaderError
     * @throws \Twig\Error\RuntimeError
     * @throws \Twig\Error\SyntaxError
     */
    public function mentionslegales()
    {
        return $this->twig->render('Legal/mentionslegales.html.twig');
    }
}
