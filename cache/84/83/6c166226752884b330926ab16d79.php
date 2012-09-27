<?php

/* layout.twig */
class __TwigTemplate_84836c166226752884b330926ab16d79 extends Twig_Template
{
    public function __construct(Twig_Environment $env)
    {
        parent::__construct($env);

        $this->parent = false;

        $this->blocks = array(
            'herounit' => array($this, 'block_herounit'),
            'left_sidebar' => array($this, 'block_left_sidebar'),
            'content' => array($this, 'block_content'),
            'right_sidebar' => array($this, 'block_right_sidebar'),
        );
    }

    protected function doDisplay(array $context, array $blocks = array())
    {
        // line 2
        echo "<!DOCTYPE HTML>
<html lang=\"en-US\">
<head>
  ";
        // line 5
        $this->env->loadTemplate("head.twig")->display($context);
        // line 6
        echo "  <script type=\"text/javascript\" src=\"";
        echo twig_escape_filter($this->env, $this->env->getExtension('routing')->getUrl("index.index"), "html", null, true);
        echo "vendor/jquery/jquery.js\">
  </script>
</head>
<body>
  ";
        // line 10
        $this->env->loadTemplate("main-nav.twig")->display($context);
        // line 11
        echo "  <div class=\"container\">
    <noscript>
      <div  class='alert-error'>
        <h1>Please enable Javascript to have the best experience with that website. thank you.</h1>
      </div> 
    </noscript>
    ";
        // line 17
        $this->env->loadTemplate("flash-message.twig")->display($context);
        // line 18
        echo "    ";
        $this->displayBlock('herounit', $context, $blocks);
        // line 20
        echo "    ";
        $this->displayBlock('left_sidebar', $context, $blocks);
        // line 22
        echo "    ";
        $this->displayBlock('content', $context, $blocks);
        // line 24
        echo "    ";
        $this->displayBlock('right_sidebar', $context, $blocks);
        // line 27
        echo "  </div>
  <div class='well'>
    ";
        // line 29
        $this->env->loadTemplate("footer.twig")->display($context);
        // line 30
        echo "  </div>
  <script type=\"text/javascript\" src=\"";
        // line 31
        echo twig_escape_filter($this->env, $this->env->getExtension('routing')->getUrl("index.index"), "html", null, true);
        echo "vendor/bootstrap/js/bootstrap.min.js\"></script>
  <link rel=\"stylesheet\" href=\"";
        // line 32
        echo twig_escape_filter($this->env, $this->env->getExtension('routing')->getUrl("index.index"), "html", null, true);
        echo "css/style.css\">
  ";
        // line 33
        $this->env->loadTemplate("analytics.twig")->display($context);
        // line 34
        echo "</body>
</html>
";
    }

    // line 18
    public function block_herounit($context, array $blocks = array())
    {
        // line 19
        echo "    ";
    }

    // line 20
    public function block_left_sidebar($context, array $blocks = array())
    {
        // line 21
        echo "    ";
    }

    // line 22
    public function block_content($context, array $blocks = array())
    {
        // line 23
        echo "    ";
    }

    // line 24
    public function block_right_sidebar($context, array $blocks = array())
    {
        // line 25
        echo "    ";
        $this->env->loadTemplate("sidebar.twig")->display($context);
        // line 26
        echo "    ";
    }

    public function getTemplateName()
    {
        return "layout.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  112 => 26,  109 => 25,  106 => 24,  102 => 23,  95 => 21,  92 => 20,  88 => 19,  77 => 33,  73 => 32,  69 => 31,  66 => 30,  60 => 27,  57 => 24,  54 => 22,  51 => 20,  48 => 18,  46 => 17,  38 => 11,  36 => 10,  26 => 5,  21 => 2,  104 => 25,  99 => 22,  85 => 18,  81 => 20,  79 => 34,  76 => 18,  72 => 16,  70 => 15,  67 => 14,  64 => 29,  47 => 12,  44 => 11,  41 => 10,  31 => 3,  28 => 6,);
    }
}
