<?php

/* comment/index.twig */
class __TwigTemplate_a4b5e2a14239a7fdd1c5de941705a329 extends Twig_Template
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
        echo "<div>
";
        // line 2
        $context['_parent'] = (array) $context;
        $context['_seq'] = twig_ensure_traversable($this->getContext($context, "comments"));
        foreach ($context['_seq'] as $context["_key"] => $context["comment"]) {
            // line 3
            echo "<img align='left' style='padding-right:10px;' src=\"";
            echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute($this->getContext($context, "app"), "gravatar"), "getGravatar", array(0 => $this->getAttribute($this->getContext($context, "comment"), "email"), 1 => 50), "method"), "html", null, true);
            echo "\" alt=\"\">
<div><strong>";
            // line 4
            echo twig_escape_filter($this->env, $this->getAttribute($this->getContext($context, "comment"), "name"), "html", null, true);
            echo "</strong></div>
<div><small>";
            // line 5
            echo twig_escape_filter($this->env, twig_date_format_filter($this->env, $this->getAttribute($this->getAttribute($this->getContext($context, "comment"), "created_at"), "sec"), "r"), "html", null, true);
            echo "</small></div>
<p>";
            // line 6
            echo twig_escape_filter($this->env, $this->getAttribute($this->getContext($context, "comment"), "content"), "html", null, true);
            echo "</p>
<hr>
";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['comment'], $context['_parent'], $context['loop']);
        $context = array_merge($_parent, array_intersect_key($context, $_parent));
        // line 9
        echo "</div>";
    }

    public function getTemplateName()
    {
        return "comment/index.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  46 => 9,  37 => 6,  33 => 5,  24 => 3,  20 => 2,  17 => 1,  110 => 40,  105 => 39,  100 => 35,  97 => 34,  94 => 33,  92 => 32,  86 => 28,  81 => 26,  77 => 23,  74 => 22,  68 => 20,  65 => 19,  62 => 18,  60 => 17,  55 => 15,  50 => 13,  41 => 10,  39 => 9,  29 => 4,  26 => 2,);
    }
}
