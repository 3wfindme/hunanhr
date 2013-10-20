<?php
namespace HR\PositionBundle\Twig\Extension;

class MarkupExtension extends \Twig_Extension
{
    public function getFilters()
    {
        return array(
            'markup' => new \Twig_Filter_Method($this, 'markup', array("is_safe" => array("html"))),
        );
    }

    public function markup($input)
    {
        $input = htmlspecialchars($input);
        $input = preg_replace('/\n?(.+?)(?:\n\s*|\z){2,}/su', "<p>$1</p>", $input);
        $input = nl2br($input);
        $input = str_replace('　', '', $input);

        return $input;
    }

    public function getName()
    {
        return 'markup_extension.markup';
    }
}