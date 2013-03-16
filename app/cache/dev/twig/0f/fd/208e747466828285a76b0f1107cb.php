<?php

/* SensioDistributionBundle:Configurator/Step:doctrine.html.twig */
class __TwigTemplate_0ffd208e747466828285a76b0f1107cb extends Twig_Template
{
    public function __construct(Twig_Environment $env)
    {
        parent::__construct($env);

        $this->parent = $this->env->loadTemplate("SensioDistributionBundle::Configurator/layout.html.twig");

        $this->blocks = array(
            'title' => array($this, 'block_title'),
            'content' => array($this, 'block_content'),
        );
    }

    protected function doGetParent(array $context)
    {
        return "SensioDistributionBundle::Configurator/layout.html.twig";
    }

    protected function doDisplay(array $context, array $blocks = array())
    {
        $this->parent->display($context, array_merge($this->blocks, $blocks));
    }

    // line 3
    public function block_title($context, array $blocks = array())
    {
        echo "Symfony - Configure database";
    }

    // line 5
    public function block_content($context, array $blocks = array())
    {
        // line 6
        echo "    ";
        $this->env->getExtension('form')->renderer->setTheme((isset($context["form"]) ? $context["form"] : $this->getContext($context, "form")), array(0 => "SensioDistributionBundle::Configurator/form.html.twig"));
        // line 7
        echo "
    <div class=\"step\">
        ";
        // line 9
        $this->env->loadTemplate("SensioDistributionBundle::Configurator/steps.html.twig")->display(array_merge($context, array("index" => (isset($context["index"]) ? $context["index"] : $this->getContext($context, "index")), "count" => (isset($context["count"]) ? $context["count"] : $this->getContext($context, "count")))));
        // line 10
        echo "
        <h1>Configure your Database</h1>
        <p>If your website needs a database connection, please configure it here.</p>

        ";
        // line 14
        echo $this->env->getExtension('form')->renderer->searchAndRenderBlock((isset($context["form"]) ? $context["form"] : $this->getContext($context, "form")), 'errors');
        echo "
        <form action=\"";
        // line 15
        echo twig_escape_filter($this->env, $this->env->getExtension('routing')->getPath("_configurator_step", array("index" => (isset($context["index"]) ? $context["index"] : $this->getContext($context, "index")))), "html", null, true);
        echo "\" method=\"POST\">
            <div class=\"symfony-form-column\">
                ";
        // line 17
        echo $this->env->getExtension('form')->renderer->searchAndRenderBlock($this->getAttribute((isset($context["form"]) ? $context["form"] : $this->getContext($context, "form")), "driver"), 'row');
        echo "
                ";
        // line 18
        echo $this->env->getExtension('form')->renderer->searchAndRenderBlock($this->getAttribute((isset($context["form"]) ? $context["form"] : $this->getContext($context, "form")), "host"), 'row');
        echo "
                ";
        // line 19
        echo $this->env->getExtension('form')->renderer->searchAndRenderBlock($this->getAttribute((isset($context["form"]) ? $context["form"] : $this->getContext($context, "form")), "name"), 'row');
        echo "
            </div>
            <div class=\"symfony-form-column\">
                ";
        // line 22
        echo $this->env->getExtension('form')->renderer->searchAndRenderBlock($this->getAttribute((isset($context["form"]) ? $context["form"] : $this->getContext($context, "form")), "user"), 'row');
        echo "
                ";
        // line 23
        echo $this->env->getExtension('form')->renderer->searchAndRenderBlock($this->getAttribute((isset($context["form"]) ? $context["form"] : $this->getContext($context, "form")), "password"), 'row');
        echo "
            </div>

            ";
        // line 26
        echo $this->env->getExtension('form')->renderer->searchAndRenderBlock((isset($context["form"]) ? $context["form"] : $this->getContext($context, "form")), 'rest');
        echo "

            <div class=\"symfony-form-footer\">
                <p>
                    <button type=\"submit\" class=\"sf-button\">
                        <span class=\"border-l\">
                            <span class=\"border-r\">
                                <span class=\"btn-bg\">NEXT STEP</span>
                            </span>
                        </span>
                    </button>
                </p>
                <p>* mandatory fields</p>
            </div>
        </form>
    </div>
";
    }

