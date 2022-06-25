<?php

/**
 * All files in this folder will be included in the application.
 */

use Carbon\Carbon;

if (!function_exists('implode_with_comma')) {
    /**
     * Separar os ítens de uma array por vírgula.
     *
     * @param  string[]  $array  .
     * @param  string  $lastGlue
     * @param  string  $outputWhenEmpty
     * @return string
     */
    function implode_with_comma(
        array $array,
        string $lastGlue = ', ',
        string $outputWhenEmpty = ''
    ) {
        if (sizeof($array) == 0) {
            return $outputWhenEmpty;
        }

        if (sizeof($array) != 1) {
            $last = array_pop($array);
            $glued = implode(', ', $array);
            return $glued . $lastGlue . $last;
        }

        return implode(', ', $array);
    }
}

if (!function_exists('format_date')) {
    /**
     * Formata uma data
     *
     * @param  Carbon|string  $date  Date to format.
     * @param  string  $format  Format.
     * @param  string  $fromFormat  Origin format.
     * @return string
     */
    function format_date($date, $format = null, $fromFormat = null)
    {
        return \App\Support\DateHelper::formatDate($date, $format, $fromFormat);
    }
}

if (!function_exists('is_active')) {
    /**
     *  Caso o prefixo da rota atual seja igual ao parâmetro passado, é retornada
     * a classe 'active'.
     *
     * @param $routeName
     * @param string $output
     * @param bool $strict
     * @return string
     */
    function is_active($routeName, $output = 'active', $strict = false)
    {
        return (is_current_route($routeName, $strict)) ? $output : '';
    }
}

if (!function_exists('is_active_strict')) {
    /**
     *  Caso o prefixo da rota atual seja igual ao parâmetro passado, é retornada
     * a classe 'active'.
     *
     * @param $routeName
     * @param string $output
     * @return string
     */
    function is_active_strict($routeName, $output = 'active')
    {
        return (is_current_route($routeName, true)) ? $output : '';
    }
}

if (!function_exists('is_one_active')) {
    /**
     *  Caso o prefixo da rota atual seja igual ao parâmetro passado, é retornada
     * a classe 'active'.
     *
     * @param string[] $routeNames
     * @return bool
     */
    function is_one_active($routeNames)
    {
        foreach($routeNames as $name) {
            if (is_current_route($name, true)) {
                return true;
            }
        }

        return false;
    }
}

if (!function_exists('is_current_route')) {
    /**
     * Retorna se o prefixo da rota atual é igual ao parametro passado
     * ex: users.index, users.create.
     * prefixo: users
     *
     * @param $route_name
     * @param bool $strict
     * @return boolean
     */
    function is_current_route($route_name, $strict = false)
    {
        $route_name_prefix = implode('.', explode('.', $route_name, -1));
        $route_compare_prefix = implode('.', explode('.', Route::currentRouteName(), -1));

        $has_same_prefix = ($route_compare_prefix !== '' && $route_compare_prefix === $route_name_prefix);
        $is_actual_route = ($route_name === Route::currentRouteName());

        if ($strict) {
            return $is_actual_route;
        }

        return ($has_same_prefix || $is_actual_route);
    }
}

if (!function_exists('format_of_date')) {
    /**
     * Retorna o formato corrente de 'date'
     *
     * @return string
     */
    function format_of_date()
    {
        return \App\Support\DateHelper::getDateFormat();
    }
}

if (!function_exists('base_domain')) {
    /**
     * Retorna o dominio base da aplicação
     *
     * @return string
     */
    function base_domain()
    {
        return str_replace(['http://', 'https://', '/'], '', config('subdomains.base_url'));
    }
}

if (!function_exists('format_of_datetime')) {
    /**
     * Retorna o formato corrente de 'datetime'
     *
     * @return string
     */
    function format_of_datetime()
    {
        return \App\Support\DateHelper::getDateTimeFormat();
    }
}

if (!function_exists('generate_date_range')) {
    /**
     * Dado uma data inicial e uma final, retorna todos os dias entre elas
     *
     * @param  Carbon  $start_date  Data inicial
     * @param  Carbon  $end_date  Data final
     * @return array
     */
    function generate_date_range(Carbon $start_date, Carbon $end_date)
    {
        return \App\Support\DateHelper::generateDateRange($start_date, $end_date);
    }
}

