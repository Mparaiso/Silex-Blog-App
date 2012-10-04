<?php

/* form/form_div_layout.twig */
class __TwigTemplate_34690bf81cc49acccda6e225782eaaea extends Twig_Template
{
    public function __construct(Twig_Environment $env)
    {
        parent::__construct($env);

        $this->parent = $this->env->loadTemplate("form_div_layout.html.twig");

        $this->blocks = array(
            'image_row' => array($this, 'block_image_row'),
            'captcha_widget' => array($this, 'block_captcha_widget'),
        );
    }

    protected function doGetParent(array $context)
    {
        return "form_div_layout.html.twig";
    }

    protected function doDisplay(array $context, array $blocks = array())
    {
        $this->parent->display($context, array_merge($this->blocks, $blocks));
    }

    // line 4
    public function block_image_row($context, array $blocks = array())
    {
        // line 5
        ob_start();
        // line 6
        echo "<div>
  ";
        // line 7
        $context["baseurl"] = _twig_default_filter($this->env->getExtension('routing')->getUrl("index.index"), "/");
        // line 8
        echo "  ";
        if (isset($context["type"])) { $_type_ = $context["type"]; } else { $_type_ = null; }
        $context["type"] = ((array_key_exists("type", $context)) ? (_twig_default_filter($_type_, "image")) : ("image"));
        // line 9
        echo "  <input type=\"";
        if (isset($context["type"])) { $_type_ = $context["type"]; } else { $_type_ = null; }
        echo twig_escape_filter($this->env, $_type_, "html", null, true);
        echo "\"  ";
        $this->displayBlock("widget_attributes", $context, $blocks);
        echo " 
      ";
        // line 10
        if (isset($context["value"])) { $_value_ = $context["value"]; } else { $_value_ = null; }
        if ((!twig_test_empty($_value_))) {
            // line 11
            echo "        value=\"";
            if (isset($context["value"])) { $_value_ = $context["value"]; } else { $_value_ = null; }
            echo twig_escape_filter($this->env, $_value_, "html", null, true);
            echo "\" 
      ";
        }
        // line 12
        echo " 
  src='";
        // line 13
        if (isset($context["baseurl"])) { $_baseurl_ = $context["baseurl"]; } else { $_baseurl_ = null; }
        echo twig_escape_filter($this->env, $_baseurl_, "html", null, true);
        if (isset($context["attr"])) { $_attr_ = $context["attr"]; } else { $_attr_ = null; }
        echo twig_escape_filter($this->env, $this->getAttribute($_attr_, "src"), "html", null, true);
        echo "' />
</div>
";
        echo trim(preg_replace('/>\s+</', '><', ob_get_clean()));
    }

    // line 17
    public function block_captcha_widget($context, array $blocks = array())
    {
        // line 18
        ob_start();
        // line 19
        echo "    ";
        if (isset($context["compound"])) { $_compound_ = $context["compound"]; } else { $_compound_ = null; }
        if ($_compound_) {
            // line 20
            echo "        ";
            $this->displayBlock("form_widget_compound", $context, $blocks);
            echo "
    ";
        } else {
            // line 22
            echo "        ";
            $this->displayBlock("form_widget_simple", $context, $blocks);
            echo "
    ";
        }
        echo trim(preg_replace('/>\s+</', '><', ob_get_clean()));
    }

    public function getTemplateName()
    {
        return "form/form_div_layout.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  88 => 22,  82 => 20,  78 => 19,  76 => 18,  73 => 17,  62 => 13,  59 => 12,  52 => 11,  49 => 10,  41 => 9,  37 => 8,  35 => 7,  32 => 6,  30 => 5,  27 => 4,);
    }
}
