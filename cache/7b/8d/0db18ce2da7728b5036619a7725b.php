<?php

/* main-nav.twig */
class __TwigTemplate_7b8d0db18ce2da7728b5036619a7725b extends Twig_Template
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
        echo "<div class=\"navbar navbar-inverse\"> ";
        // line 2
        echo "  <div class=\"navbar-inner\">
    <div class=\"container\">
      <a class=\"btn btn-navbar\" data-toggle=\"collapse\" data-target=\".nav-collapse\">
        <span class=\"icon-bar\"></span>
        <span class=\"icon-bar\"></span>
        <span class=\"icon-bar\"></span>
      </a>
      <a class=\"brand\" href=\"";
        // line 9
        echo twig_escape_filter($this->env, $this->env->getExtension('routing')->getPath("index.index"), "html", null, true);
        echo "\"><strong>Silex Blog</strong></a>
      <div class=\"nav-collapse collapse\">
        <ul class=\"nav\">
          <li ";
        // line 12
        echo "><a href=\"";
        echo twig_escape_filter($this->env, $this->env->getExtension('routing')->getPath("index.index"), "html", null, true);
        echo "\">Home</a></li>
          <li><a href=\"";
        // line 13
        echo twig_escape_filter($this->env, $this->env->getExtension('routing')->getPath("article.index"), "html", null, true);
        echo "\">Articles</a></li>
          <li><a href=\"";
        // line 14
        echo twig_escape_filter($this->env, $this->env->getExtension('routing')->getPath("index.about"), "html", null, true);
        echo "\">About</a></li>
          <li><a href=\"";
        // line 15
        echo twig_escape_filter($this->env, $this->env->getExtension('routing')->getPath("index.contact"), "html", null, true);
        echo "\">Contact</a></li>
        </ul>
          ";
        // line 17
        $this->env->loadTemplate("user/user-menu.twig")->display($context);
        // line 18
        echo "        </div><!--/.nav-collapse -->
      </div>
    </div>
  </div>";
    }

    public function getTemplateName()
    {
        return "main-nav.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  52 => 17,  43 => 14,  39 => 13,  34 => 12,  19 => 2,  29 => 6,  25 => 5,  20 => 3,  17 => 1,  112 => 26,  109 => 25,  106 => 24,  102 => 23,  95 => 21,  92 => 20,  88 => 19,  77 => 33,  73 => 32,  69 => 31,  66 => 30,  60 => 27,  57 => 24,  54 => 18,  51 => 20,  48 => 18,  46 => 17,  38 => 11,  36 => 10,  26 => 5,  21 => 2,  104 => 25,  99 => 22,  85 => 18,  81 => 20,  79 => 34,  76 => 18,  72 => 16,  70 => 15,  67 => 14,  64 => 29,  47 => 15,  44 => 11,  41 => 10,  31 => 3,  28 => 9,);
    }
}
