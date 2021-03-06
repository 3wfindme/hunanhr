<?php

namespace HR\PositionBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class ApplicationFormType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array                $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('title', null, array(
                'label' => '邮件标题',
                'attr'  => array(
                    'size' => 50
                )
            ))
            ->add('body', null, array(
                'label' => '邮件内容',
                'attr'  => array(
                    'rows' => 5,
                    'cols' => 60
                )
            ))
            ->add('save', 'submit', array(
                'label' => '发送简历'
            ));
    }

    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'HR\PositionBundle\Entity\Application'
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'application';
    }
}