    public function getTemplateName()
    {
        return "SensioDistributionBundle:Configurator/Step:doctrine.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  1191 => 330,  1185 => 329,  1179 => 328,  1173 => 327,  1167 => 326,  1161 => 325,  1155 => 324,  1149 => 323,  1143 => 322,  1127 => 316,  1120 => 315,  1118 => 314,  1115 => 313,  1092 => 309,  1067 => 308,  1065 => 307,  1062 => 306,  1050 => 301,  1045 => 300,  1043 => 299,  1040 => 298,  1031 => 292,  1025 => 290,  1022 => 289,  1017 => 288,  1015 => 287,  1012 => 286,  1005 => 281,  996 => 279,  992 => 278,  989 => 277,  986 => 276,  984 => 275,  981 => 274,  973 => 270,  971 => 269,  968 => 268,  961 => 263,  958 => 262,  950 => 257,  946 => 256,  942 => 255,  939 => 254,  937 => 253,  934 => 252,  926 => 248,  924 => 244,  922 => 243,  919 => 242,  897 => 235,  894 => 234,  891 => 233,  888 => 232,  885 => 231,  882 => 230,  879 => 229,  876 => 228,  873 => 227,  870 => 226,  867 => 225,  865 => 224,  862 => 223,  854 => 217,  851 => 216,  849 => 215,  846 => 214,  838 => 210,  835 => 209,  833 => 208,  830 => 207,  822 => 203,  819 => 202,  817 => 201,  814 => 200,  806 => 196,  803 => 195,  801 => 194,  798 => 193,  790 => 189,  787 => 188,  785 => 187,  771 => 181,  769 => 180,  766 => 179,  758 => 175,  756 => 174,  753 => 173,  745 => 169,  742 => 168,  740 => 167,  737 => 166,  729 => 162,  726 => 161,  724 => 160,  722 => 159,  719 => 158,  712 => 153,  702 => 152,  697 => 151,  694 => 150,  685 => 147,  683 => 146,  670 => 138,  669 => 137,  667 => 135,  662 => 134,  656 => 132,  653 => 131,  651 => 130,  648 => 129,  639 => 123,  631 => 121,  627 => 120,  622 => 119,  616 => 117,  613 => 116,  590 => 109,  587 => 108,  571 => 104,  569 => 103,  566 => 102,  549 => 98,  530 => 93,  528 => 92,  523 => 91,  502 => 89,  500 => 88,  497 => 87,  488 => 82,  485 => 81,  482 => 80,  476 => 78,  466 => 75,  463 => 74,  450 => 72,  448 => 71,  438 => 69,  429 => 64,  421 => 62,  416 => 61,  412 => 60,  405 => 58,  369 => 43,  364 => 41,  356 => 37,  353 => 36,  350 => 35,  345 => 33,  342 => 32,  334 => 27,  323 => 24,  316 => 22,  295 => 16,  290 => 14,  287 => 13,  269 => 5,  267 => 4,  260 => 330,  254 => 327,  250 => 325,  248 => 324,  238 => 319,  236 => 313,  233 => 312,  226 => 298,  215 => 285,  200 => 262,  197 => 261,  195 => 252,  192 => 251,  184 => 239,  129 => 145,  110 => 38,  81 => 40,  77 => 25,  348 => 322,  346 => 321,  343 => 320,  53 => 14,  65 => 17,  20 => 1,  796 => 475,  793 => 474,  782 => 186,  778 => 471,  774 => 182,  761 => 468,  735 => 463,  732 => 462,  713 => 460,  696 => 459,  692 => 457,  688 => 148,  684 => 455,  680 => 145,  676 => 453,  672 => 139,  668 => 136,  665 => 450,  663 => 449,  646 => 448,  635 => 122,  620 => 442,  615 => 440,  611 => 115,  608 => 114,  606 => 437,  592 => 110,  555 => 401,  537 => 96,  520 => 90,  517 => 396,  515 => 395,  510 => 393,  505 => 391,  201 => 94,  181 => 88,  170 => 85,  160 => 81,  153 => 77,  90 => 27,  385 => 160,  382 => 48,  376 => 158,  367 => 42,  363 => 155,  359 => 153,  357 => 152,  354 => 151,  349 => 149,  336 => 145,  330 => 141,  317 => 135,  311 => 20,  308 => 130,  289 => 120,  286 => 119,  284 => 118,  279 => 115,  277 => 114,  272 => 6,  270 => 110,  261 => 105,  251 => 101,  244 => 322,  237 => 93,  228 => 305,  225 => 87,  223 => 297,  206 => 77,  204 => 95,  180 => 63,  148 => 46,  97 => 23,  34 => 4,  332 => 116,  324 => 139,  321 => 23,  318 => 111,  315 => 110,  303 => 128,  300 => 105,  297 => 277,  291 => 102,  288 => 101,  274 => 97,  265 => 107,  255 => 103,  243 => 92,  231 => 306,  212 => 79,  202 => 265,  190 => 242,  185 => 66,  174 => 214,  58 => 15,  63 => 21,  178 => 87,  175 => 86,  134 => 158,  118 => 49,  113 => 40,  102 => 30,  76 => 22,  351 => 150,  347 => 34,  344 => 119,  339 => 146,  329 => 26,  327 => 140,  320 => 149,  313 => 145,  306 => 107,  299 => 278,  292 => 15,  263 => 95,  256 => 328,  249 => 138,  242 => 96,  232 => 93,  221 => 86,  218 => 286,  213 => 274,  210 => 273,  205 => 267,  191 => 67,  179 => 222,  165 => 60,  161 => 199,  104 => 87,  100 => 36,  59 => 13,  172 => 64,  159 => 193,  152 => 35,  146 => 178,  124 => 129,  23 => 1,  480 => 162,  474 => 77,  469 => 76,  461 => 155,  457 => 153,  453 => 151,  444 => 149,  440 => 70,  437 => 147,  435 => 68,  430 => 144,  427 => 143,  423 => 142,  413 => 134,  409 => 132,  407 => 59,  402 => 57,  398 => 129,  393 => 52,  387 => 50,  384 => 49,  381 => 120,  379 => 47,  374 => 157,  368 => 112,  365 => 111,  362 => 110,  360 => 332,  355 => 106,  341 => 147,  337 => 160,  322 => 138,  314 => 21,  312 => 109,  309 => 108,  305 => 129,  298 => 125,  294 => 90,  285 => 129,  283 => 100,  278 => 8,  268 => 85,  264 => 3,  258 => 329,  252 => 326,  247 => 78,  241 => 321,  235 => 85,  229 => 92,  224 => 81,  220 => 295,  214 => 69,  208 => 268,  177 => 65,  169 => 207,  143 => 43,  140 => 42,  132 => 48,  128 => 49,  119 => 114,  107 => 37,  71 => 19,  38 => 6,  155 => 56,  135 => 49,  126 => 144,  114 => 108,  84 => 41,  70 => 19,  67 => 16,  61 => 2,  94 => 57,  89 => 47,  85 => 26,  75 => 22,  68 => 12,  56 => 12,  87 => 26,  21 => 2,  26 => 3,  93 => 28,  88 => 30,  78 => 24,  46 => 14,  27 => 4,  44 => 8,  31 => 3,  28 => 3,  196 => 90,  183 => 82,  171 => 213,  166 => 206,  163 => 82,  158 => 80,  156 => 192,  151 => 185,  142 => 51,  138 => 50,  136 => 165,  121 => 128,  117 => 39,  105 => 40,  91 => 56,  62 => 17,  49 => 12,  24 => 2,  25 => 3,  19 => 1,  79 => 32,  72 => 18,  69 => 13,  47 => 10,  40 => 11,  37 => 7,  22 => 2,  246 => 323,  157 => 56,  145 => 74,  139 => 166,  131 => 157,  123 => 61,  120 => 44,  115 => 40,  111 => 107,  108 => 33,  101 => 86,  98 => 29,  96 => 67,  83 => 30,  74 => 20,  66 => 18,  55 => 12,  52 => 12,  50 => 10,  43 => 11,  41 => 7,  35 => 5,  32 => 6,  29 => 3,  209 => 78,  203 => 78,  199 => 73,  193 => 92,  189 => 73,  187 => 241,  182 => 223,  176 => 220,  173 => 74,  168 => 84,  164 => 200,  162 => 54,  154 => 186,  149 => 179,  147 => 75,  144 => 173,  141 => 172,  133 => 55,  130 => 39,  125 => 42,  122 => 41,  116 => 113,  112 => 39,  109 => 102,  106 => 101,  103 => 25,  99 => 68,  95 => 34,  92 => 31,  86 => 26,  82 => 25,  80 => 23,  73 => 23,  64 => 3,  60 => 20,  57 => 15,  54 => 19,  51 => 37,  48 => 10,  45 => 9,  42 => 7,  39 => 10,  36 => 5,  33 => 4,  30 => 3,);
    }
}
