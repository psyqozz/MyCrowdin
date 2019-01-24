<?php

namespace App\Controller;

use App\Entity\User;
use App\Entity\Langage;
use App\Entity\Translater;
use App\Entity\Project;
use App\Entity\SourceTranslated;
use App\Form\UserConfigType;
use App\Form\ResetPasswordType;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Form\FormError;

class UserController extends Controller
{
    /**
     * @Route("/user/config_user", name="user_config")
     */
    public function editUser(Request $request)
    {
        $entityManager = $this->getDoctrine()->getManager();

        $user = $this->getUser();
        $listLangage = $user->getLangages();
        $roles = $user->getRoles();

        $entity = $entityManager->getRepository('App:User')->find($user->getId());

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find User entity.');
        }

        $form = $this->createForm(UserConfigType::class, $entity);
        
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {

            $nbLang = count($listLangage);
            if ($nbLang > 1 && !$this->isGranted('ROLE_TRAD')) {
                $roles[] = 'ROLE_TRAD';
                $user->setRoles($roles);
            } else {
                if($this->isGranted('ROLE_TRAD') && $nbLang <= 1) {
                    unset($roles[1]);
                    $user->setRoles($roles);
                }
            }
            $entityManager->persist($entity);
            $entityManager->flush();

            return $this->redirectToRoute('user_show');
        }
        $entityManager->refresh($user);

        return $this->render(
            'user/config_user/index.html.twig', array(
            'entity' => $entity,
            'form' => $form->createView())
        );
    }

    /**
     * @Route("/user/profil/profil.html.twig", name="user_show")
     * 
     */
    public function showUser()
    {
        $user = $this->getUser();
        $roles = $user->getRoles();
        $date = null;
        
        $entityManager = $this->getDoctrine()->getManager();

        $sources_translated = $entityManager->getRepository('App:SourceTranslated')->findBy(array('user' => $user));
	
     	$projectName = $entityManager->getRepository(Project::class)
		    ->findBynameProject($user->getId());
		     
        $nbTranslate = count($sources_translated);
        if ($sources_translated) {
            foreach ($sources_translated as $oneSource)
            {
                $date[] = $oneSource->getDate()->format('Y-m-d');
            }
            $date = join($date, ',');
        }
	
        return $this->render('user/profil/profil.html.twig', array(
            'user' => $user,
            'nbTranslate' => $nbTranslate,
            'project' => $projectName,
            'date' => $date
        ));
    }
    
    /**
     * @Route("/user/config_user/resetPassword.html.twig", name="user_resetPassword")
     */
    public function resetPassword(Request $request)
    {
    	$em = $this->getDoctrine()->getManager();
        $user = $this->getUser();
    	$form = $this->createForm(ResetPasswordType::class, $user);

    	$form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {

            $passwordEncoder = $this->get('security.password_encoder');
            $oldPassword = $request->request->get('reset_password')['oldPassword'];

            // Si l'ancien mot de passe est bon
            if ($passwordEncoder->isPasswordValid($user, $oldPassword)) {
                $newEncodedPassword = $passwordEncoder->encodePassword($user, $user->getPlainPassword());
                $user->setPassword($newEncodedPassword);
                
                $em->persist($user);
                $em->flush();

                $this->addFlash('notice', 'Votre mot de passe à bien été changé !');

                return $this->redirectToRoute('user_show');
            } else {
                $form->addError(new FormError('Ancien mot de passe incorrect'));
            }
        }
    	
    	return $this->render('/user/config_user/resetPassword.html.twig', array(
    		'form' => $form->createView(),
    	));
    }

}
