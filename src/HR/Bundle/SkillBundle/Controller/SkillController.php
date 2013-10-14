<?php
namespace HR\Bundle\SkillBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Security\Core\Exception\AccessDeniedException;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;

/**
 * @author Wenming Tang <tang@babyfamily.com>
 */
class SkillController extends Controller
{
    /**
     * @Template()
     */
    public function indexAction(Request $request)
    {
        if (null == $user = $this->getUser()) {
            throw new AccessDeniedException();
        }

        $this->get('breadcrumb')->add('技能信息');

        /** @var \HR\Bundle\SkillBundle\EntityManager\SkillManager $skillManager */
        $skillManager = $this->get('skill.manager');
        $skills       = $skillManager->findSkillsByUser($user);

        // new skill
        $skill = $skillManager->createSkill($user);

        /** @var \Symfony\Component\Form\FormInterface $form */
        $form = $this->get('skill.form');
        $form->setData($skill);

        $form->handleRequest($request);

        if ($form->isValid()) {
            $skillManager->updateSkill($skill);

            $this->get('session')->getFlashBag()->add('success', '技能信息已保存');

            return $this->redirect($this->generateUrl('skill_list'));
        }

        return array(
            'skills' => $skills,
            'form'   => $form->createView()
        );
    }

    /**
     * @Template()
     */
    public function editAction(Request $request, $skillId)
    {
        if (null == $user = $this->getUser()) {
            throw new AccessDeniedException();
        }

        $this->get('breadcrumb')->add('技能信息', $this->generateUrl('skill_list'))->add('编辑技能信息');

        /** @var \HR\Bundle\SkillBundle\EntityManager\SkillManager $skillManager */
        $skillManager = $this->get('skill.manager');
        $skill        = $skillManager->findSkillById($skillId);

        if (null == $skill || !$user->equals($skill->getUser())) {
            throw $this->createNotFoundException();
        }

        /** @var \Symfony\Component\Form\FormInterface $form */
        $form = $this->get('skill.form');
        $form->setData($skill);

        $form->handleRequest($request);

        if ($form->isValid()) {
            $skillManager->updateSkill($skill);

            $this->get('session')->getFlashBag()->add('success', '技能信息已更新');

            return $this->redirect($this->generateUrl('skill_list'));
        }

        return array(
            'form'  => $form->createView(),
            'skill' => $skill
        );
    }

    public function deleteAction($skillId)
    {
        if (null == $user = $this->getUser()) {
            throw new AccessDeniedException();
        }

        /** @var \HR\Bundle\SkillBundle\EntityManager\SkillManager $skillManager */
        $skillManager = $this->get('skill.manager');
        $skill        = $skillManager->findSkillById($skillId);

        if (null == $skill || !$user->equals($skill->getUser())) {
            throw $this->createNotFoundException();
        }

        $skillManager->deleteSkill($skill);

        $this->get('session')->getFlashBag()->add('success', '技能信息已删除');

        return $this->redirect($this->generateUrl('skill_list'));
    }
}