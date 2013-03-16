<?php

/* UvwebUvBundle:Uv:detail.html.twig */
class __TwigTemplate_801203d82eda91035cab21a3500d967d extends Twig_Template
{
    public function __construct(Twig_Environment $env)
    {
        parent::__construct($env);

        $this->parent = $this->env->loadTemplate("UvwebUvBundle::layout.html.twig");

        $this->blocks = array(
            'style' => array($this, 'block_style'),
            'body' => array($this, 'block_body'),
        );
    }

    protected function doGetParent(array $context)
    {
        return "UvwebUvBundle::layout.html.twig";
    }

    protected function doDisplay(array $context, array $blocks = array())
    {
        $this->parent->display($context, array_merge($this->blocks, $blocks));
    }

    // line 3
    public function block_style($context, array $blocks = array())
    {
        // line 4
        echo ".date {
\tline-height:  40px;
\tmargin: 10px 0;
}
.comment {
\ttext-align: justify;
}
";
    }

    // line 13
    public function block_body($context, array $blocks = array())
    {
        // line 14
        echo "\t<div class=\"page-header\">
\t\t<div class=\"row-fluid\">
\t\t\t<div class=\"span8\">
\t\t\t\t<h1>";
        // line 17
        echo twig_escape_filter($this->env, twig_upper_filter($this->env, $this->getAttribute((isset($context["uv"]) ? $context["uv"] : $this->getContext($context, "uv")), "name")), "html", null, true);
        echo " <small>";
        echo twig_escape_filter($this->env, $this->getAttribute((isset($context["uv"]) ? $context["uv"] : $this->getContext($context, "uv")), "fullname"), "html", null, true);
        echo "</small></h1>
\t\t\t</div>
\t\t\t<div class=\"span4 text-right\">
\t\t\t\t<h2><small>Note moyenne : </small>";
        // line 20
        echo twig_escape_filter($this->env, twig_number_format_filter($this->env, $this->getAttribute((isset($context["uv"]) ? $context["uv"] : $this->getContext($context, "uv")), "averagerate"), 2, ",", " "), "html", null, true);
        echo "/10</h2>
\t\t\t</div>
\t\t</div>
\t</div>
\t";
        // line 24
        $context['_parent'] = (array) $context;
        $context['_seq'] = twig_ensure_traversable((isset($context["comments"]) ? $context["comments"] : $this->getContext($context, "comments")));
        foreach ($context['_seq'] as $context["_key"] => $context["comment"]) {
            // line 25
            echo "\t\t<div class=\"span12\">
\t\t\t<div class=\"row-fluid\">
\t\t\t\t<div class=\"span8\">
\t\t\t\t\t<h3>l'avis de <a href=\"\">";
            // line 28
            echo twig_escape_filter($this->env, $this->getAttribute((isset($context["comment"]) ? $context["comment"] : $this->getContext($context, "comment")), "author"), "html", null, true);
            echo "</a> pour ";
            echo twig_escape_filter($this->env, $this->getAttribute((isset($context["comment"]) ? $context["comment"] : $this->getContext($context, "comment")), "semester"), "html", null, true);
            echo "</h3>
\t\t\t\t</div>
\t\t\t\t<div class=\"span4 date text-right\">
\t\t\t\t\t<h4>le ";
            // line 31
            echo twig_escape_filter($this->env, twig_date_format_filter($this->env, $this->getAttribute((isset($context["comment"]) ? $context["comment"] : $this->getContext($context, "comment")), "date"), "d/m/Y"), "html", null, true);
            echo "</h4>
\t\t\t\t</div>
\t\t\t</div>
\t\t\t<div class=\"row-fluid\">
\t\t\t\t<div class=\"span8 comment\">
\t\t\t\t\t<p> ";
            // line 36
            echo twig_escape_filter($this->env, $this->getAttribute((isset($context["comment"]) ? $context["comment"] : $this->getContext($context, "comment")), "comment"), "html", null, true);
            echo "</p>
\t\t\t\t</div>
\t\t\t\t<div class=\"span4 well well-small\">
\t\t\t\t\t<dl class=\"dl-horizontal\">
\t\t\t\t\t\t<dt>Utilité</dt>
\t\t\t\t\t\t<dd>Utile</dd>
\t\t\t\t\t\t<dt>Dose de travail</dt>
\t\t\t\t\t\t<dd>Moyenne</dd>
\t\t\t\t\t\t<dt>Intérêt</dt>
\t\t\t\t\t\t<dd>Très intéressant</dd>
\t\t\t\t\t\t<dt>Pédagogie</dt>
\t\t\t\t\t\t<dd>Nul</dd>
\t\t\t\t\t\t<dt>Note</dt>
\t\t\t\t\t\t<dd>";
            // line 49
            echo twig_escape_filter($this->env, $this->getAttribute((isset($context["comment"]) ? $context["comment"] : $this->getContext($context, "comment")), "globalrate"), "html", null, true);
            echo "/10</dd>
\t\t\t\t\t</dl>
\t\t\t\t</div>
\t\t\t</div>
\t\t\t<hr>
\t\t</div>
\t";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['comment'], $context['_parent'], $context['loop']);
        $context = array_merge($_parent, array_intersect_key($context, $_parent));
    }

    public function getTemplateName()
    {
        return "UvwebUvBundle:Uv:detail.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  107 => 49,  91 => 36,  83 => 31,  75 => 28,  70 => 25,  66 => 24,  59 => 20,  51 => 17,  46 => 14,  43 => 13,  32 => 4,  29 => 3,);
    }
}
