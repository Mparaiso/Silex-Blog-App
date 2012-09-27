<?php

/* flash-message.twig */
class __TwigTemplate_97ee6283359c753b066baa851f16940b extends Twig_Template
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
        // line 7
        echo $this->getAttribute($this, "display_alert", array(0 => "error", 1 => $this->getAttribute($this->getAttribute($this->getContext($context, "app"), "session"), "getFlash", array(0 => "error"), "method")), "method");
        echo "
";
        // line 8
        echo $this->getAttribute($this, "display_alert", array(0 => "success", 1 => $this->getAttribute($this->getAttribute($this->getContext($context, "app"), "session"), "flash", array(0 => "success"), "method")), "method");
    }

    // line 1
    public function getdisplay_alert($_class = null, $message = null)
    {
        $context = $this->env->mergeGlobals(array(
            "_class" => $_class,
            "message" => $message,
        ));

        $blocks = array();

        ob_start();
        try {
            // line 2
            echo "  ";
            if ($this->getContext($context, "message")) {
                // line 3
                echo "      <div class='alert alert-";
                echo twig_escape_filter($this->env, ((array_key_exists("_class", $context)) ? (_twig_default_filter($this->getContext($context, "_class"), "error")) : ("error")), "html", null, true);
                echo "'><a class='close' data-dismiss='alert'>x</a>";
                echo twig_escape_filter($this->env, $this->getContext($context, "message"), "html", null, true);
                echo "</div>
  ";
            }
        } catch(Exception $e) {
            ob_end_clean();

            throw $e;
        }

        return ob_get_clean();
    }

    public function getTemplateName()
    {
        return "flash-message.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  37 => 2,  61 => 20,  55 => 17,  49 => 14,  40 => 3,  33 => 6,  24 => 3,  52 => 17,  43 => 14,  39 => 13,  34 => 12,  19 => 2,  29 => 5,  25 => 1,  20 => 2,  17 => 7,  112 => 26,  109 => 25,  106 => 24,  102 => 23,  95 => 21,  92 => 20,  88 => 19,  77 => 33,  73 => 32,  69 => 31,  66 => 30,  60 => 27,  57 => 24,  54 => 18,  51 => 20,  48 => 18,  46 => 13,  38 => 11,  36 => 10,  26 => 4,  21 => 8,  104 => 25,  99 => 22,  85 => 18,  81 => 20,  79 => 34,  76 => 18,  72 => 16,  70 => 15,  67 => 14,  64 => 29,  47 => 15,  44 => 11,  41 => 10,  31 => 3,  28 => 9,);
    }
}
