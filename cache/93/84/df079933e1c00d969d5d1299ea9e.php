<?php

/* footer.twig */
class __TwigTemplate_9384df079933e1c00d969d5d1299ea9e extends Twig_Template
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
        echo "
<div class='pager'>
\t<small>
\t\t<!--
      ";
        // line 5
        if (($this->getAttribute($this->getContext($context, "app"), "debug") == true)) {
            // line 6
            echo "              <li>";
            echo twig_escape_filter($this->env, (($this->getAttribute($this->getAttribute($this->getContext($context, "app", true), "user_infos", array(), "any", false, true), "token", array(), "any", true, true)) ? (_twig_default_filter($this->getAttribute($this->getAttribute($this->getContext($context, "app", true), "user_infos", array(), "any", false, true), "token"), "")) : ("")), "html", null, true);
            echo "</li>
              <li>";
            // line 7
            echo twig_escape_filter($this->env, (($this->getAttribute($this->getAttribute($this->getContext($context, "app", true), "user", array(), "any", false, true), "username", array(), "any", true, true)) ? (_twig_default_filter($this->getAttribute($this->getAttribute($this->getContext($context, "app", true), "user", array(), "any", false, true), "username"), "")) : ("")), "html", null, true);
            echo "</li>
      ";
        }
        // line 9
        echo "\t\t-->
\t\t&copy;2012 M.Paraiso. contact mparaiso@online.fr
\t</small>
</div>";
    }

    public function getTemplateName()
    {
        return "footer.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  35 => 9,  30 => 7,  23 => 5,  27 => 3,  74 => 28,  71 => 27,  68 => 25,  53 => 16,  32 => 8,  22 => 2,  37 => 2,  61 => 22,  55 => 17,  49 => 15,  40 => 3,  33 => 6,  24 => 3,  52 => 17,  43 => 12,  39 => 13,  34 => 9,  19 => 2,  29 => 5,  25 => 6,  20 => 2,  17 => 1,  112 => 26,  109 => 25,  106 => 24,  102 => 23,  95 => 21,  92 => 20,  88 => 19,  77 => 33,  73 => 32,  69 => 31,  66 => 24,  60 => 27,  57 => 24,  54 => 18,  51 => 20,  48 => 18,  46 => 13,  38 => 11,  36 => 10,  26 => 4,  21 => 8,  104 => 25,  99 => 22,  85 => 18,  81 => 20,  79 => 34,  76 => 18,  72 => 16,  70 => 15,  67 => 14,  64 => 29,  47 => 15,  44 => 11,  41 => 10,  31 => 3,  28 => 9,);
    }
}
