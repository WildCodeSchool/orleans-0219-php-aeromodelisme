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
    public function legalmentions()
    {
        return $this->twig->render('Legal/legalmentions.html.twig');
    }
}
