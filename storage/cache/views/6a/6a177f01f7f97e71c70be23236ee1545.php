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

/* admin/WeatherAdminSettings.html */
class __TwigTemplate_50651c087aaee52d6c9d8c9556d2d4c4 extends Template
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
        yield "<div class=\"wrap\">
    <h1>Fast Weather Info Settings</h1>
    <form method=\"post\" action=\"\">
        <table class=\"form-table\">
            <!-- Default Weather Location -->
            <tr>
                <th scope=\"row\">
                    <label for=\"fwi_weather_location\">Default Weather Location</label>
                </th>
                <td>
                    <input name=\"fwi_weather_location\" type=\"text\" id=\"fwi_weather_location\" value=\"";
        // line 11
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(($context["weather_location"] ?? null), "html", null, true);
        yield "\" class=\"regular-text\">
                    <p class=\"description\">Use the format: city, country code (e.g., Dhaka, BD).</p>
                </td>
            </tr>

            <!-- Rainy Weather Email -->
            <tr>
                <th scope=\"row\">
                    <label for=\"fwi_rainy_email\">Rainy Weather Email</label>
                </th>
                <td>
                    <input name=\"fwi_rainy_email\" type=\"email\" id=\"fwi_rainy_email\" value=\"";
        // line 22
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(($context["rainy_email"] ?? null), "html", null, true);
        yield "\" class=\"regular-text\">
                    <p class=\"description\">Get periodic email updates on rainy weather (if applicable).</p>
                </td>
            </tr>

            <!-- Get Email Alerts -->
            <tr>
                <th scope=\"row\">
                    <label for=\"fwi_rainy_email_alerts\">Get Email Alerts</label>
                </th>
                <td>
                    <label for=\"fwi_rainy_email_alerts\">
                        <input name=\"fwi_rainy_email_alerts\" type=\"checkbox\" id=\"fwi_rainy_email_alerts\" value=\"1\" ";
        // line 34
        yield (((($context["email_alerts"] ?? null) == 1)) ? ("checked") : (""));
        yield ">
                        Enable email alerts
                    </label>
                </td>
            </tr>

            <!-- Default Temperature Unit -->
            <tr>
                <th scope=\"row\">
                    <label for=\"fwi_temp_unit\">Default Temperature Unit</label>
                </th>
                <td>
                    <select name=\"fwi_temp_unit\" id=\"fwi_temp_unit\">
                        <option value=\"metric\" ";
        // line 47
        yield (((($context["temp_unit"] ?? null) == "metric")) ? ("selected") : (""));
        yield ">Celsius</option>
                        <option value=\"imperial\" ";
        // line 48
        yield (((($context["temp_unit"] ?? null) == "imperial")) ? ("selected") : (""));
        yield ">Fahrenheit</option>
                    </select>
                </td>
            </tr>

            <!-- Enable/Disable Caching -->
            <tr>
                <th scope=\"row\">
                    <label for=\"fwi_cache_enabled\">Enable Caching</label>
                </th>
                <td>
                    <label for=\"fwi_cache_enabled\">
                        <input name=\"fwi_cache_enabled\" type=\"checkbox\" id=\"fwi_cache_enabled\" value=\"1\" ";
        // line 60
        yield (((($context["cache_enabled"] ?? null) == 1)) ? ("checked") : (""));
        yield ">
                        Enable caching
                    </label>
                </td>
            </tr>

            <!-- Cache Duration -->
            <tr>
                <th scope=\"row\">
                    <label for=\"fwi_cache_duration\">Cache Duration (minutes)</label>
                </th>
                <td>
                    <input type=\"number\" name=\"fwi_cache_duration\" id=\"fwi_cache_duration\" value=\"";
        // line 72
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(($context["cache_duration"] ?? null), "html", null, true);
        yield "\" class=\"small-text\" min=\"0\">
                    <p class=\"description\">Duration for caching weather data to avoid frequent API calls.</p>
                </td>
            </tr>

            <!-- Number of Forecast Days -->
            <tr>
                <th scope=\"row\">
                    <label for=\"fwi_forecast_days\">Number of Forecast Days</label>
                </th>
                <td>
                    <input type=\"number\" name=\"fwi_forecast_days\" id=\"fwi_forecast_days\" value=\"";
        // line 83
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(($context["forecast_days"] ?? null), "html", null, true);
        yield "\" class=\"small-text\" min=\"1\" max=\"15\">
                    <p class=\"description\">Number of days to display in the weather forecast. Maximum is 15 days.</p>
                </td>
            </tr>

            <!-- Weather Provider -->
            <tr>
                <th scope=\"row\">
                    <label for=\"fwi_weather_provider\">Weather Data Provider</label>
                </th>
                <td>
                    <select name=\"fwi_weather_provider\" id=\"fwi_weather_provider\">
                        <option value=\"visualcrossing\" ";
        // line 95
        yield (((($context["weather_provider"] ?? null) == "visualcrossing")) ? ("selected") : (""));
        yield ">VisualCrossing</option>
                        <option value=\"openweathermap\" ";
        // line 96
        yield (((($context["weather_provider"] ?? null) == "openweathermap")) ? ("selected") : (""));
        yield ">OpenWeatherMap</option>
                    </select>
                    <p class=\"description\">Choose your weather provider.</p>
                </td>
            </tr>

            <!-- VisualCrossing API Key -->
            <tr class=\"fwi_api_key_row visualcrossing\">
                <th scope=\"row\">
                    <label for=\"fwi_visualcrossing_api_key\">VisualCrossing API Key</label>
                </th>
                <td>
                    <input name=\"fwi_visualcrossing_api_key\" type=\"text\" id=\"fwi_visualcrossing_api_key\" value=\"";
        // line 108
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(($context["visualcrossing_api_key"] ?? null), "html", null, true);
        yield "\" class=\"regular-text\">
                    <p class=\"description\">Enter and keep your <a target=\"_blank\" title=\"Go to VisualCrossing\" href=\"https://www.visualcrossing.com/weather-data-editions\">VisualCrossing API</a> key secure.</p>
                </td>
            </tr>

            <!-- OpenWeatherMap API Key -->
            <tr class=\"fwi_api_key_row openweathermap\">
                <th scope=\"row\">
                    <label for=\"fwi_openweathermap_api_key\">OpenWeatherMap API Key</label>
                </th>
                <td>
                    <input type=\"text\" name=\"fwi_openweathermap_api_key\" id=\"fwi_openweathermap_api_key\" value=\"";
        // line 119
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(($context["openweathermap_api_key"] ?? null), "html", null, true);
        yield "\" class=\"regular-text\" autocomplete=\"off\" placeholder=\"Enter your API key\" />
                    <p class=\"description\">Enter and keep your <a target=\"_blank\" title=\"Go to OpenWeatherMap\" href=\"https://home.openweathermap.org/\">OpenWeatherMap API</a> key secure.</p>
                </td>
            </tr>

            <!-- OpenCage API Key -->
            <tr>
                <th scope=\"row\">
                    <label for=\"fwi_opencage_api_key\">OpenCage API Key</label>
                </th>
                <td>
                    <input type=\"text\" name=\"fwi_opencage_api_key\" id=\"fwi_opencage_api_key\" value=\"";
        // line 130
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(($context["opencage_api_key"] ?? null), "html", null, true);
        yield "\" class=\"regular-text\" autocomplete=\"off\" placeholder=\"Enter your API key\" />
                    <p class=\"description\">Enter and keep your <a target=\"_blank\" title=\"Go to OpenCage Data\" href=\"https://opencagedata.com/\">OpenCage API</a> key secure.</p>
                </td>
            </tr>

            <!-- Geoapify API Key -->
            <tr>
                <th scope=\"row\">
                    <label for=\"fwi_geoapify_api_key\">Geoapify API Key</label>
                </th>
                <td>
                    <input type=\"text\" name=\"fwi_geoapify_api_key\" id=\"fwi_geoapify_api_key\" value=\"";
        // line 141
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(($context["geoapify_api_key"] ?? null), "html", null, true);
        yield "\" class=\"regular-text\" autocomplete=\"off\" placeholder=\"Enter your API key\" />
                    <p class=\"description\">Enter and keep your <a target=\"_blank\" title=\"Go to Geoapify\" href=\"https://www.geoapify.com/\">Geoapify API</a> key secure.</p>
                </td>
            </tr>
        </table>

        <p class=\"submit\">
            <input type=\"submit\" name=\"submit\" id=\"submit\" class=\"button button-primary\" value=\"Save Changes\">
        </p>
    </form>
