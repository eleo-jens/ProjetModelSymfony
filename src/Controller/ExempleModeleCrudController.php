<?php

namespace App\Controller;

use DateTime;
use App\Entity\Eleve;
use App\Entity\Inscription;
use App\Repository\EleveRepository;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;


class ExempleModeleCrudController extends AbstractController
{
    #[Route('/exemple/modele/crud', name: 'app_exemple_modele_crud')]
    public function index(): Response
    {
        return $this->render('exemple_modele_crud/index.html.twig', [
            'controller_name' => 'ExempleModeleCrudController',
        ]);
    }


    #[Route('insert/eleve/inscription')]
    public function insertEleveInscription(ManagerRegistry $doctrine)
    {
        // $e1 = new Eleve([
        //     'nom' => 'Leal',
        //     'prenom' => 'Laura'
        // ]);
        // $i1 = new Inscription([
        //     'dateInscription' => new DateTime(),
        //     'commentaire' => 'tout va bien'
        // ]);

        // $i2 = new Inscription([
        //     'dateInscription' => new DateTime(),
        //     'commentaire' => 'tout va mal'
        // ]);

        // $e1->addInscription($i1)->addInscription($i2);

        // $em = $doctrine->getManager();
        // $em->persist($e1);

        // plus besoin de persister les elements du côté n si on a rajouté "cascade: ['persist']
        // dans l'entité du côté One
        //$em->persist($i1);
        //$em->persist($i2);

        // dump($i1);
        // dump($i2);
        // dump($e1);
        // dd();
        // $em->flush();
        // dd($i1);

        $e2 = new Eleve([
            'nom' => 'Jens',
            'prenom' => 'Laura'
        ]);
        $i3 = new Inscription([
            'dateInscription' => new DateTime(),
            'commentaire' => 'En ordre'
        ]);


        // $e2->addInscription($i3);

        $em = $doctrine->getManager();
        $em->persist($e2);

        $em->flush();
        dd($e2);

    }

    // findAll (obtenir tous les élèves)
    #[Route('obtenir/eleves')]
    function obtenirEleves(ManagerRegistry $doctrine){
        $em = $doctrine->getManager();
        $rep = $em->getRepository(Eleve::class); 

        $arrEleves = $rep->findAll();

        $vars = ['arrayEleves' => $arrEleves,
                    'message' => "Coucou depuis le controller"];

        // dd($arrEleves);
        return $this->render('exemple_modele_crud/obtenir_eleves.html.twig', $vars);
    }

    #[Route('obtenir/eleves/find/by')]
    function obtenirElevesFindBy(EleveRepository $rep){

        $eleves =  $rep->findBy (
            [ 'prenom' => 'Laura', 
               'nom' => 'Leal'
            ]
        );
        
        $vars = ['eleves' => $eleves]; 

        // dd($eleves);

        return $this->render('exemple_modele_crud/obtenir_eleves_find_by.html.twig', $vars);
    }

    #[Route('/obtenir/eleve/{id}')]
    public function obtenirEleveFind(EleveRepository $repo, Request $req){
        $id = $req->get("id"); 
        $eleve = $repo->find($id); 

        $vars = ['eleve' => $eleve, 
                'id' => $id]; 
        return $this->render('exemple_modele_crud/obtenir_eleves_find.html.twig', $vars);
    }

    #[Route('obtenir/eleve/by/')]
    public function obtenirEleveFindBy(EleveRepository $repo){
        $eleve = $repo->findBy();
    }

    #[Route('/obtenir/eleve/param/converter/{nom}')]
    public function obtenirEleveFindParamConverter(Eleve $e){

        $vars = ['eleve' => $e]; 
        return $this->render('exemple_modele_crud/obtenir_eleves_find.html.twig', $vars);
    }
    
    // update
    #[Route('/update/eleve')]
    public function updateEleve (ManagerRegistry $doctrine){
        $em = $doctrine->getManager(); 
        $rep = $em->getRepository(Eleve::class);
        // findOneBy prend le premier qu'il trouve
        $e = $rep->findOneBy (['nom' => 'Leal']);
        $e->setNom("Smith"); 
        $em->flush();
        dd($e); 
    }

    //delete 
    #[Route('/delete/eleve')]
    public function removeEleve (ManagerRegistry $doctrine){
        $em = $doctrine->getManager();
        $rep = $em->getRepository(Eleve::class);
        $e = $rep->findOneBy(['nom' => 'Smith', 
                            'prenom' => 'Laura']); 

        if ($e){
            $em->remove($e);
            $em->flush();
            return new Response("objet supprimé"); 
        }
        else {
            return new Response("Pas trouvé"); 
        }
    }

}
