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

/* weather/visualcrossing/WeatherForecastData.html */
class __TwigTemplate_bb6f07f9721ea59e43f32fa909800bd6 extends Template
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
        yield "<!-- Weather Forecast -->
<div class=\"weather-forecast\">
    <h2>Weather in ";
        // line 3
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(($context["resolvedAddress"] ?? null), "html", null, true);
        yield "</h2>
    <p><strong>Timezone:</strong> ";
        // line 4
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(($context["timezone"] ?? null), "html", null, true);
        yield "</p>
    <p><strong>Updated:</strong> ";
        // line 5
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(($context["datetime"] ?? null), "html", null, true);
        yield "</p>
    <h3>Weather Forecast (";
        // line 6
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(Twig\Extension\CoreExtension::length($this->env->getCharset(), ($context["days"] ?? null)), "html", null, true);
        yield " days)</h3>
    ";
        // line 7
        $context['_parent'] = $context;
        $context['_seq'] = CoreExtension::ensureTraversable(($context["days"] ?? null));
        foreach ($context['_seq'] as $context["_key"] => $context["day"]) {
            // line 8
            yield "    <div class=\"forecast-day\">
        <h4>";
            // line 9
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, $context["day"], "datetime", [], "any", false, false, false, 9), "html", null, true);
            yield "</h4>
        <ul>
            <li><strong>Max Temp:</strong> ";
            // line 11
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, $context["day"], "tempmax", [], "any", false, false, false, 11), "html", null, true);
            yield " °";
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(($context["unit"] ?? null), "html", null, true);
            yield "</li>
            <li><strong>Min Temp:</strong> ";
            // line 12
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, $context["day"], "tempmin", [], "any", false, false, false, 12), "html", null, true);
            yield " °";
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(($context["unit"] ?? null), "html", null, true);
            yield "</li>
            <li><strong>Conditions:</strong> ";
            // line 13
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, $context["day"], "conditions", [], "any", false, false, false, 13), "html", null, true);
            yield "</li>
            <li><strong>Precipitation:</strong> ";
            // line 14
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, $context["day"], "precip", [], "any", false, false, false, 14), "html", null, true);
            yield " mm (";
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, $context["day"], "precipprob", [], "any", false, false, false, 14), "html", null, true);
            yield "% chance)</li>
            <li><strong>Wind Speed:</strong> ";
            // line 15
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, $context["day"], "windspeed", [], "any", false, false, false, 15), "html", null, true);
            yield " km/h</li>
            <li><strong>Cloud Cover:</strong> ";
            // line 16
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, $context["day"], "cloudcover", [], "any", false, false, false, 16), "html", null, true);
            yield "%</li>
            <li><strong>Pressure:</strong> ";
            // line 17
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, $context["day"], "pressure", [], "any", false, false, false, 17), "html", null, true);
            yield " hPa</li>
        </ul>
    </div>
    ";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_key'], $context['day'], $context['_parent']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 21
        yield "</div>";
        yield from [];
    }

    /**
     * @codeCoverageIgnore
     */
    public function getTemplateName(): string
    {
        return "weather/visualcrossing/WeatherForecastData.html";
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
        return array (  114 => 21,  104 => 17,  100 => 16,  96 => 15,  90 => 14,  86 => 13,  80 => 12,  74 => 11,  69 => 9,  66 => 8,  62 => 7,  58 => 6,  54 => 5,  50 => 4,  46 => 3,  42 => 1,);
    }

    public function getSourceContext(): Source
    {
        return new Source("", "weather/visualcrossing/WeatherForecastData.html", "E:\\xampp\\htdocs\\weather\\wp-content\\plugins\\fast-weather-info\\resources\\views\\weather\\visualcrossing\\WeatherForecastData.html");
    }
}
