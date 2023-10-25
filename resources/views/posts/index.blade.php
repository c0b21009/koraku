<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}"?>
    <head>
        <meta charset="utf-8">
        <title>original web application</title>
        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">
    </head>
    <body>
        <h1>こらく!!!</h1>
        <div class="posts">
            @foreach ($events as $event)
            <div class="posts">
                <h2 class="title">
                    <a href="/posts/{{ $event->id }}">{{ $event->title }}</a>
                </h2>
                <p class="body">{{ $event->event_content  }}</p>
            </div>
            @endforeach
        </div>
        <div class="paginate">
            {{ $events->links() }}
        </div>
    </body>
</html>