<?php

/* user/register.twig */
class __TwigTemplate_9f13cee9076b54e4e2ec5ac2af542b02 extends Twig_Template
{
    public function __construct(Twig_Environment $env)
    {
        parent::__construct($env);

        $this->parent = $this->env->loadTemplate("layout.twig");

        $this->blocks = array(
            'content' => array($this, 'block_content'),
        );
    }

    protected function doGetParent(array $context)
    {
        return "layout.twig";
    }

    protected function doDisplay(array $context, array $blocks = array())
    {
        $this->parent->display($context, array_merge($this->blocks, $blocks));
    }

    // line 2
    public function block_content($context, array $blocks = array())
    {
        // line 3
        $this->env->loadTemplate("form/register.twig")->display(array("form" => $this->getContext($context, "registrationForm"), "action" => $this->env->getExtension('routing')->getPath("user.dosignup")));
    }

    public function getTemplateName()
    {
        return "user/register.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  29 => 3,  26 => 2,);
    }
}
