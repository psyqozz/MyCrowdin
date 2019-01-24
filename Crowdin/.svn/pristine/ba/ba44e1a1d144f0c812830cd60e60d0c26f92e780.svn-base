<?php

namespace App\Controller;

use App\Form\SourceType;
use App\Form\AddOneSourceType;
use App\Form\TranslateType;
use App\Entity\Project;
use App\Entity\Source;
use App\Entity\SourceTranslated;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class SourceController extends Controller
{
    /**
     * @Route("/user/project/{id}/source/oneSource", name="oneSource")
     */
    public function addOneSource(Request $request, Project $project)
    {
        $entityManager = $this->getDoctrine()->getManager();
        $entity = $entityManager->getRepository('App:Project')->find($project->getId());
        $langue = $entity->getLangOrigin()->getLibelleLangage();

        // 1) build the form
        $source = new Source();
        $form = $this->createForm(AddOneSourceType::class, $source);

        // 2) handle the submit (will only happen on POST)
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $source->setProject($entity);
            $source->setLangue($langue);
            // 4) save the  Source!
            $entityManager->persist($source);
            $entityManager->flush();

            return $this->redirectToRoute('oneSource', array('id' => $project->getId()));
        }

        return $this->render(
            'user/source/oneSource.html.twig', array(
                'form' => $form->createView(),
	    	    'project' => $entity,
		        'langue' => $langue
	    ));
    }

    /**
     * @Route("/user/project/{id}/source", name="source_creation")
     */
    public function createSource(Request $request, Project $project)
    {
        $entityManager = $this->getDoctrine()->getManager();
        $entity = $entityManager->getRepository('App:Project')->find($project->getId());
        $langue = $entity->getLangOrigin()->getLibelleLangage();

        // 1) build the form
        $source = new Source();
        $form = $this->createForm(SourceType::class, $source);

        // 2) handle the submit (will only happen on POST)
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $source->setProject($entity);
            $source->setLangue($langue);
            // 4) save the  Source!
            $entityManager->persist($source);
            $entityManager->flush();

            return $this->redirectToRoute('source_creation', array('id' => $project->getId()));
        }

        return $this->render(
            'user/source/index.html.twig', array(
                'form' => $form->createView(),
	    	    'project' => $entity,
		        'langue' => $langue
	    ));
    }

    /**
     * @Route("/user/source/{id}/sources", name="sources_show")
     * 
     */
    public function showSources(Project $project)
    {
        $usr = $this->getUser();
        $entityManager = $this->getDoctrine()->getManager();
        $theProject = $entityManager->getRepository('App:Project')->find($project->getId());

        $sources = $this->getDoctrine()
            ->getRepository('App:Source')
            ->findBy(array('project' => $theProject));

        $sourcesTrans = $this->getDoctrine()
            ->getRepository('App:SourceTranslated')
            ->findAll();
        
        return $this->render('user/source/sources.html.twig', array(
            'sources' => $sources,
            'theProject' => $theProject,
            'sourcesTrans' => $sourcesTrans,
            'source' => null
        ));
    }

    /**
     * @Route("/user/project/{id_project}/sources/{id}/translate", name="tanslate_action")
     */
    public function actionTranslate(Request $request, Source $source, $id_project)
    {
        $usr = $this->getUser();
        $langage = $usr->getLangages();

	    $sourcesTrans = $this->getDoctrine()
            ->getRepository('App:SourceTranslated')
            ->findAll();
        	
        $entityManager = $this->getDoctrine()->getManager();
        
        // Récupération des sources du projets pour reAfficher la liste
        $theProject = $entityManager->getRepository('App:Project')->find($id_project);
        $sources = $this->getDoctrine()
            ->getRepository('App:Source')
            ->findBy(array('project' => $theProject));
        $tabLang["Selectionner la langue"] = "";
        foreach ($langage as $oneLang) {
            if ($oneLang->getLibelleLangage() != $theProject->getLangOrigin()->getLibelleLangage())
                $tabLang[$oneLang->getLibelleLangage()] = $oneLang->getLibelleLangage();		
        }

        $theSource = $entityManager->getRepository('App:Source')->find($source->getId());
	
        $valueTranslated = new SourceTranslated();
        $form = $this->createForm(TranslateType::class, $valueTranslated, array(
            'tabLang' => $tabLang
        ));
	
        $form->handleRequest($request);
        
        if ($form->isSubmitted() && $form->isValid()) {
            $valueTranslated->setSource($theSource);
            $valueTranslated->setUser($usr);
            $entityManager->persist($valueTranslated);
            $entityManager->flush();
	
            return $this->redirectToRoute('tanslate_action', array('id' => $source->getId(), 'id_project' => $theProject->getId()));
        }

        return $this->render(
            'user/source/sources.html.twig', array(
                'form' => $form->createView(),
                'source' => $theSource,
                'sources' => $sources,
                'theProject' => $theProject,
                'sourcesTrans' => $sourcesTrans,
	    ));
    }
}
