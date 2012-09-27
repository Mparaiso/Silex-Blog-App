<?php

/* form/register.twig */
class __TwigTemplate_dc774cabd869f21996c7f0bc1d26038a extends Twig_Template
{
    public function __construct(Twig_Environment $env)
    {
        parent::__construct($env);

        $this->parent = false;

        $this->blocks = array(
        );
    }

    protected function doDisplay(array $context, array $blocks = array())
    {
        // line 1
        echo "<form  action=\"";
        echo twig_escape_filter($this->env, $this->getContext($context, "action"), "html", null, true);
        echo "\" method=\"post\">
  <legend>Register</legend>
  ";
        // line 3
        echo $this->env->getExtension('form')->renderer->searchAndRenderBlock($this->getContext($context, "form"), 'widget');
        echo "
  <input class=\"btn\" type=\"submit\" name=\"submit\">
</form>";
    }

    public function getTemplateName()
    {
        return "form/register.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  23 => 3,  17 => 1,  29 => 3,  26 => 2,);
    }
}
