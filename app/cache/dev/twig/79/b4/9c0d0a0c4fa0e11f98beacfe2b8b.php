<?php

/* @WebProfiler/Collector/memory.html.twig */
class __TwigTemplate_79b49c0d0a0c4fa0e11f98beacfe2b8b extends Twig_Template
{
    public function __construct(Twig_Environment $env)
    {
        parent::__construct($env);

        $this->parent = $this->env->loadTemplate("@WebProfiler/Profiler/layout.html.twig");

        $this->blocks = array(
            'toolbar' => array($this, 'block_toolbar'),
        );
    }

    protected function doGetParent(array $context)
    {
        return "@WebProfiler/Profiler/layout.html.twig";
    }

    protected function doDisplay(array $context, array $blocks = array())
    {
        $this->parent->display($context, array_merge($this->blocks, $blocks));
    }

    // line 3
    public function block_toolbar($context, array $blocks = array())
    {
        // line 4
        echo "    ";
        ob_start();
        // line 5
        echo "        <span>
            <img width=\"13\" height=\"28\" alt=\"Memory Usage\" src=\"data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAA0AAAAcBAMAAABITyhxAAAAJ1BMVEXNzc3///////////////////////8/Pz////////////+NjY0/Pz9lMO+OAAAADHRSTlMAABAgMDhAWXCvv9e8JUuyAAAAQ0lEQVQI12MQBAMBBmLpMwoMDAw6BxjOOABpHyCdAKRzsNDp5eXl1KBh5oHBAYY9YHoDQ+cqIFjZwGCaBgSpBrjcCwCZgkUHKKvX+wAAAABJRU5ErkJggg==\"/>
            <span>";
        // line 7
        echo twig_escape_filter($this->env, sprintf("%.1f", (($this->getAttribute((isset($context["collector"]) ? $context["collector"] : $this->getContext($context, "collector")), "memory") / 1024) / 1024)), "html", null, true);
        echo " MB</span>
        </span>
    ";
        $context["icon"] = ('' === $tmp = ob_get_clean()) ? '' : new Twig_Markup($tmp, $this->env->getCharset());
        // line 10
        echo "    ";
        ob_start();
        // line 11
        echo "        <div class=\"sf-toolbar-info-piece\">
            <b>Memory usage</b>
            <span>";
        // line 13
        echo twig_escape_filter($this->env, sprintf("%.1f", (($this->getAttribute((isset($context["collector"]) ? $context["collector"] : $this->getContext($context, "collector")), "memory") / 1024) / 1024)), "html", null, true);
        echo " MB</span>
        </div>
    ";
        $context["text"] = ('' === $tmp = ob_get_clean()) ? '' : new Twig_Markup($tmp, $this->env->getCharset());
        // line 16
        echo "    ";
        $this->env->loadTemplate("@WebProfiler/Profiler/toolbar_item.html.twig")->display(array_merge($context, array("link" => false)));
    }

    public function getTemplateName()
    {
        return "@WebProfiler/Collector/memory.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  57 => 16,  34 => 5,  31 => 4,  796 => 475,  793 => 474,  782 => 472,  778 => 471,  774 => 469,  761 => 468,  735 => 463,  732 => 462,  713 => 460,  696 => 459,  692 => 457,  688 => 456,  684 => 455,  680 => 454,  676 => 453,  672 => 452,  668 => 451,  665 => 450,  663 => 449,  646 => 448,  635 => 447,  620 => 442,  615 => 440,  611 => 439,  608 => 438,  606 => 437,  592 => 436,  555 => 401,  537 => 398,  520 => 397,  517 => 396,  515 => 395,  510 => 393,  505 => 391,  201 => 94,  181 => 88,  170 => 85,  163 => 82,  160 => 81,  153 => 77,  141 => 73,  90 => 42,  84 => 40,  68 => 30,  62 => 27,  28 => 3,  332 => 116,  321 => 112,  318 => 111,  315 => 110,  312 => 109,  309 => 108,  300 => 105,  297 => 104,  291 => 102,  288 => 101,  283 => 100,  274 => 97,  258 => 94,  243 => 92,  235 => 85,  224 => 81,  202 => 77,  156 => 62,  136 => 71,  122 => 41,  119 => 40,  112 => 36,  109 => 52,  85 => 24,  58 => 25,  44 => 10,  178 => 87,  175 => 86,  154 => 60,  134 => 54,  125 => 42,  121 => 50,  118 => 49,  113 => 48,  102 => 40,  87 => 41,  49 => 11,  46 => 10,  27 => 3,  91 => 33,  63 => 18,  385 => 160,  382 => 159,  376 => 158,  374 => 157,  367 => 156,  363 => 155,  359 => 153,  357 => 152,  354 => 151,  349 => 149,  341 => 118,  336 => 145,  330 => 141,  324 => 113,  322 => 138,  317 => 135,  311 => 131,  308 => 130,  305 => 129,  303 => 106,  298 => 125,  289 => 120,  286 => 119,  284 => 118,  279 => 115,  277 => 114,  272 => 111,  270 => 110,  265 => 96,  261 => 105,  255 => 93,  251 => 101,  244 => 97,  237 => 93,  231 => 83,  228 => 88,  225 => 87,  223 => 86,  212 => 78,  209 => 78,  206 => 77,  204 => 95,  193 => 92,  190 => 76,  187 => 89,  185 => 74,  180 => 63,  174 => 65,  171 => 58,  168 => 84,  166 => 56,  159 => 53,  151 => 59,  148 => 46,  143 => 51,  140 => 58,  130 => 39,  116 => 57,  107 => 27,  103 => 25,  97 => 23,  88 => 25,  82 => 28,  76 => 34,  73 => 33,  70 => 15,  67 => 24,  61 => 15,  39 => 6,  36 => 5,  79 => 21,  47 => 11,  45 => 9,  40 => 11,  37 => 10,  22 => 1,  246 => 32,  164 => 58,  162 => 54,  157 => 56,  145 => 74,  139 => 49,  131 => 45,  115 => 39,  108 => 37,  106 => 51,  101 => 31,  98 => 45,  96 => 37,  92 => 43,  80 => 32,  74 => 14,  64 => 23,  55 => 24,  52 => 12,  50 => 22,  43 => 12,  41 => 19,  32 => 6,  29 => 6,  360 => 167,  351 => 150,  347 => 163,  344 => 119,  339 => 146,  337 => 160,  329 => 154,  327 => 114,  320 => 149,  313 => 145,  306 => 107,  299 => 137,  292 => 121,  285 => 129,  278 => 98,  263 => 95,  256 => 109,  249 => 138,  242 => 96,  232 => 93,  229 => 92,  221 => 86,  218 => 83,  213 => 82,  210 => 81,  205 => 78,  199 => 73,  191 => 67,  189 => 73,  179 => 68,  172 => 64,  165 => 60,  161 => 63,  158 => 80,  155 => 56,  147 => 75,  142 => 51,  138 => 50,  135 => 49,  132 => 48,  126 => 47,  123 => 61,  120 => 40,  117 => 39,  111 => 47,  104 => 32,  100 => 39,  93 => 31,  89 => 29,  86 => 28,  83 => 33,  75 => 19,  72 => 18,  69 => 17,  66 => 11,  60 => 6,  54 => 22,  51 => 13,  48 => 11,  42 => 7,  38 => 7,  35 => 6,  33 => 4,  30 => 5,);
    }
}
