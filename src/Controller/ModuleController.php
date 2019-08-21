<?php

namespace App\Controller;

use App\Entity\Module;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Proxies\__CG__\App\Entity\Groupe;

use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\DoubleType;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;

class ModuleController extends AbstractController
{
    /**
     * @Route("/modules", name="module_liste")
     */
    public function index()
    {
        $mdls=$this->getDoctrine()
            ->getRepository("App:Module")
            ->findAll();
        return $this->render('module/index.html.twig', array("mdls"=>$mdls));
    }

    /**
     * @Route("/create_module", name="create_mdl")
     * @param Request $request
     * @param ObjectManager $manager
     * @return \Symfony\Component\HttpFoundation\RedirectResponse|\Symfony\Component\HttpFoundation\Response
     */
    public function ajouter(Request $request, ObjectManager $manager)
    {
        //dump($request);
        if ($request->request->count() > 0){
            $grp= new Groupe();
            $grp = $this->getDoctrine()
                ->getRepository(Groupe::class)->findOneBy(
                    ['codegr' => $request->request->get('code')]
                );
            dump($grp);
            $module=new Module();
            $module->setLibellemo($request->request->get('libelle'));
            $module->setDatemo($request->request->get('datemo'));
            $module->setDescmo($request->request->get('desc'));
            $module->setCodegr($grp);

            $manager->persist($module);
            $manager->flush();
            $this->addFlash('notice','module ADDED');
            return $this->redirectToRoute('module_liste');

        }

        return $this->render("module/ajouter.html.twig");


    }
    /**
     * @Route("/delete_mdl/{id}", name="delete_mdl")
     */
    public function delete_mdl($id)
    {
        $entityManager = $this->getDoctrine()->getManager();
        $mdl=$entityManager->getRepository('App:Module')->find($id);
        $entityManager->remove($mdl);
        $entityManager->flush();

        //notice
        $this->addFlash('error','Module REMOVED');

        return $this->redirectToRoute('module_liste');
    }
    /**
     * @Route("/details_mdl/{id}", name="detail_mdl")
     */
    public function details($id)
    {
        $mdl = $this->getDoctrine()
            ->getRepository(Module::class)
            ->find($id);
        //return new Response('Check out this great product: '.$stg->getNom());
        $grp = $mdl->getCodegr();
        return $this->render('module/details.html.twig', array("mdl"=>$mdl,"grp"=>$grp));
    }
}
