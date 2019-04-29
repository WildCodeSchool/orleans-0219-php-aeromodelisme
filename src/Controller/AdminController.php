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
     * Display event edition page specified by $id
     *
     * @param int $id
     * @return string
     * @throws \Twig\Error\LoaderError
     * @throws \Twig\Error\RuntimeError
     * @throws \Twig\Error\SyntaxError
     */
    public function editevent(int $id): string
    {
        $eventManager = new EventManager();
        $event = $eventManager->selectOneById($id);
        $failed ='';
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {

            if (!empty($_FILES['picture']['error'] != 4)) {
                $allowed = ['image/jpeg', 'image/png'];

                $imageFile = $_FILES['picture'];
                $fileName = $imageFile['name'];
                $fileTmp = $imageFile['tmp_name'];
                $fileSize = $imageFile['size'];
                $fileType = $imageFile['type'];
                $fileError = $imageFile['error'];

                $file_exp = explode('/',$fileType);
                $fileExt = strtolower(end($file_exp));
                if (in_array($fileType, $allowed)) {

                    if ($fileError === 0) {

                        if ($fileSize <= 1048576) {
                            $file_name_new = uniqid('', true) . '.' . $fileExt;
                            $file_destination = '../public/assets/images/events/' . $file_name_new;

                            if (move_uploaded_file($fileTmp, $file_destination)) {
                                $uploaded = $file_destination;
                            } else {
                                $failed = $fileName . " failed to uploaded";
                            }

                        } else {

                            $failed = $fileName . " is too large.";
                        }

                    } else {
                        $failed = $fileName . " errored with code " . $fileError;
                    }

                } else {
                    $failed = $fileName . " file extension " . $fileExt . " is not allowed";
                }
                if (!empty($uploaded)) {
                    $event['id'] = $id;
                    $event['title'] = $_POST['title'];
                    $event['event_date'] = $_POST['event_date'];
                    $event['picture'] = 'assets/images/events/' . $file_name_new;
                    $event['description'] = $_POST['description'];
                    $eventManager->update($event);
                }

            } else {
                $event['id'] = $id;
                $event['title'] = $_POST['title'];
                $event['event_date'] = $_POST['event_date'];
                $event['description'] = $_POST['description'];
                $eventManager->update($event);
            }
        }
        return $this->twig->render('Admin/editevent.html.twig', ['event' => $event, 'error'=> $failed]);
    }
}
