<?php

/* @WebProfiler/Profiler/toolbar.html.twig */
class __TwigTemplate_ecc24227b876be492f91ab959d36a968 extends Twig_Template
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
        echo "<!-- START of Symfony2 Web Debug Toolbar -->
";
        // line 2
        if (("normal" != (isset($context["position"]) ? $context["position"] : $this->getContext($context, "position")))) {
            // line 3
            echo "    <style type=\"text/css\">
        ";
            // line 4
            $this->env->loadTemplate("@WebProfiler/Profiler/toolbar.css.twig")->display(array_merge($context, array("position" => (isset($context["position"]) ? $context["position"] : $this->getContext($context, "position")), "floatable" => true)));
            // line 5
            echo "    </style>
    <div id=\"sfMiniToolbar-";
            // line 6
            echo twig_escape_filter($this->env, (isset($context["token"]) ? $context["token"] : $this->getContext($context, "token")), "html", null, true);
            echo "\" class=\"sf-minitoolbar\">
        <a href=\"javascript:void(0);\" title=\"Show Symfony toolbar\" onclick=\"
            var elem = this.parentNode;
            if (elem.style.display == 'none') {
                document.getElementById('sfToolbarMainContent-";
            // line 10
            echo twig_escape_filter($this->env, (isset($context["token"]) ? $context["token"] : $this->getContext($context, "token")), "html", null, true);
            echo "').style.display = 'none';
                document.getElementById('sfToolbarClearer-";
            // line 11
            echo twig_escape_filter($this->env, (isset($context["token"]) ? $context["token"] : $this->getContext($context, "token")), "html", null, true);
            echo "').style.display = 'none';
                elem.style.display = 'block';
            } else {
                document.getElementById('sfToolbarMainContent-";
            // line 14
            echo twig_escape_filter($this->env, (isset($context["token"]) ? $context["token"] : $this->getContext($context, "token")), "html", null, true);
            echo "').style.display = 'block';
                document.getElementById('sfToolbarClearer-";
            // line 15
            echo twig_escape_filter($this->env, (isset($context["token"]) ? $context["token"] : $this->getContext($context, "token")), "html", null, true);
            echo "').style.display = 'block';
                elem.style.display = 'none'
            }

            Sfjs.setPreference('toolbar/displayState', 'block');
        \">
            <img width=\"26\" height=\"28\" alt=\"Symfony\" src=\"data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAABoAAAAcCAMAAABIzV/hAAACZFBMVEUwLjL///////////////////////////////////////////////////////////////////+Eg4b///+Ni46Xlpj///////////+op6n///////////////////////////////////////////////////////////9ZWFv///////9qaWz///////+mpaf///////////////9ZWFv///////////////9PTVH///91dHb////////////////////g4OD///9NTE+Ih4r///////+Ni47///////92dHeRkJLk5OTLy8xlY2b///////+cm53///////+5ubr////o6Oj////////U1NT///9DQURsa22rq6ysq61hX2L///+LioxTUVVBP0NEQkZpZ2rGxsf///9ram3////s7O2SkZNfXmFxcHKmpae4uLnKysuXlpiop6l3dXiIh4pYVlmrq6ycm52trK7Nzc48Oj5dW158e36dnJ49Oz/Pz9BiYGPAv8BDQUTQz9BVU1aioaNHRUnBwcJXVVk6ODxJR0t3dnmko6U8Oj6lpKY9Oz+0tLXDwsRQTlF7en1QTlHi4eJhX2LFxcZTUVViYGNwb3J+fX83NTlFQ0dUUlW4t7icm524uLk8Oj5YVlmPjpBLSU2enZ9aWVw/PkFBP0NdW153dnk0MjZQTlE1MzdQT1JdXF9ram15eHqGhYdDQkV5eHo2NThEQkZRUFNFQ0dta244NjpGREhTUVU5NztUUlVhX2JubG9HRUlVU1ZiYGM7OTxIRkk7OT1IR0o8Oj4wLjI9Oz8YdG13AAAAynRSTlMAAAEDBAUGCgsMDQ4QEhMUGRobGx0gISIkJiYnKCktLi8wMjM0NTk6Ozw+P0NFSEpLTE5PUFBTWlteXmBiZGVmaWxtcHBxc3R0dnl5fX+BgoOGi46Pj5CRmZqanZ6eoKeoq6ytsLCwsrO0tbe5urq8vL+/wsTFx8jJycvLy8vM0NHR0tLU1NfX2NnZ2trc3N3d3eHh4uLl5ebm5ubn5+fo6urt7e3u7vDx8/Pz9PT19fX19fX29vf39/j4+fn5+vr6+vv7+/z8/f3+yR5EtwAAAbVJREFUeNpl0mVXVFEYhuF3zhkOFqMjYmCi2MUYYKGIYiJ2YCd2t4IBFqgoKjZ2jg3igI2KyO2f8sTMngGvj/te71r7wyMuk4jofZccAihcMzJKXDYnuYcVotyeYKiktV5LA0faaE7S4s7TyMsBupnMcoH/vO6gmanJaiLV1Py+Xwn5zc0fjCbSi2LI2QdkGdLyFBG+rHwMzz4BD7wyGEfFk8pfsD2TkGmyFNvFHfDj55v02VD6DcteOYylatY8oG7boA2QV4vlklzB8tU3/DIwo+dWv58guY5tRcLMtwSGdi1DkTvAn9Jqsgbu4kafRBqlV4sDFCWuIjdhMsp7yQU49rB28/QPLOu2DuWqLMfmfw6M716GskdGVRMSGDKRsEzpvZ+Qs0lFKDd94s2oArh2F7K3oNQt6ChGr5x6+Dx3J7d2E3Ygqam4PCkngRNnngYIO5cWq4lLb5t+vJ6GiifFR1nbMNqP3fSOCN8PZnQynEW5W/nmHy0PXv79eHpRSjsjtEOtWZcRc9YXlNx7VFKwceGYHjG6s0Ob3iK+X3LqlKnjkvt39rjD6w3W6BhvrCdaVw//ADrWicJIvtkmAAAAAElFTkSuQmCC\"/>
        </a>
    </div>
    <div id=\"sfToolbarClearer-";
            // line 24
            echo twig_escape_filter($this->env, (isset($context["token"]) ? $context["token"] : $this->getContext($context, "token")), "html", null, true);
            echo "\" style=\"clear: both; height: 38px;\"></div>
";
        }
        // line 26
        echo "
<div id=\"sfToolbarMainContent-";
        // line 27
        echo twig_escape_filter($this->env, (isset($context["token"]) ? $context["token"] : $this->getContext($context, "token")), "html", null, true);
        echo "\" class=\"sf-toolbarreset\">
    ";
        // line 28
        $context['_parent'] = (array) $context;
        $context['_seq'] = twig_ensure_traversable((isset($context["templates"]) ? $context["templates"] : $this->getContext($context, "templates")));
        foreach ($context['_seq'] as $context["name"] => $context["template"]) {
            // line 29
            echo "        ";
            echo twig_escape_filter($this->env, $this->getAttribute((isset($context["template"]) ? $context["template"] : $this->getContext($context, "template")), "renderblock", array(0 => "toolbar", 1 => array("collector" => $this->getAttribute((isset($context["profile"]) ? $context["profile"] : $this->getContext($context, "profile")), "getcollector", array(0 => (isset($context["name"]) ? $context["name"] : $this->getContext($context, "name"))), "method"), "profiler_url" => (isset($context["profiler_url"]) ? $context["profiler_url"] : $this->getContext($context, "profiler_url")), "token" => $this->getAttribute((isset($context["profile"]) ? $context["profile"] : $this->getContext($context, "profile")), "token"), "name" => (isset($context["name"]) ? $context["name"] : $this->getContext($context, "name")))), "method"), "html", null, true);
            // line 35
            echo "
    ";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['name'], $context['template'], $context['_parent'], $context['loop']);
        $context = array_merge($_parent, array_intersect_key($context, $_parent));
        // line 37
        echo "
    ";
        // line 38
        if (("normal" != (isset($context["position"]) ? $context["position"] : $this->getContext($context, "position")))) {
            // line 39
            echo "        <a class=\"hide-button\" title=\"Close Toolbar\" onclick=\"
            var p = this.parentNode;
            p.style.display = 'none';
            (p.previousElementSibling || p.previousSibling).style.display = 'none';
            document.getElementById('sfMiniToolbar-";
            // line 43
            echo twig_escape_filter($this->env, (isset($context["token"]) ? $context["token"] : $this->getContext($context, "token")), "html", null, true);
            echo "').style.display = 'block';
            Sfjs.setPreference('toolbar/displayState', 'none');
        \"></a>
    ";
        }
        // line 47
        echo "</div>
<!-- END of Symfony2 Web Debug Toolbar -->
";
    }

    public function getTemplateName()
    {
        return "@WebProfiler/Profiler/toolbar.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  94 => 38,  81 => 29,  77 => 28,  65 => 24,  53 => 15,  24 => 3,  19 => 1,  480 => 162,  474 => 161,  469 => 158,  461 => 155,  457 => 153,  453 => 151,  444 => 149,  440 => 148,  437 => 147,  435 => 146,  430 => 144,  427 => 143,  423 => 142,  413 => 134,  409 => 132,  407 => 131,  402 => 130,  398 => 129,  393 => 126,  387 => 122,  384 => 121,  381 => 120,  379 => 119,  368 => 112,  365 => 111,  362 => 110,  355 => 106,  314 => 99,  294 => 90,  268 => 85,  264 => 84,  252 => 80,  247 => 78,  241 => 77,  220 => 70,  214 => 69,  208 => 68,  177 => 65,  169 => 60,  128 => 49,  71 => 17,  114 => 42,  78 => 21,  203 => 78,  182 => 66,  176 => 64,  173 => 63,  149 => 51,  144 => 53,  133 => 42,  99 => 30,  95 => 34,  57 => 11,  34 => 5,  31 => 4,  796 => 475,  793 => 474,  782 => 472,  778 => 471,  774 => 469,  761 => 468,  735 => 463,  732 => 462,  713 => 460,  696 => 459,  692 => 457,  688 => 456,  684 => 455,  680 => 454,  676 => 453,  672 => 452,  668 => 451,  665 => 450,  663 => 449,  646 => 448,  635 => 447,  620 => 442,  615 => 440,  611 => 439,  608 => 438,  606 => 437,  592 => 436,  555 => 401,  537 => 398,  520 => 397,  517 => 396,  515 => 395,  510 => 393,  505 => 391,  201 => 94,  181 => 88,  170 => 85,  163 => 82,  160 => 81,  153 => 77,  141 => 51,  90 => 42,  84 => 35,  68 => 30,  62 => 27,  28 => 3,  332 => 116,  321 => 112,  318 => 111,  315 => 110,  312 => 98,  309 => 97,  300 => 105,  297 => 104,  291 => 102,  288 => 101,  283 => 88,  274 => 97,  258 => 81,  243 => 92,  235 => 74,  224 => 71,  202 => 77,  156 => 62,  136 => 71,  122 => 43,  119 => 42,  112 => 35,  109 => 47,  85 => 25,  58 => 25,  44 => 10,  178 => 87,  175 => 86,  154 => 54,  134 => 54,  125 => 44,  121 => 50,  118 => 49,  113 => 48,  102 => 43,  87 => 41,  49 => 14,  46 => 7,  27 => 4,  91 => 37,  63 => 18,  385 => 160,  382 => 159,  376 => 158,  374 => 116,  367 => 156,  363 => 155,  359 => 153,  357 => 152,  354 => 151,  349 => 149,  341 => 105,  336 => 145,  330 => 141,  324 => 113,  322 => 101,  317 => 135,  311 => 131,  308 => 130,  305 => 95,  303 => 106,  298 => 91,  289 => 120,  286 => 119,  284 => 118,  279 => 115,  277 => 114,  272 => 111,  270 => 110,  265 => 96,  261 => 105,  255 => 93,  251 => 101,  244 => 97,  237 => 93,  231 => 83,  228 => 88,  225 => 87,  223 => 86,  212 => 78,  209 => 82,  206 => 77,  204 => 95,  193 => 73,  190 => 76,  187 => 70,  185 => 74,  180 => 63,  174 => 65,  171 => 61,  168 => 62,  166 => 56,  159 => 53,  151 => 59,  148 => 46,  143 => 56,  140 => 55,  130 => 41,  116 => 36,  107 => 36,  103 => 37,  97 => 23,  88 => 25,  82 => 22,  76 => 34,  73 => 27,  70 => 26,  67 => 15,  61 => 13,  39 => 10,  36 => 5,  79 => 21,  47 => 9,  45 => 8,  40 => 11,  37 => 10,  22 => 2,  246 => 32,  164 => 59,  162 => 59,  157 => 56,  145 => 74,  139 => 50,  131 => 45,  115 => 39,  108 => 37,  106 => 33,  101 => 32,  98 => 31,  96 => 39,  92 => 33,  80 => 21,  74 => 14,  64 => 14,  55 => 24,  52 => 12,  50 => 10,  43 => 11,  41 => 19,  32 => 6,  29 => 5,  360 => 109,  351 => 150,  347 => 163,  344 => 119,  339 => 146,  337 => 103,  329 => 154,  327 => 114,  320 => 149,  313 => 145,  306 => 107,  299 => 137,  292 => 121,  285 => 89,  278 => 86,  263 => 95,  256 => 109,  249 => 138,  242 => 96,  232 => 93,  229 => 73,  221 => 86,  218 => 83,  213 => 82,  210 => 81,  205 => 78,  199 => 67,  191 => 67,  189 => 71,  179 => 68,  172 => 64,  165 => 60,  161 => 63,  158 => 80,  155 => 58,  147 => 58,  142 => 51,  138 => 50,  135 => 47,  132 => 51,  126 => 45,  123 => 61,  120 => 40,  117 => 39,  111 => 37,  104 => 32,  100 => 39,  93 => 28,  89 => 29,  86 => 24,  83 => 33,  75 => 23,  72 => 18,  69 => 17,  66 => 11,  60 => 13,  54 => 10,  51 => 10,  48 => 8,  42 => 7,  38 => 6,  35 => 5,  33 => 4,  30 => 3,);
    }
}
