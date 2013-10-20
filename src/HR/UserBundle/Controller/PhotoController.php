<?php
namespace HR\UserBundle\Controller;

use HR\UserBundle\FormModel\Photo;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Security\Core\Exception\AccessDeniedException;

/**
 * @author Wenming Tang <tang@babyfamily.com>
 */
class PhotoController extends Controller
{
    public function uploadAction(Request $request)
    {
        if (null == $user = $this->getUser()) {
            throw new AccessDeniedException();
        }

        $this->get('breadcrumb')->add('基本资料', $this->generateUrl('profile_edit'))->add('上传头像');

        /** @var \Symfony\Component\Form\FormInterface $form */
        $form = $this->get('user.form.photo');

        /** @var \HR\UserBundle\EntityManager\UserManager $userManager */
        $userManager = $this->get('user.user_manager');

        $photo = new Photo();
        $photo->setUser($user);

        $form->setData($photo);

        $form->handleRequest($request);

        if ($form->isValid()) {
            if ($photo->handleFile()) {
                $user->setAvatarBigUrl($photo->getAvatarBigUrl());
                $user->setAvatarSmallUrl($photo->getAvatarSmallUrl());

                $userManager->updateUser($user);

                return $this->redirect($this->generateUrl('profile_edit'));
            }
        }

        return $this->render('HRUserBundle:Photo:upload.html.twig', array(
            'form' => $form->createView()
        ));
    }
}