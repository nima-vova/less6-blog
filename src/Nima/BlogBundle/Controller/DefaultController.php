<?php
namespace Nima\BlogBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;






class DefaultController extends Controller
{
    /**
     * @Route("/")
     */
    public function indexAction()
    {
        return $this->render('NimaBlogBundle:Default:index.html.twig');
    }

    /**
     * @Route("/link/{id}", requirements={"id" = "\d+"}, defaults={"id" =1})
     * @Method({"GET"})
     * @return array
     */
    public function showGetAction($id)
    {
        /*if($id=="22") {
            //$link=array('link' => $id);
            //file_put_contents('less7.json',json_encode($link));
            $response = new Response();
            $response->setContent(file_get_contents('less7.json'));
            $response->headers->set('Content-Type', 'application/json');
            return $response;
        } */

        $json=file_get_contents('less7.json');
        $obj = json_decode($json);
        //echo $obj->{'link'};
        //$data= $obj->link;
        if(($obj->link)!='23') {

            throw $this->createNotFoundException('файл чомусь путсий');

        }
        else {
            $response = new Response();
            $response->setContent(file_get_contents('less7.json'));
            $response->headers->set('Content-Type', 'application/json');
            return $response;
        }
    }

    /**
     * @Route("/post")
     * @Method({"POST"})
     */
    public function showPostAction()
    {

        $request = Request::createFromGlobals();
        $request->getPathInfo();

        $name=$request->request->get('name');

        $link=array('link' => $name);
        file_put_contents('less7.json',json_encode($link));
        $response = new Response();
        $response->setContent(file_get_contents('less7.json'));
        $response->headers->set('Content-Type', 'application/json');
        return $response;

        //file_put_contents('11.txt', $name);

        /*
         $json=file_get_contents('less7.json');
         $obj = json_decode($json);
         //echo $obj->{'link'};
         file_put_contents('11.txt', $obj->link);
        */




    }

    /**
     * @Route("/put")
     * @Method({"PUT"})
     */
    public function showPutAction()
    {


        $request = Request::createFromGlobals();
        $request->getPathInfo();

        $name=$request->request->get('name');

        //$name = json_decode($request->getContent(), true);

        $link=array('link' => $name);
        file_put_contents('less7.json',json_encode($link));
        $response = new Response();
        $response->setContent(file_get_contents('less7.json'));
        $response->headers->set('Content-Type', 'application/json');
        return $response;

        //file_put_contents('11.txt', $name);

        /*
         $json=file_get_contents('less7.json');
         $obj = json_decode($json);
         //echo $obj->{'link'};
         file_put_contents('11.txt', $obj->link);
        */




    }

    /**
     * @Route("/patch")
     * @Method({"PATCH"})
     */
    public function showPatchAction()
    {


        $request = Request::createFromGlobals();
        $request->getPathInfo();

        $name=$request->request->get('name');

        //$name = json_decode($request->getContent(), true);

        $link=array('link' => $name);
        file_put_contents('less7.json',json_encode($link));
        $response = new Response();
        $response->setContent(file_get_contents('less7.json'));
        $response->headers->set('Content-Type', 'application/json');
        return $response;

        //file_put_contents('11.txt', $name);

        /*
         $json=file_get_contents('less7.json');
         $obj = json_decode($json);
         //echo $obj->{'link'};
         file_put_contents('11.txt', $obj->link);
        */




    }

}
