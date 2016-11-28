<?php
namespace Nima\BlogBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Nima\BlogBundle\NimaGetAndPutFile;





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
     * @Route("/get")
     * @Method({"GET"})
     * @return array
     */
    public function showGetAction($JsonResponse)
    {

        $json=new NimaGetAndPutFile();
        $json->nimaGetFile();
        //$json=file_get_contents('less7.json');


        if(empty($json)){
            throw $this->createNotFoundException('файл чомусь путсий');

        }
        else {
            $jsonResponse = new Response();
            $jsonResponse->setContent($json->nimaGetFile());
            //$response->headers->set('Content-Type', 'application/json');
            return $jsonResponse;
        }
    }

    /**
     *@Route("/post/{id}", requirements={"id" = "\d+"}, defaults={"id" =0})
     * @Method({"POST"})
     */
    public function showPostAction($id)
    {


        $json=new NimaGetAndPutFile();
        $obj = json_decode($json->nimaGetFile());

        //file_put_contents('11.txt', property_exists($obj, $id));


         if(empty($json)){
            throw $this->createNotFoundException('файл чомусь путсий');

        }
        elseif (empty (property_exists($obj, $id))) {
            throw $this->createNotFoundException('даних під таким індексом не існує');
        }
         else {

             $jsonResponse = new Response();
             $jsonResponse->setContent($obj->$id);
             return $jsonResponse;
         }
/*
        if(empty($json)){
            throw $this->createNotFoundException('файл чомусь путсий');

        }
        elseif (count($test)<$id or (($id-1)<0)) {
            throw $this->createNotFoundException('даних під таким індексом не існує');
        }
        else {

            $jsonResponse = new Response();
            $jsonResponse->setContent($test[$id-1]);
            //$response->headers->set('Content-Type', 'application/json');
            return $jsonResponse;
        }
*/

    }

    /**
     *@Route("/post/{id}", requirements={"id" = "\d+"}, defaults={"id" =0})
     * @Method({"PUT"})
     */
    public function showPutAction($id)
    {




        $json=new NimaGetAndPutFile();
        $obj = json_decode($json->nimaGetFile());
        if(empty($json)){
            throw $this->createNotFoundException('файл чомусь путсий');

        }
        elseif (empty (property_exists($obj, $id))) {
            throw $this->createNotFoundException('даних під таким індексом не існує');
        }
        else {
            $request = Request::createFromGlobals();
            $request->getPathInfo();

            $name=$request->request->get('name');
            //$test[$id-1]=$name;
            //$obj->$id=$name;
            foreach($obj as $key => $value) {

                $obj->$key ="null";

            }
               $obj->$id=$name;




            $objEncode=json_encode($obj);
            $json->nimaPutFile($objEncode);
            $jsonResponse = new Response();
            $jsonResponse->setContent($obj->$id);
            return $jsonResponse;
        }
    }




    /**
     *@Route("/post/{id}", requirements={"id" = "\d+"}, defaults={"id" =0})
     * @Method({"PATCH"})
     */
    public function showPatchAction($id)
    {




        $json=new NimaGetAndPutFile();
        $obj = json_decode($json->nimaGetFile());
        if(empty($json)){
            throw $this->createNotFoundException('файл чомусь путсий');

        }
        elseif (empty (property_exists($obj, $id))) {
            throw $this->createNotFoundException('даних під таким індексом не існує');
        }
        else {
            $request = Request::createFromGlobals();
            $request->getPathInfo();

            $name=$request->request->get('name');
            //$test[$id-1]=$name;
            $obj->$id=$name;
            $objEncode=json_encode($obj);
            $json->nimaPutFile($objEncode);
            $jsonResponse = new Response();
            $jsonResponse->setContent($obj->$id);
            return $jsonResponse;
        }
    }







    /**
     *@Route("/post/{id}", requirements={"id" = "\d+"}, defaults={"id" =0})
     * @Method({"DELETE"})
     */
    public function showDeleteAction($id)
    {

        $json=new NimaGetAndPutFile();
        $obj = json_decode($json->nimaGetFile());


        if (empty($json)) {
            throw $this->createNotFoundException('файл чомусь путсий');

        } elseif (empty (property_exists($obj, $id))) {
            throw $this->createNotFoundException('даних під таким індексом не існує');
        } else {
            $request = Request::createFromGlobals();
            $request->getPathInfo();

            $name = $request->request->get('name');
            unset($obj->$id);
            $objEncode=json_encode($obj);
            $json->nimaPutFile($objEncode);
            $jsonResponse = new Response();
            $jsonResponse->setContent($id . " видалений");
            return $jsonResponse;
        }
    }

}
