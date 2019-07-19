<?php
/**
 * Created by PhpStorm.
 * User: dgmick
 * Date: 19/07/2019
 * Time: 15:14
 */

namespace AppBundle\Service;

use Knp\Component\Pager\Paginator;
use Symfony\Component\HttpFoundation\RequestStack;

class Pagination
{
    /** @var RequestStack */
    private $request;

    /** @var Paginator */
    private $knp;

    public function __construct(RequestStack $request, Paginator $knp)
    {
        $this->request = $request;
        $this->knp = $knp;
    }

    /**
     * @param $target mixed
     * @param $limit int
     * @return \Knp\Component\Pager\Pagination\PaginationInterface
     */
    public function paginate($target, $limit)
    {
        return $this->knp->paginate(
            $target,
            $this->request->getCurrentRequest()->query->getInt('page', 1),
            $this->request->getCurrentRequest()->query->getInt('limit', $limit)
        );
    }
}
