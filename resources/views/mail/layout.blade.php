<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $subject ?? config('app.name') }}</title>
    <style>
        body { margin: 0; padding: 0; background-color: #f4f4f5; font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, sans-serif; color: #18181b; }
        .machec-wrapper { max-width: 560px; margin: 0 auto; padding: 32px 16px; }
        .machec-card { background-color: #ffffff; border-radius: 8px; padding: 32px; }
        .machec-header { font-size: 18px; font-weight: 600; color: #4f46e5; margin-bottom: 24px; }
        .machec-footer { text-align: center; font-size: 12px; color: #71717a; margin-top: 24px; }
    </style>
</head>
<body>
    <div class="machec-wrapper">
        <div class="machec-card">
            <div class="machec-header">{{ config('app.name') }}</div>
            @include($innerView, $innerData)
        </div>
        <div class="machec-footer">
            &copy; {{ date('Y') }} {{ config('app.name') }}
        </div>
    </div>
</body>
</html>
