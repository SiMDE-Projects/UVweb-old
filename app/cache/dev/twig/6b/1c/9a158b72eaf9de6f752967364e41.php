<?php

/* ::layout.html.twig */
class __TwigTemplate_6b1c9a158b72eaf9de6f752967364e41 extends Twig_Template
{
    public function __construct(Twig_Environment $env)
    {
        parent::__construct($env);

        $this->parent = false;

        $this->blocks = array(
            'title' => array($this, 'block_title'),
            'style' => array($this, 'block_style'),
            'stylesheets' => array($this, 'block_stylesheets'),
            'body' => array($this, 'block_body'),
        );
    }

    protected function doDisplay(array $context, array $blocks = array())
    {
        // line 1
        echo "
<!DOCTYPE html>
<html lang=\"en\">
  <head>
    <meta charset=\"utf-8\">
    <title>";
        // line 6
        $this->displayBlock('title', $context, $blocks);
        echo "</title>
    <meta name=\"viewport\" content=\"width=device-width, initial-scale=1.0\">
    <meta name=\"description\" content=\"\">
    <meta name=\"author\" content=\"Alexandre Masciulli - Thomas Keunebroek\">

    <!-- Le styles -->
    <style type=\"text/css\">
      body {
        padding-top: 60px;
        padding-bottom: 40px;
      }
      .sidebar-nav {
        padding: 9px 0;
      }
      .navbar-search{
        margin-right: 20px;
      }
      .navbar-search .search-icon {
        z-index: 3;
      }
      .icon-search {
        position: absolute;
        top: 7px;
        right: 7px;
        display: block;
        width: 26px;
        height: 26px;
        cursor: pointer;
        }
      ";
        // line 35
        $this->displayBlock('style', $context, $blocks);
        // line 37
        echo "    </style>
    
    ";
        // line 39
        $this->displayBlock('stylesheets', $context, $blocks);
        // line 42
        echo "<script src=\"http://code.jquery.com/jquery.min.js\" type=\"text/javascript\"></script>
    <!-- Le HTML5 shim, for IE6-8 support of HTML5 elements -->
    <!--[if lt IE 9]>
      <script src=\"http://html5shim.googlecode.com/svn/trunk/html5.js\"></script>
    <![endif]-->

    <!-- Le fav and touch icons -->
  </head>

  <body>

    <div class=\"navbar navbar-fixed-top\">
      <div class=\"navbar-inner\">
        <div class=\"container\">
          <a class=\"btn btn-navbar\" data-toggle=\"collapse\" data-target=\".nav-collapse\">
            <span class=\"icon-bar\"></span>
            <span class=\"icon-bar\"></span>
            <span class=\"icon-bar\"></span>
          </a>
          <a class=\"brand\" href=\"#\">UVweb</a>

          <div class=\"btn-group pull-right\">
            <a class=\"btn dropdown-toggle\" data-toggle=\"dropdown\" href=\"#\">
              <i class=\"icon-user\"></i> tkeunebr
              <span class=\"caret\"></span>
            </a>
            <ul class=\"dropdown-menu\">
              <li><a href=\"#\">Profil</a></li>
              <li class=\"divider\"></li>
              <li><a href=\"#\">Déconnexion</a></li>
            </ul>
          </div>
          <form class=\"navbar-search pull-right\">
            <input type=\"text\" class=\"search-query\" placeholder=\"Rechercher une UV\">
            <span class=\"icon-search\">
<!--               <button type=\"submit\" class=\"icon nav-search\" tabindex=\"-1\">
                <span class=\"visuallyhidden\">
                </span>
              </button> -->
            </span>
          </form>
          <div class=\"nav-collapse collapse\">
            <ul class=\"nav\">
             <!-- <li class=\"active\"><a href=\"#\">Accueil</a></li> -->
            </ul>
          </div><!--/.nav-collapse -->
        </div>
      </div>
    </div>

    <div class=\"container\">
      <div class=\"row-fluid\">
        ";
        // line 94
        $this->displayBlock('body', $context, $blocks);
        // line 96
        echo "      <hr>

      <footer>
        <p>&copy; Alexandre Masciulli - Thomas Keunebroek 2013</p>
      </footer>

    </div>

    <!-- Le javascript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
\t<script type=\"text/javascript\" language=\"javascript\"
\t\tsrc=\"bootstrap.js\"></script>

  </body>
</html>
";
    }

    // line 6
    public function block_title($context, array $blocks = array())
    {
        echo "UVweb";
    }

    // line 35
    public function block_style($context, array $blocks = array())
    {
        // line 36
        echo "      ";
    }

    // line 39
    public function block_stylesheets($context, array $blocks = array())
    {
        // line 40
        echo "      <link rel=\"stylesheet\" href=\"";
        echo twig_escape_filter($this->env, $this->env->getExtension('assets')->getAssetUrl("css/bootstrap.css"), "html", null, true);
        echo "\" type=\"text/css\" />
    ";
    }

    // line 94
    public function block_body($context, array $blocks = array())
    {
        // line 95
        echo "          ";
    }

    public function getTemplateName()
    {
        return "::layout.html.twig";
    }

    public function getDebugInfo()
    {
        return array (  172 => 95,  169 => 94,  162 => 40,  159 => 39,  155 => 36,  152 => 35,  146 => 6,  126 => 96,  124 => 94,  68 => 39,  64 => 37,  62 => 35,  30 => 6,  23 => 1,  102 => 49,  86 => 36,  75 => 28,  70 => 42,  66 => 24,  59 => 20,  51 => 17,  46 => 14,  43 => 13,  32 => 4,  29 => 3,);
    }
}
