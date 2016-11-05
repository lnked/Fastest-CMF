<?php

/* base.twig */
class __TwigTemplate_b0a3902d7dd94944be048cbf8f78e863305d19ca460b3cb4d99db76c8973f9b2 extends Twig_Template
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
        echo twig_include($this->env, $context, "components/meta.twig", array(), true, false, true);
        echo "
";
        // line 2
        echo twig_include($this->env, $context, "components/svgstore.twig", array(), true, false, true);
        echo "

<div class=\"preload show1 active\">
    <span class=\"preload__spinner\"></span>
    <span class=\"preload__label\">
        Загрузка...
    </span>
</div>

";
        // line 11
        echo twig_include($this->env, $context, "components/popup.twig", array(), true, false, true);
        echo "
";
        // line 12
        echo twig_include($this->env, $context, "components/sidebar.twig", array(), true, false, true);
        echo "

<div class=\"layout-wrapper\">

    <div class=\"layout-content\">
        
        ";
        // line 18
        echo twig_include($this->env, $context, "components/header.twig", array(), true, false, true);
        echo "
        
        <div class=\"layout-content__wrapper\">
            
            ";
        // line 22
        echo twig_include($this->env, $context, "components/content.twig", array(), true, false, true);
        echo "

        </div>

    </div>

</div>

";
        // line 30
        echo twig_include($this->env, $context, "components/scripts.twig", array(), true, false, true);
    }

    public function getTemplateName()
    {
        return "base.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  66 => 30,  55 => 22,  48 => 18,  39 => 12,  35 => 11,  23 => 2,  19 => 1,);
    }

    /** @deprecated since 1.27 (to be removed in 2.0). Use getSourceContext() instead */
    public function getSource()
    {
        @trigger_error('The '.__METHOD__.' method is deprecated since version 1.27 and will be removed in 2.0. Use getSourceContext() instead.', E_USER_DEPRECATED);

        return $this->getSourceContext()->getCode();
    }

    public function getSourceContext()
    {
        return new Twig_Source("", "base.twig", "/Users/edik/web/fastest.dev/apps/app/views/backend/base.twig");
    }
}
