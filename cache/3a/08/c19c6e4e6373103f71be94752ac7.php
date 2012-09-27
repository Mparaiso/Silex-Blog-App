<?php

/* article/get.twig */
class __TwigTemplate_3a08c19c6e4e6373103f71be94752ac7 extends Twig_Template
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
        echo "<h2>";
        echo twig_escape_filter($this->env, $this->getAttribute($this->getContext($context, "article"), "title"), "html", null, true);
        echo "</h2>

<h1>&nbsp;</h1>
<p class=\"author\">
  <i class=\"icon-user\"></i>
  <small>
    ";
        // line 9
        $context["username"] = $this->getAttribute($this->getAttribute($this->getAttribute($this->getContext($context, "app"), "user_manager"), "getById", array(0 => $this->getAttribute($this->getContext($context, "article"), "user_id")), "method"), "username");
        // line 10
        echo "    <a href=\"";
        echo twig_escape_filter($this->env, $this->env->getExtension('routing')->getPath("article.getbyusername", array("username" => $this->getContext($context, "username"))), "html", null, true);
        echo "\">";
        echo twig_escape_filter($this->env, $this->getContext($context, "username"), "html", null, true);
        echo "</a>
    |
    <i class=\"icon-calendar\"></i>
    ";
        // line 13
        echo twig_escape_filter($this->env, twig_date_format_filter($this->env, $this->getAttribute($this->getAttribute($this->getContext($context, "article"), "created_at"), "sec"), "m/d/Y"), "html", null, true);
        echo "
    |
    <i class=\"icon-comment\"></i><a href='#comments'>";
        // line 15
        echo twig_escape_filter($this->env, twig_length_filter($this->env, $this->getAttribute($this->getAttribute($this->getContext($context, "app"), "comment_manager", array(), "array"), "getCommentsByArticleId", array(0 => $this->getAttribute($this->getContext($context, "article"), "_id")), "method")), "html", null, true);
        echo " Comments</a></small>
  </p>
  ";
        // line 17
        if ($this->env->getExtension('security')->isGranted("IS_AUTHENTICATED_FULLY")) {
            // line 18
            echo "  ";
            $context["user"] = $this->getAttribute($this->getAttribute($this->getContext($context, "app"), "user_manager", array(), "array"), "getUser", array(), "method");
            // line 19
            echo "  ";
            if ($this->getAttribute($this->getAttribute($this->getContext($context, "app"), "article_manager", array(), "array"), "belongsTo", array(0 => $this->getAttribute($this->getContext($context, "article"), "_id"), 1 => $this->getAttribute($this->getContext($context, "user"), "_id")), "method")) {
                // line 20
                echo "  <a class='btn btn-small' href=\"";
                echo twig_escape_filter($this->env, $this->env->getExtension('routing')->getPath("admin.article.edit", array("id" => $this->getAttribute($this->getContext($context, "article"), "_id"))), "html", null, true);
                echo "\">Edit</a>
  ";
            }
            // line 22
            echo "  ";
        }
        // line 23
        echo "  <div class=\"row-fluid\">
    <div class=\"span8\">
      ";
        // line 26
        echo "      ";
        echo strip_tags($this->getAttribute($this->getContext($context, "article"), "content"), $this->getAttribute($this->getContext($context, "app"), "silexblog.config.allowedTags", array(), "array"));
        echo "
      ";
        // line 28
        echo "    </div>
  </div>
  <hr/>
  <div class='row-fluid'>
    ";
        // line 32
        if ($this->getAttribute($this->getContext($context, "article"), "tags")) {
            // line 33
            echo "    ";
            $this->env->loadTemplate("article/tags/index.twig")->display(array("tags" => $this->getAttribute($this->getContext($context, "article"), "tags")));
            // line 34
            echo "    ";
        }
        // line 35
        echo "  </div>
  <hr/>
  <a name='comments'></a>
  ";
        // line 39
        echo "  <div>";
        echo $this->env->getExtension('silex')->render($this->env, $this->env->getExtension('routing')->getPath("comment.index", array("article_id" => $this->getAttribute($this->getContext($context, "article"), "_id"))));
        echo "</div>
  <div>";
        // line 40
        echo $this->env->getExtension('silex')->render($this->env, $this->env->getExtension('routing')->getPath("comment.create", array("article_id" => $this->getAttribute($this->getContext($context, "article"), "_id"))));
        echo "</div>
  ";
    }

    public function getTemplateName()
    {
        return "article/get.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  110 => 40,  105 => 39,  100 => 35,  97 => 34,  94 => 33,  92 => 32,  86 => 28,  81 => 26,  77 => 23,  74 => 22,  68 => 20,  65 => 19,  62 => 18,  60 => 17,  55 => 15,  50 => 13,  41 => 10,  39 => 9,  29 => 3,  26 => 2,);
    }
}
