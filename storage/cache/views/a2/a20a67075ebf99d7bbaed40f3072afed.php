<?php

use Twig\Environment;
use Twig\Error\LoaderError;
use Twig\Error\RuntimeError;
use Twig\Extension\CoreExtension;
use Twig\Extension\SandboxExtension;
use Twig\Markup;
use Twig\Sandbox\SecurityError;
use Twig\Sandbox\SecurityNotAllowedTagError;
use Twig\Sandbox\SecurityNotAllowedFilterError;
use Twig\Sandbox\SecurityNotAllowedFunctionError;
use Twig\Source;
use Twig\Template;
use Twig\TemplateWrapper;

/* weather/visualcrossing/WeatherCurrentData.html */
class __TwigTemplate_b5de9ae4c649c98d8919ef11dd773dfe extends Template
{
    private Source $source;
    /**
     * @var array<string, Template>
     */
    private array $macros = [];

    public function __construct(Environment $env)
    {
        parent::__construct($env);

        $this->source = $this->getSourceContext();

        $this->parent = false;

        $this->blocks = [
        ];
    }

    protected function doDisplay(array $context, array $blocks = []): iterable
    {
        $macros = $this->macros;
        // line 1
        yield "<div class=\"current-weather\">
    <h2>Current Weather in ";
        // line 2
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(($context["resolvedAddress"] ?? null), "html", null, true);
        yield "</h2>
    <p><strong>Timezone:</strong> ";
        // line 3
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(($context["timezone"] ?? null), "html", null, true);
        yield "</p>
    <p><strong>Updated:</strong> ";
        // line 4
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(($context["datetime"] ?? null), "html", null, true);
        yield "</p>
    <ul>
        <li><strong>Temperature:</strong> ";
        // line 6
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(($context["temp"] ?? null), "html", null, true);
        yield " °";
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(($context["unit"] ?? null), "html", null, true);
        yield "</li>
        <li><strong>Feels Like:</strong> ";
        // line 7
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(($context["feelslike"] ?? null), "html", null, true);
        yield " °";
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(($context["unit"] ?? null), "html", null, true);
        yield "</li>
        <li><strong>Humidity:</strong> ";
        // line 8
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, ($context["currentConditions"] ?? null), "humidity", [], "any", false, false, false, 8), "html", null, true);
        yield "%</li>
        <li><strong>Precipitation:</strong> ";
        // line 9
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, ($context["currentConditions"] ?? null), "precip", [], "any", false, false, false, 9), "html", null, true);
        yield " mm</li>
        <li><strong>Wind Speed:</strong> ";
        // line 10
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, ($context["currentConditions"] ?? null), "windspeed", [], "any", false, false, false, 10), "html", null, true);
        yield " km/h</li>
        <li><strong>Pressure:</strong> ";
        // line 11
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, ($context["currentConditions"] ?? null), "pressure", [], "any", false, false, false, 11), "html", null, true);
        yield " hPa</li>
        <li><strong>Visibility:</strong> ";
        // line 12
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, ($context["currentConditions"] ?? null), "visibility", [], "any", false, false, false, 12), "html", null, true);
        yield " km</li>
        <li><strong>Conditions:</strong> ";
        // line 13
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, ($context["currentConditions"] ?? null), "conditions", [], "any", false, false, false, 13), "html", null, true);
        yield "</li>
        <li><strong>Cloud Cover:</strong> ";
        // line 14
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, ($context["currentConditions"] ?? null), "cloudcover", [], "any", false, false, false, 14), "html", null, true);
        yield "%</li>
        <li><strong>UV Index:</strong> ";
        // line 15
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, ($context["currentConditions"] ?? null), "uvindex", [], "any", false, false, false, 15), "html", null, true);
        yield "</li>
    </ul>
</div>
";
        yield from [];
    }

    /**
     * @codeCoverageIgnore
     */
    public function getTemplateName(): string
    {
        return "weather/visualcrossing/WeatherCurrentData.html";
    }

    /**
     * @codeCoverageIgnore
     */
    public function isTraitable(): bool
    {
        return false;
    }

    /**
     * @codeCoverageIgnore
     */
    public function getDebugInfo(): array
    {
        return array (  98 => 15,  94 => 14,  90 => 13,  86 => 12,  82 => 11,  78 => 10,  74 => 9,  70 => 8,  64 => 7,  58 => 6,  53 => 4,  49 => 3,  45 => 2,  42 => 1,);
    }

    public function getSourceContext(): Source
    {
        return new Source("", "weather/visualcrossing/WeatherCurrentData.html", "E:\\xampp\\htdocs\\weather\\wp-content\\plugins\\fast-weather-info\\resources\\views\\weather\\visualcrossing\\WeatherCurrentData.html");
    }
}
