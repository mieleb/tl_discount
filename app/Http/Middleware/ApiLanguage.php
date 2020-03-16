<?php

namespace App\Http\Middleware;

use App\Fields\Language;
use Closure;

class ApiLanguage
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $language = $request->post(Language::QUERY_PARAM);

        if ($language && in_array($language,Language::allowed())) {
            config(['apis.language' => $language]);
        }

        return $next($request);
    }
}
