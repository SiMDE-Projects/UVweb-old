<?php

/* TwigBundle:Exception:error.html.twig */
class __TwigTemplate_fd17415ef5c992de3470a5b9deb30639 extends Twig_Template
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
        echo "<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv=\"Content-Type\" content=\"text/html; charset=utf-8\" />
        <title>An Error Occurred: ";
        // line 5
        echo twig_escape_filter($this->env, (isset($context["status_text"]) ? $context["status_text"] : $this->getContext($context, "status_text")), "html", null, true);
        echo "</title>
    </head>
    <body>
        <h1>Oops! An Error Occurred</h1>
        <h2>The server returned a \"";
        // line 9
        echo twig_escape_filter($this->env, (isset($context["status_code"]) ? $context["status_code"] : $this->getContext($context, "status_code")), "html", null, true);
        echo " ";
        echo twig_escape_filter($this->env, (isset($context["status_text"]) ? $context["status_text"] : $this->getContext($context, "status_text")), "html", null, true);
        echo "\".</h2>

        <div>
            Something is broken. Please e-mail us at [email] and let us know
            what you were doing when this error occurred. We will fix it as soon
            as possible. Sorry for any inconvenience caused.
        </div>
    </body>
</html>
";
    }

    public function getTemplateName()
    {
        return "TwigBundle:Exception:error.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  25 => 5,  19 => 1,  79 => 21,  72 => 13,  69 => 12,  47 => 18,  40 => 11,  37 => 10,  22 => 2,  246 => 32,  157 => 56,  145 => 46,  139 => 45,  131 => 42,  123 => 41,  120 => 40,  115 => 39,  111 => 38,  108 => 37,  101 => 33,  98 => 32,  96 => 31,  83 => 25,  74 => 14,  66 => 11,  55 => 16,  52 => 21,  50 => 14,  43 => 9,  41 => 8,  35 => 9,  32 => 9,  29 => 6,  209 => 82,  203 => 78,  199 => 76,  193 => 73,  189 => 71,  187 => 70,  182 => 68,  176 => 64,  173 => 63,  168 => 62,  164 => 58,  162 => 57,  154 => 54,  149 => 51,  147 => 50,  144 => 49,  141 => 48,  133 => 42,  130 => 41,  125 => 38,  122 => 37,  116 => 36,  112 => 35,  109 => 34,  106 => 36,  103 => 32,  99 => 30,  95 => 28,  92 => 29,  86 => 24,  82 => 22,  80 => 24,  73 => 19,  64 => 19,  60 => 6,  57 => 12,  54 => 22,  51 => 10,  48 => 9,  45 => 17,  42 => 16,  39 => 6,  36 => 5,  33 => 4,  30 => 3,);
    }
}
