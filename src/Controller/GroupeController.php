<?php

namespace App\Controller;

use App\Entity\Groupe;

use App\Form\AddStagiaireType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Doctrine\Common\Persistence\ObjectManager;




use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Doctrine\ORM\EntityManager;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;

use Symfony\Component\Routing\Annotation\Route;

class GroupeController extends AbstractController
{
    /**
     * @Route("/groupes", name="groupe_liste")
     */
    public function index()
    {
        $grps=$this->getDoctrine()
            ->getRepository("App:Groupe")
            ->findAll();
        return $this->render('groupe/index.html.twig', array("grps"=>$grps));
    }
    /**
     * @Route("/delete/{id}", name="delete_grp")
     */
    public function delete($id)
    {
        $entityManager = $this->getDoctrine()->getManager();
        $grp=$entityManager->getRepository('App:Groupe')->find($id);
        var_dump($grp);
        $entityManager->remove($grp);
        $entityManager->flush();

        //notice
        $this->addFlash('error','groupe REMOVED');

        return $this->redirectToRoute('groupe_liste');
    }

    /**
     * @Route("/create_groupe", name="create_grp")
     * @Route("/create_groupe/{id}/edit", name="edit_grp")
     */
    public function create(Groupe $grp = null ,Request $req)
    {
        if (!$grp){
        $grp= new Groupe();
        }
        $form = $this->createFormBuilder($grp)
            ->add('libellegr', TextType::class,array("attr"=>array("class"=>"form-control","style"=>"margin-bottom:16px","placeholder"=>"libelle groupe....")))
            ->add('niveauxgr', TextType::class,array("attr"=>array("class"=>"form-control","style"=>"margin-bottom:16px","placeholder"=>"niveaux groupe....")))
            ->add('anneescogr', TextType::class,array("attr"=>array("class"=>"form-control","style"=>"margin-bottom:16px","placeholder"=>"annee scolaire....")))
            ->add('fillieregr', TextType::class,array("attr"=>array("class"=>"form-control","style"=>"margin-bottom:16px","placeholder"=>"fillier....")))
            ->add('cin', SubmitType::class,array('label' => 'Create or save Groupe',"attr"=>array("class"=>"btn btn-primary btn-lg btn-block","style"=>"margin-bottom:16px")))
            ->getForm();

        $form->handleRequest($req);

        if ($form->isSubmitted() && $form->isValid()) {
            if (!$grp){
                $grp->setCodegr(getCodegr());
            }
            // $form->getData() holds the submitted values
            // but, the original `$task` variable has also been updated
            $grp = $form->getData();

            // ... perform some action, such as saving the task to the database
            // for example, if Task is a Doctrine entity, save it!
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($grp);
            $entityManager->flush();


            return $this->redirectToRoute('groupe_liste');
        }
        return $this->render('groupe/ajouter.html.twig', [
            'form' => $form->createView(),
        ]);


    }
    /**
     * @Route("/details_grp/{id}", name="detail_grp")
     */
    public function details($id)
    {
        $grp=$this->getDoctrine()
            ->getRepository("App:Groupe")
            ->find($id);
        return $this->render('groupe/details.html.twig', ["grp"=>$grp]);


    }
}