if (!function_exists('convert_date_interval')) {
    /**
     * Dado um intervalo em string, converte para uma array com os devidos formatos
     * para o banco de dados
     *
     * @param  string  $period
     * @param  string  $periodSeparator
     * @return array
     */
    function convert_date_interval($period, string $periodSeparator = '-')
    {
        return \App\Support\DateHelper::convertDateInterval($period, $periodSeparator);
    }
}

if (!function_exists('is_user_type')) {
    /**
     * Verifica se o usuário corrente corresponde à role desejada
     *
     * @param $type
     * @return bool
     */
    function is_user_type($type)
    {
        return current_user()->hasRole($type);
    }
}

if (!function_exists('_m')) {
    /**
     * Retorna mensagens do arquivo 'flash' de tradução.
     *
     * @param  mixed  $key  Chave do caminho para acessar.
     * @param  string  $default  Mensagem padrão caso não encontre a mensagem.
     * @return string
     */
    function _m(string $key, string $default = null): string
    {
        return __('flash.' . $key);
    }
}

if (!function_exists('with_error')) {
    /**
     *  Caso exista algum erro para o campo passado como parâmetro, é retornada
     * a classe 'font-light shadow appearance-none border focus:outline-none focus:ring-1 focus:ring-primary focus:shadow-inner  rounded w-full py-2 px-3 text-gray-400-danger'.
     *
     * @param  string  $field  Nome do campo do formulário
     * @param  callable|string|null  $output
     * @return string
     */
    function with_error(string $field, $output = 'border-danger'): string
    {
        $errors = \Session::get('errors');

        if (empty($errors)) {
            return '';
        }

        return $errors->has($field) ? value($output) : '';
    }
}

if (!function_exists('mask')) {
    /**
     *  Aplica uma máscara à uma string.
     *
     * @param  string  $value  Valor a ser mascarado
     * @param  string  $mask  Máscara
     * @param  string  $mask_character  Caractere que representará os valores preenchíveis
     * @return string
     */
    function mask($value, $mask, $mask_character = '#')
    {
        $value = str_replace(" ", "", $value);
        for ($i = 0; $i < strlen($value); $i++) {
            $mask[strpos($mask, $mask_character)] = $value[$i];
        }

        return $mask;
    }
}

if (!function_exists('remove_mask_percent')) {

    /**
     * Remover tudo que não for número ou vírgula e substituir vírgula por ponto.
     * Retorna o valor formatado para o formato americano trocando pontos e vírgulas.
     * @param $value
     * @return string
     */
    function remove_mask_percent($value)
    {
        $value = preg_replace('/[^0-9,]/', '', $value);
        return str_replace([','], ['.'], $value);
    }
}

if (!function_exists('format_percent')) {

    /**
     * Remover tudo que não for número ou vírgula e substituir vírgula por ponto.
     * Retorna o valor formatado para o formato americano trocando pontos e vírgulas.
     * @param $value
     * @return string
     */
    function format_percent($value)
    {
        $value = floatval($value);
        return  number_format($value, 2, ',', '');
    }
}

if (!function_exists('remove_mask_money')) {

    /**
     * Remover tudo que não for número ou vírgula e substituir vírgula por ponto.
     * Retorna o valor formatado para o formato americano trocando pontos e vírgulas.
     * @param $value
     * @return string
     */
    function remove_mask_money($value, $fromMoneyFormat = 'BRL')
    {
        return App\Support\MoneyHelper::removeMaskMoney($value, $fromMoneyFormat);
    }
}

if (!function_exists('money')) {

    /**
     * Formatar no padrão monetario, em caso de BRL, substituir . por , para decimal
     * @param $value
     * @return string
     */
    function money($value, $fromMoneyFormat = 'BRL')
    {
        return App\Support\MoneyHelper::money($value, $fromMoneyFormat);
    }
}

if (!function_exists('value_in_cents')) {

    /**
     * Remove a mascara do número e retorna um inteiro com o valor em centavos
     * @param $value
     * @return integer
     */
    function value_in_cents($value, $currency = 'BRL')
    {
        $value = remove_mask_money($value, $currency);
        $valueCents = $value * 100;
        return intval($valueCents);
    }
}

if (!function_exists('pagination')) {
    /**
     * Retorna uma instância do builder de paginação.
     *
     * @return \App\Support\PaginationBuilder
     */
    function pagination()
    {
        return new \App\Support\PaginationBuilder();
    }
}

if (!function_exists('breadcrumb')) {
    /**
     * Retorna uma instância do helper BreadCrumb
     *
     * @return \App\Support\BreadCrumb
     */
    function breadcrumb()
    {
        return new \App\Support\BreadCrumb();
    }
}

