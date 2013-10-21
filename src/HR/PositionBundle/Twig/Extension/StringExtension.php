<?php
namespace HR\PositionBundle\Twig\Extension;

mb_internal_encoding('UTF-8');

class StringExtension extends \Twig_Extension
{
    public function getFilters()
    {
        return array(
            'substring'       => new \Twig_Filter_Method($this, 'substring'),
            'obfuscate_email' => new \Twig_Filter_Method($this, 'obfuscateEmail')
        );
    }

    public function substring($input, $length)
    {
        $len       = mb_strlen($input);
        $substring = mb_substr($input, 0, $length);

        if ($len > $length) {
            $substring .= '...';
        }

        return $substring;
    }

    public function obfuscateEmail($email)
    {
        if (false !== $pos = strpos($email, '@')) {
            $email = '...' . substr($email, $pos);
        }

        return $email;
    }

    public function getName()
    {
        return 'markup_extension.substring';
    }
}