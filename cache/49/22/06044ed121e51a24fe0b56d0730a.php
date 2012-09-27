<?php

/* user/user-menu.twig */
class __TwigTemplate_492206044ed121e51a24fe0b56d0730a extends Twig_Template
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
        echo "<ul class=\"nav pull-right\">
\t";
        // line 2
        if ($this->getAttribute($this->getAttribute($this->getContext($context, "app"), "user_manager"), "isLoggedIn", array(), "method")) {
            echo " 
\t";
            // line 3
            $context["local_user"] = $this->getAttribute($this->getAttribute($this->getContext($context, "app"), "user_manager"), "getUser", array(), "method");
            // line 4
            echo "\t<li>
\t\t<a href='";
            // line 5
            echo twig_escape_filter($this->env, $this->env->getExtension('routing')->getPath("admin.user.profile"), "html", null, true);
            echo "' >
\t\t\tWelcome back ";
            // line 6
            echo twig_escape_filter($this->env, twig_capitalize_string_filter($this->env, $this->getAttribute($this->getContext($context, "local_user"), "username")), "html", null, true);
            echo ".
\t\t</a>
\t</li>
\t<li>
\t\t<a  href=\"";
            // line 10
            echo twig_escape_filter($this->env, $this->env->getExtension('routing')->getPath("admin_user_logout"), "html", null, true);
            echo "\">Logout</a>
\t</li>
\t";
        } else {
            // line 13
            echo "\t<li>
\t\t<a  href=\"";
            // line 14
            echo twig_escape_filter($this->env, $this->env->getExtension('routing')->getPath("user.login"), "html", null, true);
            echo "\">Login</a>
\t</li>
\t<li>
\t\t<a  href=\"";
            // line 17
            echo twig_escape_filter($this->env, $this->env->getExtension('routing')->getPath("user.signup"), "html", null, true);
            echo "\">SignUp</a>
\t</li>
\t";
        }
        // line 20
        echo "</ul>";
    }

    public function getTemplateName()
    {
        return "user/user-menu.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  61 => 20,  55 => 17,  49 => 14,  40 => 10,  33 => 6,  24 => 3,  52 => 17,  43 => 14,  39 => 13,  34 => 12,  19 => 2,  29 => 5,  25 => 5,  20 => 2,  17 => 1,  112 => 26,  109 => 25,  106 => 24,  102 => 23,  95 => 21,  92 => 20,  88 => 19,  77 => 33,  73 => 32,  69 => 31,  66 => 30,  60 => 27,  57 => 24,  54 => 18,  51 => 20,  48 => 18,  46 => 13,  38 => 11,  36 => 10,  26 => 4,  21 => 2,  104 => 25,  99 => 22,  85 => 18,  81 => 20,  79 => 34,  76 => 18,  72 => 16,  70 => 15,  67 => 14,  64 => 29,  47 => 15,  44 => 11,  41 => 10,  31 => 3,  28 => 9,);
    }
}
