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

/* weather/visualcrossing/WeatherSunSetRiseData.html */
class __TwigTemplate_5a5bf28ced6de03d52d4a1c0bdcc0836 extends Template
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
        yield "<div class=\"weather-sunset-rise\">
    <h2>Sunrise and Sunset</h2>
    <p><strong>Timezone:</strong> ";
        // line 3
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(($context["timezone"] ?? null), "html", null, true);
        yield "</p>
    <p><strong>Date:</strong> ";
        // line 4
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(($context["datetime"] ?? null), "html", null, true);
        yield "</p>
    <ul>
        <li><strong>Sunrise:</strong> ";
        // line 6
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(($context["sunrise"] ?? null), "html", null, true);
        yield "</li>
        <li><strong>Sunset:</strong> ";
        // line 7
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(($context["sunset"] ?? null), "html", null, true);
        yield "</li>
        <li><strong>Moon Phase:</strong> ";
        // line 8
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(($context["moonphase"] ?? null), "html", null, true);
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
        return "weather/visualcrossing/WeatherSunSetRiseData.html";
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
        return array (  63 => 8,  59 => 7,  55 => 6,  50 => 4,  46 => 3,  42 => 1,);
    }

    public function getSourceContext(): Source
    {
        return new Source("", "weather/visualcrossing/WeatherSunSetRiseData.html", "E:\\xampp\\htdocs\\weather\\wp-content\\plugins\\fast-weather-info\\resources\\views\\weather\\visualcrossing\\WeatherSunSetRiseData.html");
    }
}
