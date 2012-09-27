<?php

/* article/preview.twig */
class __TwigTemplate_c8f2cbeec78bfda9519126fef7f225a6 extends Twig_Template
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
        $context["articleUrl"] = $this->env->getExtension('routing')->getPath("article.get", array("slug" => $this->getAttribute($this->getContext($context, "article"), "slug")));
        // line 2
        echo "<h3>
\t<a style='color:#000;' href='";
        // line 3
        echo twig_escape_filter($this->env, $this->env->getExtension('routing')->getPath("article.get", array("slug" => $this->getAttribute($this->getContext($context, "article"), "slug"))), "html", null, true);
        echo "'>";
        echo twig_escape_filter($this->env, $this->getAttribute($this->getContext($context, "article"), "title"), "html", null, true);
        echo "</a> 
</h3>
<p class=\"author\">
  <small>
    <i class=\"icon-user\"></i>
    ";
        // line 8
        $context["username"] = $this->getAttribute($this->getAttribute($this->getAttribute($this->getContext($context, "app"), "user_manager"), "getById", array(0 => $this->getAttribute($this->getContext($context, "article"), "user_id")), "method"), "username");
        // line 9
        echo "    <a href=\"";
        echo twig_escape_filter($this->env, $this->env->getExtension('routing')->getPath("article.getbyusername", array("username" => $this->getContext($context, "username"))), "html", null, true);
        echo "\">";
        echo twig_escape_filter($this->env, $this->getContext($context, "username"), "html", null, true);
        echo "</a>
    |
    <i class=\"icon-calendar\"></i>
    ";
        // line 12
        echo twig_escape_filter($this->env, twig_date_format_filter($this->env, $this->getAttribute($this->getAttribute($this->getContext($context, "article"), "created_at"), "sec"), "m/d/Y"), "html", null, true);
        echo "
    |
    <i class='icon-comment'></i>
    <a href=\"";
        // line 15
        echo twig_escape_filter($this->env, $this->getContext($context, "articleUrl"), "html", null, true);
        echo "#comments\">
      ";
        // line 16
        echo twig_escape_filter($this->env, twig_length_filter($this->env, $this->getAttribute($this->getAttribute($this->getContext($context, "app"), "comment_manager", array(), "array"), "getCommentsByArticleId", array(0 => $this->getAttribute($this->getContext($context, "article"), "_id")), "method")), "html", null, true);
        echo "
      Comments
    </a>
  </small>
</p>
";
        // line 22
        echo "<p>";
        echo twig_slice($this->env, strip_tags($this->getAttribute($this->getContext($context, "article"), "content"), "<a>,<b>,<u>,<small>,<strong>"), 0, 300);
        echo "...</p>
";
        // line 24
        if (twig_test_iterable($this->getAttribute($this->getContext($context, "article"), "tags"))) {
            // line 25
            $this->env->loadTemplate("article/tags/index.twig")->display(array("tags" => $this->getAttribute($this->getContext($context, "article"), "tags")));
        }
        // line 27
        echo "</p>
<p><a href='";
        // line 28
        echo twig_escape_filter($this->env, $this->getContext($context, "articleUrl"), "html", null, true);
        echo "' class=\"btn btn-info\">Read more</a></p>
<hr>";
    }

    public function getTemplateName()
    {
        return "article/preview.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  74 => 28,  71 => 27,  68 => 25,  53 => 16,  32 => 8,  22 => 3,  37 => 2,  61 => 22,  55 => 17,  49 => 15,  40 => 3,  33 => 6,  24 => 3,  52 => 17,  43 => 12,  39 => 13,  34 => 9,  19 => 2,  29 => 5,  25 => 1,  20 => 2,  17 => 1,  112 => 26,  109 => 25,  106 => 24,  102 => 23,  95 => 21,  92 => 20,  88 => 19,  77 => 33,  73 => 32,  69 => 31,  66 => 24,  60 => 27,  57 => 24,  54 => 18,  51 => 20,  48 => 18,  46 => 13,  38 => 11,  36 => 10,  26 => 4,  21 => 8,  104 => 25,  99 => 22,  85 => 18,  81 => 20,  79 => 34,  76 => 18,  72 => 16,  70 => 15,  67 => 14,  64 => 29,  47 => 15,  44 => 11,  41 => 10,  31 => 3,  28 => 9,);
    }
}
