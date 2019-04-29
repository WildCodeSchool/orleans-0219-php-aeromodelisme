<?php
/**
 * Created by PhpStorm.
 * User: root
 * Date: 11/10/17
 * Time: 16:07
 * PHP version 7
 */

namespace App\Controller;

use App\Model\EventManager;
use App\Model\PartnerManager;

/**
 * Class AdminController
 *
 */
class AdminController extends AbstractController
{


    /**
     * Display Events
     *
     * @return string
     * @throws \Twig\Error\LoaderError
     * @throws \Twig\Error\RuntimeError
     * @throws \Twig\Error\SyntaxError
     */
    public function events()
    {
        $eventManager = new EventManager();
        $events = $eventManager->selectAll();

        return $this->twig->render('Admin/events.html.twig', ['events' => $events]);
    }

    /**
     * @return string
     * @throws \Twig\Error\LoaderError
     * @throws \Twig\Error\RuntimeError
     * @throws \Twig\Error\SyntaxError
     */
    public function partners()
    {
        $partnerManager = new PartnerManager();
        $partners = $partnerManager->selectAll();

        return $this->twig->render('Admin/partners.html.twig', ['partners' => $partners]);
    }

    public function deletePartner() : void
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $partnerManager = new PartnerManager();
            $id = $_POST['id'];
            $partner = $partnerManager->selectOneById($id);
            $partnerImg = $partner['image'];
            $partnerManager->delete($id);

            if (file_exists('../public/assets/images/partner/'. $partnerImg)) {
                unlink('../public/assets/images/partner/'. $partnerImg);
                header('Location: /Admin/partners');
            }
        }
    }
}
