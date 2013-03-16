<?php

/* @WebProfiler/Collector/events.html.twig */
class __TwigTemplate_83ba7460e6ad6f4100b60f413c6c780d extends Twig_Template
{
    public function __construct(Twig_Environment $env)
    {
        parent::__construct($env);

        $this->parent = $this->env->loadTemplate("@WebProfiler/Profiler/layout.html.twig");

        $this->blocks = array(
            'menu' => array($this, 'block_menu'),
            'panel' => array($this, 'block_panel'),
            'panelContent' => array($this, 'block_panelContent'),
        );
    }

    protected function doGetParent(array $context)
    {
        return "@WebProfiler/Profiler/layout.html.twig";
    }

    protected function doDisplay(array $context, array $blocks = array())
    {
        // line 3
        $context["__internal_0a98766773c1d4356bb88bf3d307c3de8a3cbc1a"] = $this;
        $this->parent->display($context, array_merge($this->blocks, $blocks));
    }

    // line 5
    public function block_menu($context, array $blocks = array())
    {
        // line 6
        echo "<span class=\"label\">
    <span class=\"icon\"><img src=\"data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAABoAAAAiCAQAAADragGFAAAD60lEQVR42o2UfUxbVRjGb7fy4ah2QwdECSgjEpcYUP8hmtiWljbt+Gih62zGVqBjXkqgVcYQKzNLJF1HBxt0S9YMgqHVLt1oZRqidcpcgQ1dMpkxgyVK2NSYyWTAJoPB4/1g0iLQnZub+348v3vOPe95L/FogFO+pbBMbtPmgEsEDXC1OXJbYVn5FnBoPwg4wVfVCc7J3WRToxoxIbmYRjXZJHcLzqnqTvAZkEUsSfI2iddxCHtR8LkIvBCIR0UKsNdxSOKVt1mSwGGQ87GKNk3ncO1ARdFxkU/qxMYQaKPUKfIVHR+oGK7VdCrazsdSGKJKqsW+oRqnMcu7s91Td02FuBAo7prKU7ezPcvrNA7ViH0l1Ygi/Kmiz+y2H3Tirvqj0PvLqk09ieAsfW1PYrXJXwZ9/VFx11Vda2OW159KmEvFvkkdadvunN19oEbYrXSczMD6/6D1JzOUDmH3gZrZ3dudpG1SJ/aZSwnSuqsDebIz9oZBtbC7/SDykATu0oZTXl77QWH3oNreIDuD3F0dpJXoU3sMU9nG5ku6lop8N9RIAw9ccqvGoDGQWymIR0XUqk+PVF0qNjZPZXsMfWoCKUijrky8Qt0KyuIiWtMqnBdAAOG8phXRVORFKvM6rWC0KQQiqfAG8PEUnkY8ZUVW7hdg6arcTyk2UJlnKAWfsqIRSSwfSFDeDIaUN5FAhBtIlz4IhqQPkB4eytROBEPaCWQ+xkyu3mDI1fs4Mz33dUsw9KUdieGhzVXf0GIF8hmoPIC4sNBEmuweLbbca56kn9kzI+ngrIkgosHMLqu/90c/a31oQVSYxemu0ELNDCph0E0z+3cd8WshnMAb4jlaqP/rjuwPWelt2hYtfCHFutWhJ95vXTw8v6l/yh3dNyphPJMLMatDz6rHaJHhnwsXJQ+33R/z1d6l/dxxJK+GrHMVsvOUTOdNX+ztvKycaLnORo6Vg7sy9GRVFyspnhp2wIDKs+6cGTay5wI2rQj9nbpt8dTtuzVM4gW89JVlB7V/a1QLEUeMrEBDNaDkfvHht07TrVi/eObrrStUC7H6AJ0smH848MnPWUzn5swM9qNHzyxRO4KE/1XoRoZklk5aRy/bdX8KIJ8XLwhQ+ut3H526ylbLk7OsWogy29hlkL+LKPEHd25f+WXIdJf+T7xzQ8RkjG7wljW5duRRM+yYDvThMIpQjGP+79mtWKzW8yEV8snp9wsgWzh1a64De/Ay+NiEV0HOdXw8plhgsaaKoGohxuSigxKM9cOMN7GZTSIC8ZT33vi3BczG6AOIXYKS85mj+e443kYKokO/FsnQWUeZl84OvUZX618UFpIDvqMM6gAAAABJRU5ErkJggg==\" alt=\"Events\" /></span>
    <strong>Events</strong>
</span>
";
    }

    // line 12
    public function block_panel($context, array $blocks = array())
    {
        // line 13
        echo "    ";
        if (twig_length_filter($this->env, $this->getAttribute((isset($context["collector"]) ? $context["collector"] : $this->getContext($context, "collector")), "calledlisteners"))) {
            // line 14
            echo "        ";
            $this->displayBlock("panelContent", $context, $blocks);
            echo "
    ";
        } else {
            // line 16
            echo "        <h2>Events</h2>
        <p>
            <em>No events have been recorded. Are you sure that debugging is enabled in the kernel?</em>
        </p>
    ";
        }
    }

