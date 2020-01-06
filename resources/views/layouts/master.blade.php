@yield('head')

<div class="app <?= Route::current()->getname() ?>">
    @include('partials.navbar')

    @include('partials.messages')
</div>

@yield('content')

@yield('foot')