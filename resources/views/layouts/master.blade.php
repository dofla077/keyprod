<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    @include('components/head')
    @routes
    <body>
        <div id="app">
            <main class="main">
                <div class="container">
                    @yield('content')
                </div>
            </main>
        </div>
        @include('components/scripts')
    </body>
</html>
