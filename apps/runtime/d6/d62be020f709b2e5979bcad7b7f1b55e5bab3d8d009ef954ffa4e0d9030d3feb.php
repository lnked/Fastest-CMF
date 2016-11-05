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
        echo "<!DOCTYPE html>
<html lang=\"en\">
<head>
    <meta charset=\"UTF-8\">
    <title>ADMIN</title>
</head>
<body>
    <header>
        <h1>HEADER 1</h1>
    </header>
    
    <div>";
        // line 12
        echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute((isset($context["app"]) ? $context["app"] : null), "session", array()), "get", array(0 => "authenticity_token"), "method"), "html", null, true);
        echo "</div>

    <p>";
        // line 14
        echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute((isset($context["app"]) ? $context["app"] : null), "session", array()), "get", array(0 => "csrf_token"), "method"), "html", null, true);
        echo "</p>
    <p>";
        // line 15
        echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute((isset($context["app"]) ? $context["app"] : null), "session", array()), "get", array(0 => "csrf_param"), "method"), "html", null, true);
        echo "</p>

    <ul>
        <li>1</li>
        <li>2</li>
        <li>3</li>
        <li>4</li>
        <li>5</li>
        <li>6</li>
        <li>7</li>
        <li>8</li>
        <li>9</li>
        <li>10</li>
    </ul>
    <footer>
        xxx asd yy
    </footer>
</body>
</html>";
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
        return array (  41 => 15,  37 => 14,  32 => 12,  19 => 1,);
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