if (!function_exists('flash')) {
    /**
     * Retorna uma instância do helper Flash
     *
     * @return \App\Support\Flash
     */
    function flash()
    {
        return new \App\Support\Flash();
    }
}

if (!function_exists('current_user')) {
    /**
     * Retorna uma instância do usuário corrente.
     *
     * @return \App\Models\User
     */
    function current_user()
    {
        return auth()->user();
    }
}

if (!function_exists('apply_params')) {
    /**
     * Aplica argumentos em parâmetros de uma string
     *
     * @return string
     */
    function apply_params(string $string, array $params, $before = ':', $after = '')
    {
        $regex = '/' . $before . '[a-z_]+' . $after . '/';
        return preg_replace_array($regex, $params, $string);
    }
}

if (!function_exists('in_production')) {
    /**
     * Retorna se a aplicação está em produção.
     *
     * @return bool
     */
    function in_production()
    {
        $actualEnv = config('app.env');
        return (starts_with($actualEnv, 'prod'));
    }
}

if (!function_exists('milliseconds')) {
    /**
     * Retorna o timestamp atual em milisegundos
     *
     * @return int
     */
    function milliseconds()
    {
        $microTime = explode(' ', microtime());
        return ((int) $microTime[1]) * 1000 + ((int) round($microTime[0] * 1000));
    }
}

if (!function_exists('stress')) {
    /**
     * Retorna o tempo, em milisegundos, que um método é executado.
     *
     * @param  callable  $function  Método a ser estressado
     * @param  int  $times  Quatidade de vezes que o método será executado
     * @param  bool  $dumpAndDie  Encerrar a aplicação com o resultado do teste
     * @return int tempo de execução
     */
    function stress(callable $function, int $times = 1000, bool $dumpAndDie = true)
    {
        return \App\Support\Debug::stress($function, $times, $dumpAndDie);
    }
}

if (!function_exists('cached_include')) {
    /**
     * Mimics the blade include function but caches the rendered for $time
     * minutes in key 'cache:partials:<view_name>:<context>_<$cache_key>'
     * in order to avoid conflicts and to be able to flush the view using
     * patterns.
     *     Ex: Cache::clear('cache:partials:myview_*');
     *
     * @param  string  $view  The name of the view that are going to be included.
     * @param  array  $vars  Variables that are being passed to the view.
     * @param  integer  $time  The amount of minutes that the result of the view is going to be stored.
     *
     * @return string             Html code of the included view
     */
    function cached_include($view, $vars = null, $time = 60)
    {
        $renderedView = function () use ($view, $vars) {
            return view(
                $view,
                is_array($vars)
                    ? $vars
                    : array_except(get_defined_vars(), ['__data', '__path'])
            )->render();
        };

        if (config('cache.enable_application_cache')) {
            $cacheKey = $view . ':' . md5(serialize($vars));
            return \Cache::remember($cacheKey, $time, $renderedView);
        }

        return $renderedView();
    }
}

if (!function_exists('strbool')) {
    /**
     * Retorna a string de um valor booleano.
     *
     * @param $value
     * @return string
     */
    function strbool(bool $value): string
    {
        return $value ? 'true' : 'false';
    }
}

if (!function_exists('is_valid_url')) {
    /**
     * Validate if param is a valid URL;
     *
     * @param  string  $uil
     * @return boolean
     */
    function is_valid_url(string $url)
    {
        return (bool) filter_var($url, FILTER_VALIDATE_URL);
    }
}

if (!function_exists('current_route_icon_name')) {
    function current_route_icon_name()
    {
        $icon_name = Route::currentRouteName();
        $icon_name =  substr($icon_name, strpos($icon_name, ".") + 1);
        $icon_name = substr($icon_name, 0, strpos($icon_name, '.'));
        return $icon_name;
    }
}

if (!function_exists('current_user_first_name')) {
    /**
     * Retorna uma instância do usuário corrente.
     *
     * @return \App\Models\User
     */
    function current_user_first_name()
    {
        $first_name =  auth()->user()->name;
        $first_name =   explode(' ', trim($first_name));
        return $first_name[0];
    }
}

if (!function_exists('api_current_user')) {
    /**
     * Retorna uma instância do usuário corrente, de acordo com a api-key
     *
     * @return \App\Models\User|null
     */
    function api_current_user()
    {
        $key = request()->header('x-api-key');

        if ($key) {
            return \App\Models\User::where('api_token', $key)->first();
        }

        return null;
    }
}
