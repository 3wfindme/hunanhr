<?php
namespace HR\Bundle\UserBundle\Controller;

use HR\Bundle\UserBundle\Event\FilterUserResponseEvent;
use HR\Bundle\UserBundle\UserEvents;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Security\Core\Exception\AccessDeniedException;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;

/**
 * @author Wenming Tang <tang@babyfamily.com>
 */
class ChangePasswordController extends Controller
{
    /**
     * @Template()
     */
    public function editAction(Request $request)
    {
        if (null == $user = $this->getUser()) {
            throw new AccessDeniedException();
        }

        $this->get('breadcrumb')->add('设置', $this->generateUrl('profile_edit'))->add('修改密码');

        /** @var \HR\Bundle\UserBundle\EntityManager\UserManager $userManager */
        $userManager = $this->get('user.user_manager');

        /** @var $dispatcher \Symfony\Component\EventDispatcher\EventDispatcherInterface */
        $dispatcher = $this->container->get('event_dispatcher');

        /** @var \Symfony\Component\Form\FormInterface $form */
        $form = $this->get('user.form.change_password');

        $form->setData($user);

        $form->handleRequest($request);

        if ($form->isValid()) {
            $userManager->updateUser($user);

            $this->get('session')->getFlashBag()->add('success', '密码已更新');

            $response = $this->redirect($this->generateUrl('change_password'));

            $dispatcher->dispatch(UserEvents::CHANGE_PASSWORD_COMPLETED, new FilterUserResponseEvent($user, $request, $response));

            return $response;
        }

        return array(
            'form' => $form->createView()
        );
    }
}