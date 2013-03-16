<?php

/* UvwebUvBundle::layout.html.twig */
class __TwigTemplate_1ad339fa88291459a2a627337d4d6312 extends Twig_Template
{
    public function __construct(Twig_Environment $env)
    {
        parent::__construct($env);

        $this->parent = $this->env->loadTemplate("::layout.html.twig");

        $this->blocks = array(
        );
    }

    protected function doGetParent(array $context)
    {
        return "::layout.html.twig";
    }

    protected function doDisplay(array $context, array $blocks = array())
    {
        $this->parent->display($context, array_merge($this->blocks, $blocks));
    }

    public function getTemplateName()
    {
        return "UvwebUvBundle::layout.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  102 => 49,  86 => 36,  75 => 28,  70 => 25,  66 => 24,  59 => 20,  51 => 17,  46 => 14,  43 => 13,  32 => 4,  29 => 3,);
    }
}
