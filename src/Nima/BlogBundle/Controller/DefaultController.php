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
     * @Route("/get")
     * @Method({"GET"})
     * @return array
     */
    public function showGetAction()
    {


        $json=file_get_contents('less7.json');

        $test=explode(",", $json);

        if(empty($json)){
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
     *@Route("/post/{id}", requirements={"id" = "\d+"}, defaults={"id" =1})
     * @Method({"POST"})
     */
    public function showPostAction($id)
    {


         $json=file_get_contents('less7.json');
         $obj = json_decode($json);
         //echo $obj->{'link'};
        $test=explode(",", $json);
         //file_put_contents('11.txt', count($test));

        if(empty($json)){
            throw $this->createNotFoundException('файл чомусь путсий');

        }
        elseif (count($test)<$id or (($id-1)<0)) {
            throw $this->createNotFoundException('даних під таким індексом не існує');
        }
        else {

            $response = new Response();
            $response->setContent($test[$id-1]);
            $response->headers->set('Content-Type', 'application/json');
            return $response;
        }


    }

    /**
     *@Route("/put/{id}", requirements={"id" = "\d+"}, defaults={"id" =1})
     * @Method({"PUT","PATCH"})
     */
    public function showPutPatchAction($id)
    {




        $json=file_get_contents('less7.json');
        $obj = json_decode($json);
        //echo $obj->{'link'};
        $test=explode(",", $json);
        //file_put_contents('11.txt', count($test));

        if(empty($json)){
            throw $this->createNotFoundException('файл чомусь путсий');

        }
        elseif (count($test)<$id or (($id-1)<0)) {
            throw $this->createNotFoundException('даних під таким індексом не існує');
        }
        else {
            $request = Request::createFromGlobals();
            $request->getPathInfo();

            $name=$request->request->get('name');
            $test[$id-1]=$name;

            file_put_contents('less7.json', implode(",", $test));
            $response = new Response();
            $response->setContent($test[$id-1]);
            $response->headers->set('Content-Type', 'application/json');
            return $response;
        }
    }

    /**
     *@Route("/del/{id}", requirements={"id" = "\d+"}, defaults={"id" =1})
     * @Method({"DELETE"})
     */
    public function showDeleteAction($id)
    {




        $json=file_get_contents('less7.json');
        $obj = json_decode($json);

        $test=explode(",", $json);


        if(empty($json)){
            throw $this->createNotFoundException('файл чомусь путсий');

        }
        elseif (count($test)<$id or (($id-1)<0)) {
            throw $this->createNotFoundException('даних під таким індексом не існує');
        }
        else {

            unset($test[$id-1]);

            file_put_contents('less7.json', implode(",", $test));
            $response = new Response();
            $response->setContent($test[$id-1]);
            $response->headers->set('Content-Type', 'application/json');
            return $response;
        }
    }

}
