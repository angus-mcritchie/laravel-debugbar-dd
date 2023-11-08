<?php

if (!function_exists('bd')) {
    /**
     * Bar dump
     * Just like dd() but with debug bar
     *
     * @param mixed $args
     * @return void
     */
    function bd()
    {

        $args = func_get_args();
        $dumps = null;

        if ($args) {
            ob_start();
            foreach ($args as $arg) {
                dump($arg);
            }
            $dumps = ob_get_clean();
        }

        $editors = [
            'sublime' => 'subl://open?url=file://%file&line=%line',
            'textmate' => 'txmt://open?url=file://%file&line=%line',
            'emacs' => 'emacs://open?url=file://%file&line=%line',
            'macvim' => 'mvim://open/?url=file://%file&line=%line',
            'phpstorm' => 'phpstorm://open?file=%file&line=%line',
            'idea' => 'idea://open?file=%file&line=%line',
            'vscode' => 'vscode://file/%file:%line',
            'vscode-insiders' => 'vscode-insiders://file/%file:%line',
            'vscode-remote' => 'vscode://vscode-remote/%file:%line',
            'vscode-insiders-remote' => 'vscode-insiders://vscode-remote/%file:%line',
            'vscodium' => 'vscodium://file/%file:%line',
            'nova' => 'nova://core/open/file?filename=%file&line=%line',
            'xdebug' => 'xdebug://%file@%line',
            'atom' => 'atom://core/open/file?filename=%file&line=%line',
            'espresso' => 'x-espresso://open?filepath=%file&lines=%line',
            'netbeans' => 'netbeans://open/?f=%file:%line',
        ];

        $backtrace = debug_backtrace()[0];
        $editor = config('debugbar.editor');
        $remoteSitesPath = str(config('debugbar.remote_sites_path'))->finish('/')->start('/')->toString();
        $localSitesPath = str(config('debugbar.local_sites_path'))->finish('/')->start('/')->toString();

        $template = $editors[$editor] ?? $editors['vscode'];
        $file = str_replace($remoteSitesPath, '', $backtrace['file']);
        $line = $backtrace['line'];

        $parsedFile = str(str_replace($remoteSitesPath, $localSitesPath, $backtrace['file']))->trim('/')->toString();
        $href = str_replace('%file', $parsedFile, $template);
        $href = str_replace('%line', $line, $href);

        $html = app()->get('Blade')->getFacadeRoot()->render(file_get_contents(__DIR__ . '/bd.blade.php'), [
            'debugBarHead' => debugbar()->getJavascriptRenderer()->renderHead(),
            'debugBar' => debugbar()->getJavascriptRenderer()->render(),
            'dumps' => $dumps,
            'file' => $file,
            'line' => $line,
            'href' => $href,
        ]);

        response($html)->send();

        die();
    }
}
