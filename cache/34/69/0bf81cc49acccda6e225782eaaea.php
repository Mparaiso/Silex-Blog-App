<?php

/* form/form_div_layout.twig */
class __TwigTemplate_34690bf81cc49acccda6e225782eaaea extends Twig_Template
{
    public function __construct(Twig_Environment $env)
    {
        parent::__construct($env);

        $this->parent = false;

        $this->blocks = array(
            'image_widget' => array($this, 'block_image_widget'),
        );
    }

    protected function doDisplay(array $context, array $blocks = array())
    {
        // line 1
        $this->displayBlock('image_widget', $context, $blocks);
    }

    public function block_image_widget($context, array $blocks = array())
    {
        // line 2
        ob_start();
        // line 3
        echo "this is an image
<!-- ";
        // line 4
        $this->displayBlock("widget_container_attributes", $context, $blocks);
        echo " -->
";
        // line 5
        $this->displayBlock("field_widget", $context, $blocks);
        echo "
";
        echo trim(preg_replace('/>\s+</', '><', ob_get_clean()));
    }

    public function getTemplateName()
    {
        return "form/form_div_layout.twig";
    }

    public function getDebugInfo()
    {
        return array (  33 => 5,  29 => 4,  26 => 3,  24 => 2,  18 => 1,);
    }
}
