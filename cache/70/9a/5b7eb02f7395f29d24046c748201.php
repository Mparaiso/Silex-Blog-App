<?php

/* comment/create.twig */
class __TwigTemplate_709a5b7eb02f7395f29d24046c748201 extends Twig_Template
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
";
        // line 2
        if ($this->getAttribute($this->getAttribute($this->getContext($context, "app"), "session"), "getFlash", array(0 => "comment_errors"), "method")) {
            // line 3
            echo "  <div class=\"alert alert-error\">
  ";
            // line 4
            echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute($this->getContext($context, "app"), "session"), "getFlash", array(0 => "comment_errors"), "method"), "html", null, true);
            echo "
</div>
";
        }
        // line 7
        echo "<form  action=\"";
        echo twig_escape_filter($this->env, $this->env->getExtension('routing')->getPath("comment.create", array("article_id" => $this->getContext($context, "article_id"))), "html", null, true);
        echo " \" method=\"post\">
  <legend>Post an new comment.</legend>
  ";
        // line 9
        echo $this->env->getExtension('form')->renderer->searchAndRenderBlock($this->getContext($context, "form"), 'widget');
        echo "
  <input class=\"btn\" type=\"submit\" name=\"submit\">
</form>
";
    }

    public function getTemplateName()
    {
        return "comment/create.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  37 => 9,  31 => 7,  25 => 4,  22 => 3,  20 => 2,  17 => 1,);
    }
}
