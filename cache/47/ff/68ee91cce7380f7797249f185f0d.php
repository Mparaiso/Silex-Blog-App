<?php

/* article/tags/index.twig */
class __TwigTemplate_47ff68ee91cce7380f7797249f185f0d extends Twig_Template
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
        echo "\t";
        $context['_parent'] = (array) $context;
        $context['_seq'] = twig_ensure_traversable($this->getContext($context, "tags"));
        foreach ($context['_seq'] as $context["_key"] => $context["tag"]) {
            // line 2
            echo "\t<a class='btn btn-mini' href=\"";
            echo twig_escape_filter($this->env, $this->env->getExtension('routing')->getPath("article.getbytag", array("tag" => twig_urlencode_filter(twig_lower_filter($this->env, trim($this->getContext($context, "tag")))))), "html", null, true);
            echo "\">
\t\t<span class='muted'>";
            // line 3
            echo twig_escape_filter($this->env, $this->getContext($context, "tag"), "html", null, true);
            echo "</span>
\t</a>
\t";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['tag'], $context['_parent'], $context['loop']);
        $context = array_merge($_parent, array_intersect_key($context, $_parent));
    }

    public function getTemplateName()
    {
        return "article/tags/index.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  27 => 3,  74 => 28,  71 => 27,  68 => 25,  53 => 16,  32 => 8,  22 => 2,  37 => 2,  61 => 22,  55 => 17,  49 => 15,  40 => 3,  33 => 6,  24 => 3,  52 => 17,  43 => 12,  39 => 13,  34 => 9,  19 => 2,  29 => 5,  25 => 1,  20 => 2,  17 => 1,  112 => 26,  109 => 25,  106 => 24,  102 => 23,  95 => 21,  92 => 20,  88 => 19,  77 => 33,  73 => 32,  69 => 31,  66 => 24,  60 => 27,  57 => 24,  54 => 18,  51 => 20,  48 => 18,  46 => 13,  38 => 11,  36 => 10,  26 => 4,  21 => 8,  104 => 25,  99 => 22,  85 => 18,  81 => 20,  79 => 34,  76 => 18,  72 => 16,  70 => 15,  67 => 14,  64 => 29,  47 => 15,  44 => 11,  41 => 10,  31 => 3,  28 => 9,);
    }
}