</div>

<script>
    // Handle API key rows based on selected provider
    const providerSelect = document.getElementById('fwi_weather_provider');
    const apiKeyRows = document.querySelectorAll('.fwi_api_key_row');
    
    function handleApiKeyRows() {
        apiKeyRows.forEach(row => row.style.display = 'none');
        const selectedProvider = providerSelect.value;
        document.querySelector(`.fwi_api_key_row.\${selectedProvider}`).style.display = 'table-row';
    }

    providerSelect.addEventListener('change', handleApiKeyRows);

    document.addEventListener('DOMContentLoaded', handleApiKeyRows);
</script>
";
        yield from [];
    }

    /**
     * @codeCoverageIgnore
     */
    public function getTemplateName(): string
    {
        return "admin/WeatherAdminSettings.html";
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
        return array (  223 => 141,  209 => 130,  195 => 119,  181 => 108,  166 => 96,  162 => 95,  147 => 83,  133 => 72,  118 => 60,  103 => 48,  99 => 47,  83 => 34,  68 => 22,  54 => 11,  42 => 1,);
    }

    public function getSourceContext(): Source
    {
        return new Source("", "admin/WeatherAdminSettings.html", "E:\\xampp\\htdocs\\weather\\wp-content\\plugins\\fast-weather-info\\resources\\views\\admin\\WeatherAdminSettings.html");
    }
}
