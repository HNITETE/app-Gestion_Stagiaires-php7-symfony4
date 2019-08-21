<?php

namespace App\Controller;
use App\Entity\Module;
use App\Entity\Seance;
use App\Form\AddStagiaireType;
use Symfony\Component\HttpFoundation\Request;


use Doctrine\Common\Persistence\ObjectManage;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;


use Doctrine\Common\Persistence\ObjectManager;
use Doctrine\ORM\EntityManager;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;

class SeanceController extends AbstractController
{
    /**
     * @Route("/seances", name="seance_liste")
     */
    public function indexSeance()
    {
        $sncs=$this->getDoctrine()
            ->getRepository("App:Seance")
            ->findAll();
        return $this->render('seance/index.html.twig', array("sncs"=>$sncs));

    }
    /**
     * @Route("/create_seance", name="create_seance")
     * @param Request $request
     * @param ObjectManager $manager
     * @return \Symfony\Component\HttpFoundation\RedirectResponse|\Symfony\Component\HttpFoundation\Response
     */
    public function ajouter(Request $request, ObjectManager $manager)
    {
        //dump($request);
        if ($request->request->count() > 0){
            $mdl= new Seance();
            $mdl = $this->getDoctrine()
                ->getRepository(Module::class)->findOneBy(
                    ['codemo' => $request->request->get('codemo')]
                );
            dump($mdl);

            $seance=new Seance();
            $seance->setDatese($request->request->get('datese' ));
            $seance->setCodemo($mdl);
            $seance->setHeuredbse($request->request->get('heured' | date('H , i')));
            $seance->setHeurefnse($request->request->get('heuref' | date('H , i')));
            $seance->setResmmese($request->request->get('resume'));
            $manager->persist($seance);
            $manager->flush();
            $this->addFlash('notice','seance ADDED');
            return $this->redirectToRoute('seance_liste');

        }

        return $this->render("seance/ajouter.html.twig");
    }
    /**
     * @Route("/details_seance/{id}", name="detail_snc")
     */
    public function details($id)
    {
        $snc = $this->getDoctrine()
            ->getRepository(Seance::class)
            ->find($id);
        //return new Response('Check out this great product: '.$stg->getNom());
        $mdl = $snc->getCodemo();
        return $this->render('seance/details.html.twig', array("snc"=>$snc,"mdl"=>$mdl));
    }
    /**
     * @Route("/delete_snc/{id}", name="delete_cns")
     */
    public function delete_snc($id)
    {
        $entityManager = $this->getDoctrine()->getManager();
        $snc=$entityManager->getRepository('App:Seance')->find($id);
        $entityManager->remove($snc);
        $entityManager->flush();

        //notice
        $this->addFlash('error','Seance REMOVED');

        return $this->redirectToRoute('seance_liste');
    }
}

