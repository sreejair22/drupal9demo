<?php

use Twig\Environment;
use Twig\Error\LoaderError;
use Twig\Error\RuntimeError;
use Twig\Extension\SandboxExtension;
use Twig\Markup;
use Twig\Sandbox\SecurityError;
use Twig\Sandbox\SecurityNotAllowedTagError;
use Twig\Sandbox\SecurityNotAllowedFilterError;
use Twig\Sandbox\SecurityNotAllowedFunctionError;
use Twig\Source;
use Twig\Template;

/* __string_template__82a1f459665568aaa76903ba65bb2422 */
class __TwigTemplate_b59826a5786e0813e9ba266d06098aff extends \Twig\Template
{
    private $source;
    private $macros = [];

    public function __construct(Environment $env)
    {
        parent::__construct($env);

        $this->source = $this->getSourceContext();

        $this->parent = false;

        $this->blocks = [
        ];
        $this->sandbox = $this->env->getExtension('\Twig\Extension\SandboxExtension');
        $this->checkSecurity();
    }

    protected function doDisplay(array $context, array $blocks = [])
    {
        $macros = $this->macros;
        // line 6
        echo "
";
        // line 7
        echo $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, $this->extensions['Drupal\Core\Template\TwigExtension']->attachLibrary("core/drupal.dialog.ajax"), "html", null, true);
        echo "
";
        // line 8
        $context["simple_form"] = $this->extensions['Drupal\Core\Template\TwigExtension']->getPath("form_api_example.simple_form");
        // line 9
        $context["multistep_form"] = $this->extensions['Drupal\Core\Template\TwigExtension']->getPath("form_api_example.multistep_form");
        // line 10
        $context["input_demo"] = $this->extensions['Drupal\Core\Template\TwigExtension']->getPath("form_api_example.input_demo");
        // line 11
        $context["build_demo"] = $this->extensions['Drupal\Core\Template\TwigExtension']->getPath("form_api_example.build_demo");
        // line 12
        $context["container_demo"] = $this->extensions['Drupal\Core\Template\TwigExtension']->getPath("form_api_example.container_demo");
        // line 13
        $context["state_demo"] = $this->extensions['Drupal\Core\Template\TwigExtension']->getPath("form_api_example.state_demo");
        // line 14
        $context["vertical_tabs_demo"] = $this->extensions['Drupal\Core\Template\TwigExtension']->getPath("form_api_example.vertical_tabs_demo");
        // line 15
        $context["ajax_demo"] = $this->extensions['Drupal\Core\Template\TwigExtension']->getPath("form_api_example.ajax_color_demo");
        // line 16
        $context["ajax_addmore"] = $this->extensions['Drupal\Core\Template\TwigExtension']->getPath("form_api_example.ajax_addmore");
        // line 17
        $context["modal_form"] = $this->extensions['Drupal\Core\Template\TwigExtension']->getPath("form_api_example.modal_form", ["nojs" => "nojs"]);
        // line 18
        $context["block_admin"] = $this->extensions['Drupal\Core\Template\TwigExtension']->getPath("block.admin_display");
        // line 19
        echo "
";
        // line 20
        echo t("<p>Form examples to demonstrate common UI solutions using the Drupal Form API</p>
<p><a href=@simple_form>Simple form</a></p>
<p><a href=@multistep_form>Multistep form</a></p>
<p><a href=@input_demo>Common input elements</a></p>
<p><a href=@build_demo>Build form demo</a></p>
<p><a href=@container_demo>Container elements</a></p>
<p><a href=@state_demo>Form state binding</a></p>
<p><a href=@vertical_tabs_demo>Vertical tab elements</a></p>
<p><a href=@ajax_demo>Ajax form</a></p>
<p><a href=@ajax_addmore>Add-more button</a></p>
<p><a href=@modal_form>Modal form</a></p>

<p>This module also provides a block, \"Example: Display a form\" that
    demonstrates how to display a form in a block. This same technique can be
    used whenever you need to display a form that is not the primary content of
    a page. You can enable it on your site <a href=@block_admin>using the
    block admin page</a>.</p>", array("@simple_form" =>         // line 22
($context["simple_form"] ?? null), "@multistep_form" =>         // line 23
($context["multistep_form"] ?? null), "@input_demo" =>         // line 24
($context["input_demo"] ?? null), "@build_demo" =>         // line 25
($context["build_demo"] ?? null), "@container_demo" =>         // line 26
($context["container_demo"] ?? null), "@state_demo" =>         // line 27
($context["state_demo"] ?? null), "@vertical_tabs_demo" =>         // line 28
($context["vertical_tabs_demo"] ?? null), "@ajax_demo" =>         // line 29
($context["ajax_demo"] ?? null), "@ajax_addmore" =>         // line 30
($context["ajax_addmore"] ?? null), "@modal_form" =>         // line 31
($context["modal_form"] ?? null), "@block_admin" =>         // line 36
($context["block_admin"] ?? null), ));
    }

    public function getTemplateName()
    {
        return "__string_template__82a1f459665568aaa76903ba65bb2422";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  98 => 36,  97 => 31,  96 => 30,  95 => 29,  94 => 28,  93 => 27,  92 => 26,  91 => 25,  90 => 24,  89 => 23,  88 => 22,  71 => 20,  68 => 19,  66 => 18,  64 => 17,  62 => 16,  60 => 15,  58 => 14,  56 => 13,  54 => 12,  52 => 11,  50 => 10,  48 => 9,  46 => 8,  42 => 7,  39 => 6,);
    }

    public function getSourceContext()
    {
        return new Source("{# inline_template_start #}{#

Description text for the Form API Example.

#}

{{ attach_library('core/drupal.dialog.ajax') }}
{% set simple_form = path('form_api_example.simple_form') %}
{% set multistep_form = path('form_api_example.multistep_form') %}
{% set input_demo = path('form_api_example.input_demo') %}
{% set build_demo = path('form_api_example.build_demo') %}
{% set container_demo = path('form_api_example.container_demo') %}
{% set state_demo = path('form_api_example.state_demo') %}
{% set vertical_tabs_demo = path('form_api_example.vertical_tabs_demo') %}
{% set ajax_demo = path('form_api_example.ajax_color_demo') %}
{% set ajax_addmore = path('form_api_example.ajax_addmore') %}
{% set modal_form = path('form_api_example.modal_form', {'nojs': 'nojs'}) %}
{% set block_admin = path('block.admin_display') %}

{% trans %}
<p>Form examples to demonstrate common UI solutions using the Drupal Form API</p>
<p><a href={{ simple_form }}>Simple form</a></p>
<p><a href={{ multistep_form }}>Multistep form</a></p>
<p><a href={{ input_demo }}>Common input elements</a></p>
<p><a href={{ build_demo }}>Build form demo</a></p>
<p><a href={{ container_demo }}>Container elements</a></p>
<p><a href={{ state_demo }}>Form state binding</a></p>
<p><a href={{ vertical_tabs_demo }}>Vertical tab elements</a></p>
<p><a href={{ ajax_demo }}>Ajax form</a></p>
<p><a href={{ ajax_addmore }}>Add-more button</a></p>
<p><a href={{ modal_form }}>Modal form</a></p>

<p>This module also provides a block, \"Example: Display a form\" that
    demonstrates how to display a form in a block. This same technique can be
    used whenever you need to display a form that is not the primary content of
    a page. You can enable it on your site <a href={{ block_admin }}>using the
    block admin page</a>.</p>
{% endtrans %}
", "__string_template__82a1f459665568aaa76903ba65bb2422", "");
    }
    
    public function checkSecurity()
    {
        static $tags = array("set" => 8, "trans" => 20);
        static $filters = array("escape" => 7);
        static $functions = array("attach_library" => 7, "path" => 8);

        try {
            $this->sandbox->checkSecurity(
                ['set', 'trans'],
                ['escape'],
                ['attach_library', 'path']
            );
        } catch (SecurityError $e) {
            $e->setSourceContext($this->source);

            if ($e instanceof SecurityNotAllowedTagError && isset($tags[$e->getTagName()])) {
                $e->setTemplateLine($tags[$e->getTagName()]);
            } elseif ($e instanceof SecurityNotAllowedFilterError && isset($filters[$e->getFilterName()])) {
                $e->setTemplateLine($filters[$e->getFilterName()]);
            } elseif ($e instanceof SecurityNotAllowedFunctionError && isset($functions[$e->getFunctionName()])) {
                $e->setTemplateLine($functions[$e->getFunctionName()]);
            }

            throw $e;
        }

    }
}
