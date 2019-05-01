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
        //Meteo
        $var1 = array(0 => "Temp min.");
        $var2 = array(0 => "Temp max.");
        $var3 = array(0 => "Vent");
        $var3_desc = array(0 => "Desc. Vent");
        $var4 = array(0 => "Symbole");
        $var4_desc = array(0 => "Desc. Symbole");
        $var5 = array(0 => "Jour");

        $file = "http://api.tameteo.com/index.php?api_lang=fr&localidad=24379&affiliate_id=lskfarog8448";
        $xml = simplexml_load_file($file);
        $nday = 5; // for 5 days previsions
        $url = $xml->location->attributes()->city;
        $array = explode('[', $url);
        $town = trim($array[0]);
        $tempMin = array();
        $tempMax= array ();
        $windLogos = array();
        $windDesc = array();
        $meteoImg = array ();
        $meteoTitles = array ();
        $days = array();

        for ($i = 0; $i <= 5; $i++) {
            $xml->location->var;
            switch ($i) {
                case 0:
                    for ($j = 0; $j < $nday; $j++) {
                        $var1 = $var1 + array($j + 1 => htmlentities(
                            $xml
                                ->location
                                ->var[$i]
                                ->data
                                ->forecast[$j]
                                ->attributes()
                                ->value,
                            ENT_COMPAT,
                            'UTF-8'
                        ));
                    }
                    break;
                case 1:
                    for ($j = 0; $j < $nday; $j++) {
                        $var2 = $var2 + array($j + 1 => htmlentities(
                            $xml
                                ->location
                                ->var[$i]
                                ->data
                                ->forecast[$j]
                                ->attributes()
                                ->value,
                            ENT_COMPAT,
                            'UTF-8'
                        ));
                    }
                    break;
                case 2:
                    for ($j = 0; $j < $nday; $j++) {
                        $var3 = $var3 + array($j + 1 => htmlentities(
                            $xml
                                ->location
                                ->var[$i]
                                ->data
                                ->forecast[$j]
                                ->attributes()
                                ->id,
                            ENT_COMPAT,
                            'UTF-8'
                        ));
                        $var3_desc = $var3_desc + array($j + 1 => htmlentities(
                            $xml
                                ->location
                                ->var[$i]
                                ->data
                                ->forecast[$j]
                                ->attributes()
                                ->value,
                            ENT_COMPAT,
                            'UTF-8'
                        ));
                    }
                    break;
                case 3:
                    for ($j = 0; $j < $nday; $j++) {
                        $var4 = $var4 + array($j + 1 => htmlentities(
                            $xml
                                ->location
                                ->var[$i]
                                ->data
                                ->forecast[$j]
                                ->attributes()
                                ->id,
                            ENT_COMPAT,
                            'UTF-8'
                        ));
                        $var4_desc = $var4_desc + array($j + 1 => htmlentities(
                            $xml
                                 ->location
                                 ->var[$i]
                                 ->data
                                 ->forecast[$j]
                                 ->attributes()
                                 ->value,
                            ENT_COMPAT,
                            'UTF-8'
                        ));
                    }
                    break;
                case 4:
                    for ($j = 0; $j < $nday; $j++) {
                        $var5 = $var5 + array($j + 1 => htmlentities(
                            $xml
                                ->location
                                ->var[$i]
                                ->data
                                ->forecast[$j]
                                ->attributes()
                                ->value,
                            ENT_COMPAT,
                            'UTF-8'
                        ));
                    }
                    break;
            }
        }
        for ($i = 1; $i < $nday + 1; $i++) {
            $tempMin[] = $var1[$i];
            $tempMax[] = $var2[$i];
            if (isset($var3[$i])) {
                $wind = $var3[$i] % 8;
                if ($wind == 0) {
                    $wind = 8;
                }
                if ($var3[$i] == 33) {
                    $windLogos[] = $var3[$i];
                    $windDesc[] = $var3_desc[$i];
                } else {
                    $windLogos[] = $wind;
                }
            }
            if (isset($var4[$i])) {
                $meteoImg[] = $var4[$i];
                $meteoTitles[] = $var4_desc[$i];
            }
            $days[] = $var5[$i];
        }

        //Partners
        $partnerManager = new PartnerManager();
        $partners = $partnerManager->selectAll();
        //Events
        $eventManager = new EventManager();
        $events = $eventManager->selectEvents();

        return $this->twig->render('Home/index.html.twig', ['events' => $events, 'partners' => $partners,
            'tempsmin' => $tempMin, 'tempsmax' => $tempMax,
            'windlogos' => $windLogos, 'winDesc' => $windDesc,
            'meteoimgs' => $meteoImg, 'meteotitles' => $meteoTitles,
            'days' => $days, 'town' => $town]);
    }
}
