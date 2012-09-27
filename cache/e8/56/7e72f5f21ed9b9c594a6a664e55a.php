<?php

/* index/index.twig */
class __TwigTemplate_e8567e72f5f21ed9b9c594a6a664e55a extends Twig_Template
{
    public function __construct(Twig_Environment $env)
    {
        parent::__construct($env);

        $this->parent = $this->env->loadTemplate("layout.twig");

        $this->blocks = array(
            'herounit' => array($this, 'block_herounit'),
            'content' => array($this, 'block_content'),
            'sidebar' => array($this, 'block_sidebar'),
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
    public function block_herounit($context, array $blocks = array())
    {
        // line 3
        echo "\t<div class='hero-unit'><div class=\"page-header\"><h1>Welcome to Silex blog</h1>
\t<div>A show case app powered by PHP , Silex , Symfony , MongoDB and Twitter Bootstrap</div>
\t<div>Please register and write articles about anything you like</div>
\t<div> <a href=\"https://github.com/Mparaiso/Silex-Blog-App\">Get the source here.</a> </div>
\t<div><small>Design : M.Paraiso</small> </div>
\t</div></div>
";
    }

    // line 10
    public function block_content($context, array $blocks = array())
    {
        // line 11
        echo "\t<div class='row'>
\t";
        // line 12
        $context['_parent'] = (array) $context;
        $context['_seq'] = twig_ensure_traversable($this->getContext($context, "articles"));
        $context['loop'] = array(
          'parent' => $context['_parent'],
          'index0' => 0,
          'index'  => 1,
          'first'  => true,
        );
        if (is_array($context['_seq']) || (is_object($context['_seq']) && $context['_seq'] instanceof Countable)) {
            $length = count($context['_seq']);
            $context['loop']['revindex0'] = $length - 1;
            $context['loop']['revindex'] = $length;
            $context['loop']['length'] = $length;
            $context['loop']['last'] = 1 === $length;
        }
        foreach ($context['_seq'] as $context["_key"] => $context["article"]) {
            // line 13
            echo "\t\t";
            if (($this->getAttribute($this->getContext($context, "loop"), "index") < 4)) {
                // line 14
                echo "\t\t<div class=\"span4\">
\t\t\t";
                // line 15
                $this->env->loadTemplate("article/preview.twig")->display(array("article" => $this->getContext($context, "article")));
                // line 16
                echo "\t\t</div>
\t\t";
            } else {
                // line 18
                echo "\t\t<div class='span12'>
\t\t\t";
                // line 19
                $this->env->loadTemplate("article/preview.twig")->display(array("article" => $this->getContext($context, "article")));
                // line 20
                echo "\t\t</div>
\t\t";
            }
            // line 22
            echo "\t";
            ++$context['loop']['index0'];
            ++$context['loop']['index'];
            $context['loop']['first'] = false;
            if (isset($context['loop']['length'])) {
                --$context['loop']['revindex0'];
                --$context['loop']['revindex'];
                $context['loop']['last'] = 0 === $context['loop']['revindex0'];
            }
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['article'], $context['_parent'], $context['loop']);
        $context = array_merge($_parent, array_intersect_key($context, $_parent));
        // line 23
        echo "\t</div>
";
    }

    // line 25
    public function block_sidebar($context, array $blocks = array())
    {
    }

    public function getTemplateName()
    {
        return "index/index.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  104 => 25,  99 => 23,  85 => 22,  81 => 20,  79 => 19,  76 => 18,  72 => 16,  70 => 15,  67 => 14,  64 => 13,  47 => 12,  44 => 11,  41 => 10,  31 => 3,  28 => 2,);
    }
}
