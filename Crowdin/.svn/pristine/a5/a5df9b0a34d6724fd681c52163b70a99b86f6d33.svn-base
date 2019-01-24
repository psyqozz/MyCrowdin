<?php
// src/Controller/ProjectController.php
namespace App\Controller;

use App\Form\ProjectType;
use App\Entity\Project;
use App\Entity\User;
use App\Entity\Langage;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class ProjectController extends Controller
{
    /**
     * @Route("/user/project", name="project_creation")
     */
    public function createProject(Request $request)
    {
        $entityManager = $this->getDoctrine()->getManager();

        $user = $this->getUser();
        // 1) build the form
        $project = new Project();
        $form = $this->createForm(ProjectType::class, $project);

        // 2) handle the submit (will only happen on POST)
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $project->setUser($user);
	        $project->setStatut("ouvert");
            // 4) save the  Project!
            $entityManager->persist($project);
            $entityManager->flush();

            return $this->redirectToRoute('project_show');
        }

        return $this->render(
            'user/project/index.html.twig',
            array('form' => $form->createView())
        );
    }

    /**
     * @Route("/user/project/projects.html.twig", name="project_show")
     * 
     */
    public function showMyProjects()
    {
        $usr = $this->getUser();

        $projects = $this->getDoctrine()
            ->getRepository('App:Project')
            ->findBy(array('user' => $usr));
        
        return $this->render('user/project/projects.html.twig', array(
            'projects' => $projects,
            'nbProj' => count($projects)
        ));
    }

    /**
     * @Route("/user/project/{id}/tabProject.html.twig", name="project_infos")
     *
     */
    public function showInformationProject(Request $request, Project $project)
    {
	$entityManager = $this->getDoctrine()->getManager();
	$theProject = $entityManager
            ->getRepository('App:Project')
            ->find($project->getId());
	$nbSrc = $entityManager->getRepository('App:Source')
			       ->findByproject_id($project->getId());
	
	$nbSrcTrans = $entityManager->getRepository('App:SourceTranslated')
			       ->findBysource_id($project->getId());
	     return $this->render('user/project/tabProject.html.twig', array(
	     'project' => $theProject,
	     'nbSrc' => $nbSrc,
	     'nbSrcTrans' => $nbSrcTrans
        ));
    }

     /**
      * @Route("/user/project/{id}/projects.html.twig", name="project_block")
      * 
      */
    public function blockMyProject(Request $request, Project $projectBlock)
    {
        $usr = $this->getUser();
	    $entityManager = $this->getDoctrine()->getManager();
        $projects = $entityManager
            ->getRepository('App:Project')
            ->findBy(array('user' => $usr));
	    
        
        $entity = $entityManager->getRepository('App:Project')->find($projectBlock->getId());
        if ($entity->getStatut() == "ouvert") 
            $entity->setStatut("bloquer");	   
        elseif ($entity->getStatut() == "bloquer")
            $entity->setStatut("ouvert");
        $entityManager->persist($entity);
        $entityManager->flush();
	    
        return $this->render('user/project/projects.html.twig', array(
            'projects' => $projects,
            'nbProj' => count($projects)
        ));
    }

    /**
     * @Route("/user/project/allProjects.html.twig", name="allProject_show")
     * 
     */
    public function showProjects()
    {
        $usr = $this->getUser();

        $projects = $this->getDoctrine()
            ->getRepository('App:Project')
	        ->findAll();
  	        
        return $this->render('user/project/allProjects.html.twig', array(
            'projects' => $projects
        ));
    }


    /**
     * @Route("/user/project/{id}/edit", name="project_edit")
     * 
     */
    public function editProject(Request $request, Project $project)
    {
        $entityManager = $this->getDoctrine()->getManager();
        $entity = $entityManager->getRepository('App:Project')->find($project->getId());

        // $formEdit = $this->createDeleteForm($project);
        $editForm = $this->createForm(ProjectType::class, $entity);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            
            $entityManager->persist($entity);
            $entityManager->flush();

            return $this->redirectToRoute('project_show', array('id' => $project->getId()));
        }
        $entityManager->refresh($project);


        return $this->render('user/project/edit.html.twig', array(
            'project' => $entity,
            'edit_form' => $editForm->createView(),
        ));
    }

    /**
     * Deletes a project entity.
     *
     * @Route("/user/project/{id}", name="project_delete")
     */
    public function deleteAction(Request $request, Project $project)
    {
        $em = $this->getDoctrine()->getManager();

	    $sources = $this->getDoctrine()
            ->getRepository('App:Source')
            ->findBy(array('project' => $project->getId()));

        $form = $this->createFormBuilder()
            ->setAction($this->generateUrl('project_delete', array('id' => $project->getId())))
            ->setMethod('DELETE')
            ->getForm();
        $form->handleRequest($request);

        foreach ($sources as $oneSource) {
            $sourcesTrans = $this->getDoctrine()
                ->getRepository('App:SourceTranslated')
                ->findBy(array('source' => $oneSource->getId()));

            foreach ($sourcesTrans as $oneSourceTrans) {
                $em->remove($oneSourceTrans);
            }
            $em->remove($oneSource);
        }

        $em->remove($project);
        $em->flush();

        return $this->redirectToRoute('project_show');
    }
}