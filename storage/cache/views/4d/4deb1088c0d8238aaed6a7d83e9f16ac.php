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

/* weather/visualcrossing/WeatherAllData.html */
class __TwigTemplate_a727e3a8fd5a39c01728163321521df2 extends Template
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
        yield "<div class=\"weather-all-data\">
    <h2>Weather in ";
        // line 2
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(($context["resolvedAddress"] ?? null), "html", null, true);
        yield "</h2>
    <p><strong>Timezone:</strong> ";
        // line 3
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(($context["timezone"] ?? null), "html", null, true);
        yield "</p>
    <p><strong>Date:</strong> ";
        // line 4
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(($context["datetime"] ?? null), "html", null, true);
        yield "</p>
    <!-- Current Weather -->
    <div class=\"current-weather\">
        <h3>Current Weather</h3>
        <ul>
            <li><strong>Temperature:</strong> ";
        // line 9
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, ($context["currentConditions"] ?? null), "temp", [], "any", false, false, false, 9), "html", null, true);
        yield " °";
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, ($context["currentConditions"] ?? null), "unit", [], "any", false, false, false, 9), "html", null, true);
        yield "</li>
            <li><strong>Feels Like:</strong> ";
        // line 10
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, ($context["currentConditions"] ?? null), "feelslike", [], "any", false, false, false, 10), "html", null, true);
        yield " °";
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, ($context["currentConditions"] ?? null), "unit", [], "any", false, false, false, 10), "html", null, true);
        yield "</li>
            <li><strong>Humidity:</strong> ";
        // line 11
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, ($context["currentConditions"] ?? null), "humidity", [], "any", false, false, false, 11), "html", null, true);
        yield "%</li>
            <li><strong>Precipitation:</strong> ";
        // line 12
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, ($context["currentConditions"] ?? null), "precip", [], "any", false, false, false, 12), "html", null, true);
        yield " mm</li>
            <li><strong>Wind Speed:</strong> ";
        // line 13
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, ($context["currentConditions"] ?? null), "windspeed", [], "any", false, false, false, 13), "html", null, true);
        yield " km/h</li>
            <li><strong>Pressure:</strong> ";
        // line 14
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, ($context["currentConditions"] ?? null), "pressure", [], "any", false, false, false, 14), "html", null, true);
        yield " hPa</li>
            <li><strong>Visibility:</strong> ";
        // line 15
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, ($context["currentConditions"] ?? null), "visibility", [], "any", false, false, false, 15), "html", null, true);
        yield " km</li>
            <li><strong>Conditions:</strong> ";
        // line 16
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, ($context["currentConditions"] ?? null), "conditions", [], "any", false, false, false, 16), "html", null, true);
        yield "</li>
            <li><strong>Cloud Cover:</strong> ";
        // line 17
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, ($context["currentConditions"] ?? null), "cloudcover", [], "any", false, false, false, 17), "html", null, true);
        yield "%</li>
            <li><strong>UV Index:</strong> ";
        // line 18
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, ($context["currentConditions"] ?? null), "uvindex", [], "any", false, false, false, 18), "html", null, true);
        yield "</li>
        </ul>
    </div>

    <!-- Sunrise & Sunset -->
    <div class=\"sunrise-sunset\">
        <h3>Sunrise and Sunset</h3>
        <ul>
            <li><strong>Sunrise:</strong> ";
        // line 26
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, ($context["currentConditions"] ?? null), "sunrise", [], "any", false, false, false, 26), "html", null, true);
        yield "</li>
            <li><strong>Sunset:</strong> ";
        // line 27
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, ($context["currentConditions"] ?? null), "sunset", [], "any", false, false, false, 27), "html", null, true);
        yield "</li>
            <li><strong>Moon Phase:</strong> ";
        // line 28
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, ($context["currentConditions"] ?? null), "moonphase", [], "any", false, false, false, 28), "html", null, true);
        yield "</li>
        </ul>
    </div>

    <!-- Weather Forecast -->
    <div class=\"weather-forecast\">
        <h3>Weather Forecast (";
        // line 34
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(Twig\Extension\CoreExtension::length($this->env->getCharset(), ($context["days"] ?? null)), "html", null, true);
        yield " days)</h3>
        ";
        // line 35
        $context['_parent'] = $context;
        $context['_seq'] = CoreExtension::ensureTraversable(($context["days"] ?? null));
        foreach ($context['_seq'] as $context["_key"] => $context["day"]) {
            // line 36
            yield "        <div class=\"forecast-day\">
            <h4>";
            // line 37
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, $context["day"], "datetime", [], "any", false, false, false, 37), "html", null, true);
            yield "</h4>
            <ul>
                <li><strong>Max Temp:</strong> ";
            // line 39
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, $context["day"], "tempmax", [], "any", false, false, false, 39), "html", null, true);
            yield " °";
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, $context["day"], "unit", [], "any", false, false, false, 39), "html", null, true);
            yield "</li>
                <li><strong>Min Temp:</strong> ";
            // line 40
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, $context["day"], "tempmin", [], "any", false, false, false, 40), "html", null, true);
            yield " °";
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, $context["day"], "unit", [], "any", false, false, false, 40), "html", null, true);
            yield "</li>
                <li><strong>Conditions:</strong> ";
            // line 41
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, $context["day"], "conditions", [], "any", false, false, false, 41), "html", null, true);
            yield "</li>
                <li><strong>Precipitation:</strong> ";
            // line 42
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, $context["day"], "precip", [], "any", false, false, false, 42), "html", null, true);
            yield " mm (";
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, $context["day"], "precipprob", [], "any", false, false, false, 42), "html", null, true);
            yield "% chance)</li>
                <li><strong>Wind Speed:</strong> ";
            // line 43
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, $context["day"], "windspeed", [], "any", false, false, false, 43), "html", null, true);
            yield " km/h</li>
                <li><strong>Cloud Cover:</strong> ";
            // line 44
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, $context["day"], "cloudcover", [], "any", false, false, false, 44), "html", null, true);
            yield "%</li>
                <li><strong>Pressure:</strong> ";
            // line 45
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, $context["day"], "pressure", [], "any", false, false, false, 45), "html", null, true);
            yield " hPa</li>
            </ul>
        </div>
        ";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_key'], $context['day'], $context['_parent']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 49
        yield "    </div>
</div>
";
        yield from [];
    }

    /**
     * @codeCoverageIgnore
     */
    public function getTemplateName(): string
    {
        return "weather/visualcrossing/WeatherAllData.html";
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
        return array (  185 => 49,  175 => 45,  171 => 44,  167 => 43,  161 => 42,  157 => 41,  151 => 40,  145 => 39,  140 => 37,  137 => 36,  133 => 35,  129 => 34,  120 => 28,  116 => 27,  112 => 26,  101 => 18,  97 => 17,  93 => 16,  89 => 15,  85 => 14,  81 => 13,  77 => 12,  73 => 11,  67 => 10,  61 => 9,  53 => 4,  49 => 3,  45 => 2,  42 => 1,);
    }

    public function getSourceContext(): Source
    {
        return new Source("", "weather/visualcrossing/WeatherAllData.html", "E:\\xampp\\htdocs\\weather\\wp-content\\plugins\\fast-weather-info\\resources\\views\\weather\\visualcrossing\\WeatherAllData.html");
    }
}