    // line 23
    public function block_panelContent($context, array $blocks = array())
    {
        // line 24
        echo "    <h2>Called Listeners</h2>

    <table>
        <tr>
            <th>Event name</th>
            <th>Listener</th>
        </tr>
        ";
        // line 31
        $context['_parent'] = (array) $context;
        $context['_seq'] = twig_ensure_traversable($this->getAttribute((isset($context["collector"]) ? $context["collector"] : $this->getContext($context, "collector")), "calledlisteners"));
        foreach ($context['_seq'] as $context["_key"] => $context["listener"]) {
            // line 32
            echo "            <tr>
                <td><code>";
            // line 33
            echo twig_escape_filter($this->env, $this->getAttribute((isset($context["listener"]) ? $context["listener"] : $this->getContext($context, "listener")), "event"), "html", null, true);
            echo "</code></td>
                <td><code>";
            // line 34
            echo $context["__internal_0a98766773c1d4356bb88bf3d307c3de8a3cbc1a"]->getdisplay_listener((isset($context["listener"]) ? $context["listener"] : $this->getContext($context, "listener")));
            echo "</code></td>
            </tr>
        ";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['listener'], $context['_parent'], $context['loop']);
        $context = array_merge($_parent, array_intersect_key($context, $_parent));
        // line 37
        echo "    </table>

    ";
        // line 39
        if ($this->getAttribute((isset($context["collector"]) ? $context["collector"] : $this->getContext($context, "collector")), "notcalledlisteners")) {
            // line 40
            echo "        <h2>Not Called Listeners</h2>

        <table>
            <tr>
                <th>Event name</th>
                <th>Listener</th>
            </tr>
            ";
            // line 47
            $context["listeners"] = $this->getAttribute((isset($context["collector"]) ? $context["collector"] : $this->getContext($context, "collector")), "notcalledlisteners");
            // line 48
            echo "            ";
            $context['_parent'] = (array) $context;
            $context['_seq'] = twig_ensure_traversable(twig_sort_filter(twig_get_array_keys_filter((isset($context["listeners"]) ? $context["listeners"] : $this->getContext($context, "listeners")))));
            foreach ($context['_seq'] as $context["_key"] => $context["listener"]) {
                // line 49
                echo "                <tr>
                    <td><code>";
                // line 50
                echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute((isset($context["listeners"]) ? $context["listeners"] : $this->getContext($context, "listeners")), (isset($context["listener"]) ? $context["listener"] : $this->getContext($context, "listener")), array(), "array"), "event"), "html", null, true);
                echo "</code></td>
                    <td><code>";
                // line 51
                echo $context["__internal_0a98766773c1d4356bb88bf3d307c3de8a3cbc1a"]->getdisplay_listener($this->getAttribute((isset($context["listeners"]) ? $context["listeners"] : $this->getContext($context, "listeners")), (isset($context["listener"]) ? $context["listener"] : $this->getContext($context, "listener")), array(), "array"));
                echo "</code></td>
                </tr>
            ";
            }
            $_parent = $context['_parent'];
            unset($context['_seq'], $context['_iterated'], $context['_key'], $context['listener'], $context['_parent'], $context['loop']);
            $context = array_merge($_parent, array_intersect_key($context, $_parent));
            // line 54
            echo "        </table>
    ";
        }
    }

    // line 58
    public function getdisplay_listener($_listener = null)
    {
        $context = $this->env->mergeGlobals(array(
            "listener" => $_listener,
        ));

        $blocks = array();

        ob_start();
        try {
            // line 59
            echo "    ";
            if (($this->getAttribute((isset($context["listener"]) ? $context["listener"] : $this->getContext($context, "listener")), "type") == "Closure")) {
                // line 60
                echo "        Closure
    ";
            } elseif (($this->getAttribute((isset($context["listener"]) ? $context["listener"] : $this->getContext($context, "listener")), "type") == "Function")) {
                // line 62
                echo "        ";
                $context["link"] = $this->env->getExtension('code')->getFileLink($this->getAttribute((isset($context["listener"]) ? $context["listener"] : $this->getContext($context, "listener")), "file"), $this->getAttribute((isset($context["listener"]) ? $context["listener"] : $this->getContext($context, "listener")), "line"));
                // line 63
                echo "        ";
                if ((isset($context["link"]) ? $context["link"] : $this->getContext($context, "link"))) {
                    echo "<a href=\"";
                    echo twig_escape_filter($this->env, (isset($context["link"]) ? $context["link"] : $this->getContext($context, "link")), "html", null, true);
                    echo "\">";
                    echo twig_escape_filter($this->env, $this->getAttribute((isset($context["listener"]) ? $context["listener"] : $this->getContext($context, "listener")), "function"), "html", null, true);
                    echo "</a>";
                } else {
                    echo twig_escape_filter($this->env, $this->getAttribute((isset($context["listener"]) ? $context["listener"] : $this->getContext($context, "listener")), "function"), "html", null, true);
                }
                // line 64
                echo "    ";
            } elseif (($this->getAttribute((isset($context["listener"]) ? $context["listener"] : $this->getContext($context, "listener")), "type") == "Method")) {
                // line 65
                echo "        ";
                $context["link"] = $this->env->getExtension('code')->getFileLink($this->getAttribute((isset($context["listener"]) ? $context["listener"] : $this->getContext($context, "listener")), "file"), $this->getAttribute((isset($context["listener"]) ? $context["listener"] : $this->getContext($context, "listener")), "line"));
                // line 66
                echo "        ";
                echo $this->env->getExtension('code')->abbrClass($this->getAttribute((isset($context["listener"]) ? $context["listener"] : $this->getContext($context, "listener")), "class"));
                echo "::";
                if ((isset($context["link"]) ? $context["link"] : $this->getContext($context, "link"))) {
                    echo "<a href=\"";
                    echo twig_escape_filter($this->env, (isset($context["link"]) ? $context["link"] : $this->getContext($context, "link")), "html", null, true);
                    echo "\">";
                    echo twig_escape_filter($this->env, $this->getAttribute((isset($context["listener"]) ? $context["listener"] : $this->getContext($context, "listener")), "method"), "html", null, true);
                    echo "</a>";
                } else {
                    echo twig_escape_filter($this->env, $this->getAttribute((isset($context["listener"]) ? $context["listener"] : $this->getContext($context, "listener")), "method"), "html", null, true);
                }
                // line 67
                echo "    ";
            }
        } catch (Exception $e) {
            ob_end_clean();

            throw $e;
        }

        return ('' === $tmp = ob_get_clean()) ? '' : new Twig_Markup($tmp, $this->env->getCharset());
    }

    public function getTemplateName()
    {
        return "@WebProfiler/Collector/events.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  178 => 66,  175 => 65,  154 => 60,  134 => 54,  125 => 51,  121 => 50,  118 => 49,  113 => 48,  102 => 40,  87 => 34,  49 => 14,  46 => 13,  27 => 3,  91 => 33,  63 => 18,  385 => 160,  382 => 159,  376 => 158,  374 => 157,  367 => 156,  363 => 155,  359 => 153,  357 => 152,  354 => 151,  349 => 149,  341 => 147,  336 => 145,  330 => 141,  324 => 139,  322 => 138,  317 => 135,  311 => 131,  308 => 130,  305 => 129,  303 => 128,  298 => 125,  289 => 120,  286 => 119,  284 => 118,  279 => 115,  277 => 114,  272 => 111,  270 => 110,  265 => 107,  261 => 105,  255 => 103,  251 => 101,  244 => 97,  237 => 93,  231 => 89,  228 => 88,  225 => 87,  223 => 86,  212 => 79,  209 => 78,  206 => 77,  204 => 76,  193 => 69,  190 => 68,  187 => 67,  185 => 66,  180 => 63,  174 => 59,  171 => 58,  168 => 57,  166 => 56,  159 => 53,  151 => 59,  148 => 46,  143 => 43,  140 => 58,  130 => 39,  116 => 31,  107 => 27,  103 => 25,  97 => 23,  88 => 32,  82 => 28,  76 => 31,  73 => 24,  70 => 15,  67 => 24,  61 => 17,  39 => 6,  36 => 5,  79 => 18,  47 => 8,  45 => 9,  40 => 11,  37 => 10,  22 => 1,  246 => 32,  164 => 58,  162 => 54,  157 => 56,  145 => 46,  139 => 45,  131 => 42,  115 => 39,  108 => 37,  106 => 36,  101 => 33,  98 => 32,  96 => 37,  92 => 21,  80 => 32,  74 => 14,  64 => 23,  55 => 16,  52 => 12,  50 => 14,  43 => 12,  41 => 8,  32 => 5,  29 => 6,  360 => 167,  351 => 150,  347 => 163,  344 => 162,  339 => 146,  337 => 160,  329 => 154,  327 => 140,  320 => 149,  313 => 145,  306 => 141,  299 => 137,  292 => 121,  285 => 129,  278 => 125,  263 => 113,  256 => 109,  249 => 100,  242 => 96,  232 => 93,  229 => 92,  221 => 86,  218 => 83,  213 => 82,  210 => 81,  205 => 78,  199 => 73,  191 => 67,  189 => 73,  179 => 68,  172 => 64,  165 => 60,  161 => 63,  158 => 62,  155 => 56,  147 => 53,  142 => 51,  138 => 50,  135 => 49,  132 => 48,  126 => 47,  123 => 35,  120 => 40,  117 => 43,  111 => 47,  104 => 36,  100 => 39,  93 => 31,  89 => 29,  86 => 28,  83 => 33,  75 => 23,  72 => 13,  69 => 12,  66 => 11,  60 => 6,  54 => 22,  51 => 12,  48 => 11,  42 => 7,  38 => 6,  35 => 6,  33 => 4,  30 => 3,);
    }
}
