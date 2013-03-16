<?php

/* TwigBundle:Exception:exception.json.twig */
class __TwigTemplate_e23dfd39b7476c373ed63d284573842d extends Twig_Template
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
        echo twig_jsonencode_filter($this->getAttribute((isset($context["exception"]) ? $context["exception"] : $this->getContext($context, "exception")), "toarray"));
        echo "
";
    }

    public function getTemplateName()
    {
        return "TwigBundle:Exception:exception.json.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  196 => 90,  183 => 82,  171 => 73,  166 => 71,  163 => 70,  158 => 67,  156 => 66,  151 => 63,  142 => 59,  138 => 57,  136 => 56,  121 => 46,  117 => 44,  105 => 40,  91 => 31,  62 => 23,  49 => 19,  24 => 3,  25 => 3,  19 => 1,  79 => 21,  72 => 13,  69 => 25,  47 => 18,  40 => 11,  37 => 10,  22 => 2,  246 => 32,  157 => 56,  145 => 46,  139 => 45,  131 => 42,  123 => 47,  120 => 40,  115 => 43,  111 => 38,  108 => 37,  101 => 39,  98 => 32,  96 => 31,  83 => 25,  74 => 14,  66 => 24,  55 => 16,  52 => 21,  50 => 14,  43 => 9,  41 => 8,  35 => 9,  32 => 12,  29 => 6,  209 => 82,  203 => 78,  199 => 76,  193 => 73,  189 => 71,  187 => 84,  182 => 68,  176 => 64,  173 => 74,  168 => 72,  164 => 58,  162 => 57,  154 => 54,  149 => 51,  147 => 50,  144 => 49,  141 => 48,  133 => 55,  130 => 41,  125 => 38,  122 => 37,  116 => 36,  112 => 42,  109 => 34,  106 => 36,  103 => 32,  99 => 30,  95 => 28,  92 => 29,  86 => 28,  82 => 22,  80 => 24,  73 => 19,  64 => 19,  60 => 6,  57 => 12,  54 => 21,  51 => 20,  48 => 9,  45 => 17,  42 => 16,  39 => 16,  36 => 5,  33 => 4,  30 => 3,);
    }
}
