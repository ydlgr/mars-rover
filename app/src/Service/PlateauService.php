<?php

namespace App\Service;

use App\Entity\Plateau;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\RequestStack;

class PlateauService
{
    private RequestStack $requestStack;

    public function __construct(RequestStack $requestStack)
    {
        $this->requestStack = $requestStack;
    }

    /**
     * @param Request $request
     * @return Plateau
     */
    public function savePlateau(Request $request) : Plateau
    {
        $plateau = new Plateau();
        $plateau->setWidth($request->get('width'));
        $plateau->setHeight($request->get('height'));

        $session = $this->requestStack->getSession();

        $maxId = 1;
        if(count($session->all()) > 0)
        {
            $maxId = count($session->all()) + 1;
        }
        $plateau->setId($maxId);

        $session->set('plateau' . $maxId, $plateau);

        return $plateau;
    }
}
