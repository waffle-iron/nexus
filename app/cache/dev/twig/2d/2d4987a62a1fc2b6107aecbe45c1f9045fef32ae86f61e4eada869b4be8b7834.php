<?php

/* NexusGoogleAppEngineBundle:Default:box_list_with_date_mini.html.twig */
class __TwigTemplate_aa55e6c0eb3b65f7452373964aa6df14810048a99378c6f4a70cd54ef22158d8 extends Twig_Template
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
        echo "<div class=\"col-md-4\">
    <div class=\"x_panel\">
        <div class=\"x_title\">
            <h2>Top Profiles <small>Sessions</small></h2>
            <ul class=\"nav navbar-right panel_toolbox\">
                <li><a class=\"collapse-link\"><i class=\"fa fa-chevron-up\"></i></a>
                </li>
                <li class=\"dropdown\">
                    <a href=\"#\" class=\"dropdown-toggle\" data-toggle=\"dropdown\" role=\"button\" aria-expanded=\"false\"><i class=\"fa fa-wrench\"></i></a>
                    <ul class=\"dropdown-menu\" role=\"menu\">
                        <li><a href=\"#\">Settings 1</a>
                        </li>
                        <li><a href=\"#\">Settings 2</a>
                        </li>
                    </ul>
                </li>
                <li><a class=\"close-link\"><i class=\"fa fa-close\"></i></a>
                </li>
            </ul>
            <div class=\"clearfix\"></div>
        </div>
        <div class=\"x_content\">
            ";
        // line 23
        $context['_parent'] = $context;
        $context['_seq'] = twig_ensure_traversable((isset($context["items"]) ? $context["items"] : $this->getContext($context, "items")));
        foreach ($context['_seq'] as $context["_key"] => $context["item"]) {
            // line 24
            echo "                <article class=\"media event\">
                    <a class=\"pull-left date\">
                        <p class=\"month\">";
            // line 26
            echo twig_escape_filter($this->env, $this->getAttribute($context["item"], "month", array()), "html", null, true);
            echo "</p>
                        <p class=\"day\">";
            // line 27
            echo twig_escape_filter($this->env, $this->getAttribute($context["item"], "day", array()), "html", null, true);
            echo "</p>
                    </a>
                    <div class=\"media-body\">
                        <a class=\"title\" href=\"";
            // line 30
            echo twig_escape_filter($this->env, $this->getAttribute($context["item"], "url", array()), "html", null, true);
            echo "\">";
            echo twig_escape_filter($this->env, $this->getAttribute($context["item"], "title", array()), "html", null, true);
            echo "</a>
                        <p>";
            // line 31
            echo twig_escape_filter($this->env, $this->getAttribute($context["item"], "summary", array()), "html", null, true);
            echo "</p>
                    </div>
                </article>
            ";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['item'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 35
        echo "        </div>
    </div>
</div>";
    }

    public function getTemplateName()
    {
        return "NexusGoogleAppEngineBundle:Default:box_list_with_date_mini.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  77 => 35,  67 => 31,  61 => 30,  55 => 27,  51 => 26,  47 => 24,  43 => 23,  19 => 1,);
    }
}
/* <div class="col-md-4">*/
/*     <div class="x_panel">*/
/*         <div class="x_title">*/
/*             <h2>Top Profiles <small>Sessions</small></h2>*/
/*             <ul class="nav navbar-right panel_toolbox">*/
/*                 <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>*/
/*                 </li>*/
/*                 <li class="dropdown">*/
/*                     <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false"><i class="fa fa-wrench"></i></a>*/
/*                     <ul class="dropdown-menu" role="menu">*/
/*                         <li><a href="#">Settings 1</a>*/
/*                         </li>*/
/*                         <li><a href="#">Settings 2</a>*/
/*                         </li>*/
/*                     </ul>*/
/*                 </li>*/
/*                 <li><a class="close-link"><i class="fa fa-close"></i></a>*/
/*                 </li>*/
/*             </ul>*/
/*             <div class="clearfix"></div>*/
/*         </div>*/
/*         <div class="x_content">*/
/*             {% for item in items %}*/
/*                 <article class="media event">*/
/*                     <a class="pull-left date">*/
/*                         <p class="month">{{ item.month }}</p>*/
/*                         <p class="day">{{ item.day }}</p>*/
/*                     </a>*/
/*                     <div class="media-body">*/
/*                         <a class="title" href="{{ item.url }}">{{ item.title }}</a>*/
/*                         <p>{{ item.summary }}</p>*/
/*                     </div>*/
/*                 </article>*/
/*             {% endfor %}*/
/*         </div>*/
/*     </div>*/
/* </div>*/
