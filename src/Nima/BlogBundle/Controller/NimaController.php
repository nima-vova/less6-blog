<?php

namespace Nima\BlogBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Nima\BlogBundle\NimaGetAndPutFile;

class NimaController extends Controller
{
    /**
     * @Route("/")
     */
    public function indexAction()
    {
        return $this->render('NimaBlogBundle:Default:index.html.twig');
    }

    /**
     * @Route("/posts")
     * @Method({"GET"})
     *
     * @return string
     */
    public function showGetAction()
    {
        $json = new NimaGetAndPutFile();
        $json->nimaGetFile();
        if (empty($json)) {
            throw $this->createNotFoundException('файл чомусь путсий');
        } else {
            $jsonResponse = new Response();
            $jsonResponse->setContent($json->nimaGetFile());

            return $jsonResponse;
        }
    }

    /**
     *@Route("/posts/{id}", requirements={"id" = "\d+"}, defaults={"id" =0})
     * @Method({"GET"})
     *
     * @param int $id
     *
     * @return object
     */
    public function showGetIdAction($id)
    {
        $json = new NimaGetAndPutFile();
        $obj = json_decode($json->nimaGetFile());
        if (empty($json)) {
            throw $this->createNotFoundException('файл чомусь путсий');
        } elseif (empty(property_exists($obj, $id))) {
            throw $this->createNotFoundException('даних під таким індексом не існує');
        } else {
            $jsonResponse = new Response();
            $jsonResponse->setContent($obj->$id);

            return $jsonResponse;
        }
    }
    /**
     *@Route("/posts")
     * @Method({"POST"})
     *
     * @return string
     */
    public function showPostAction()
    {
        $json = new NimaGetAndPutFile();
        $obj = json_decode($json->nimaGetFile());
        if (empty($json)) {
            throw $this->createNotFoundException('файл чомусь путсий');
        } else {
            $request = Request::createFromGlobals();
            $request->getPathInfo();
            $name = $request->request->get('name');
            $coutKey = 0;
            foreach ($obj as $key => $value) {
                ++$coutKey;
            }
            $obj->$coutKey = $name;
            $objEncode = json_encode($obj);
            $json->nimaPutFile($objEncode);
            $jsonResponse = new Response();
            $jsonResponse->setContent($obj->$coutKey.' доданий до списку');

            return $jsonResponse;
        }
    }

    /**
     *@Route("/posts/{id}", requirements={"id" = "\d+"}, defaults={"id" =0})
     * @Method({"PUT"})
     *
     * @param int $id
     *
     * @return object
     */
    public function showPutAction($id)
    {
        $json = new NimaGetAndPutFile();
        $obj = json_decode($json->nimaGetFile());
        if (empty($json)) {
            throw $this->createNotFoundException('файл чомусь путсий');
        } elseif (empty(property_exists($obj, $id))) {
            throw $this->createNotFoundException('даних під таким індексом не існує');
        } else {
            $request = Request::createFromGlobals();
            $request->getPathInfo();
            $name = $request->request->get('name');
            foreach ($obj as $key => $value) {
                $obj->$key = 'null';
            }
            $obj->$id = $name;
            $objEncode = json_encode($obj);
            $json->nimaPutFile($objEncode);
            $jsonResponse = new Response();
            $jsonResponse->setContent($obj->$id);

            return $jsonResponse;
        }
    }

    /**
     *@Route("/posts/{id}", requirements={"id" = "\d+"}, defaults={"id" =0})
     * @Method({"PATCH"})
     *
     * @param int $id
     *
     * @return object
     */
    public function showPatchAction($id)
    {
        $json = new NimaGetAndPutFile();
        $obj = json_decode($json->nimaGetFile());
        if (empty($json)) {
            throw $this->createNotFoundException('файл чомусь путсий');
        } elseif (empty(property_exists($obj, $id))) {
            throw $this->createNotFoundException('даних під таким індексом не існує');
        } else {
            $request = Request::createFromGlobals();
            $request->getPathInfo();

            $name = $request->request->get('name');
            $obj->$id = $name;
            $objEncode = json_encode($obj);
            $json->nimaPutFile($objEncode);
            $jsonResponse = new Response();
            $jsonResponse->setContent($obj->$id);

            return $jsonResponse;
        }
    }

    /**
     *@Route("/post/{id}", requirements={"id" = "\d+"}, defaults={"id" =0})
     * @Method({"DELETE"})
     *
     * @param int $id
     *
     * @return string
     */
    public function showDeleteAction($id)
    {
        $json = new NimaGetAndPutFile();
        $obj = json_decode($json->nimaGetFile());
        if (empty($json)) {
            throw $this->createNotFoundException('файл чомусь путсий');
        } elseif (empty(property_exists($obj, $id))) {
            throw $this->createNotFoundException('даних під таким індексом не існує');
        } else {
            $request = Request::createFromGlobals();
            $request->getPathInfo();
            unset($obj->$id);
            $objEncode = json_encode($obj);
            $json->nimaPutFile($objEncode);
            $jsonResponse = new Response();
            $jsonResponse->setContent($id.' видалений');

            return $jsonResponse;
        }
    }
}
