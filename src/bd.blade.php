<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <title>Debug | {{ basename($file) }}</title>

    @if ($debugBarHead)
        {!! $debugBarHead !!}
    @endif

    <style>
        body {
            font-family: monospace;
        }

        @media (prefers-color-scheme: dark) {
            body {
                background: #1A202C;
                color: #fff;
            }

            a {
                color: #fff;
            }
        }
    </style>
</head>

<body style="margin: 0; padding: 1rem;">

    <h2 style="margin: 0;">
        bd()
    </h2>

    <p>
        <a href="{{ $href }}">{{ $file }}:{{ $line }}</a>
    </p>

    <div style="border-top: 2px solid #FF0040; margin: 1rem 0;"></div>

    @if ($dumps)
        {!! $dumps !!}
    @endif

    @if ($debugBar)
        {!! $debugBar !!}
    @endif
</body>

</html>
