<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    {{-- Bootstrap 4.0--}}
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/css/bootstrap.min.css" integrity="sha384-B0vP5xmATw1+K9KRQjQERJvTumQW0nPEzvF6L/Z6nronJ3oUOFUFpCjEUQouq2+l" crossorigin="anonymous">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.min.js" integrity="sha384-+YQ4JLhjyBLPDQt//I+STsc9iw4uQqACwlvpslubQzn4u2UU2UFM80nGisd026JF" crossorigin="anonymous"></script>
 {{--  --------------------------------- --}}

    {{-- Fontawsem --}}
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css"
        integrity="sha512-Kc323vGBEqzTmouAECnVceyQqyqdsSiqLQISBL29aUW4U/M7pSPA/gEUZQqv1cwx4OnYxTxve5UMg5GT6L4JJg=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />

    <title>ادارة الفيديوهات</title>
</head>

<body dir="rtl" style="text-align: right">

    <div>
        <nav class="navbar navbar-expand-lg bg-body-tertiary">
            <div class="container-fluid">
                <a class="navbar-brand" href="#">ادارة الفيديوهات</a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                    data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false"
                    aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                   <ul class="navbar-nav mx-auto">

                        <li class="nav-item">
                            <a class="nav-link"  href="#">
                                <i class="fa-solid fa-house"></i>
                                الصفحة الرئيسية

                            </a>
                        </li>

                        <li class="nav-item">
                            <a class="nav-link"  href="#">
                                <i class="fa-solid fa-clock-rotate-left"></i>
                                سجل المشاهدة

                            </a>
                        </li>

                        <li class="nav-item">
                            <a class="nav-link"  href="#">
                                <i class="fa-solid fa-upload"></i>
                                رفع الفيديو

                            </a>
                        </li>

                        <li class="nav-item">
                            <a class="nav-link"  href="#">
                                <i class="fa-solid fa-circle-play"></i>
                                فيديوهاتي

                            </a>
                        </li>

                        <li class="nav-item">
                            <a class="nav-link"  href="#">
                                <i class="fa-solid fa-film"></i>
                                القنوات

                            </a>
                        </li>
                   </ul>

                   <ul class="navbar-nav mr-auto">
                    @guest
                        <li class="nav-item mt-2">
                            <a class="nav-link" href="{{ route('login') }}">{{ __('تسجيل الدخول') }}</a>
                        </li>
                        @if (Route::has('register'))
                            <li class="nav-item mt-2">
                                <a class="nav-link" href="{{ route('register') }}">{{ __('تسجيل جديد') }}</a>
                            </li>

                        @endif
                    @else
                    <li class="nav-item dropdown justfiy-content-left mt-2 ">
                        <a href="" id="navbarDropdown" class="nav-link" data-toggle="dropdown">
                            <img src="{{Auth::user()->profile_photo_url}}" class="h-8 w-8 rounded-full" alt="{{Auth::user()->name}}">
                        </a>

                        <div class="dropdown-menu dropdown-menu-left px-2 text-right mt-2">

                            <div class="pt-4 pb-1 border-t border-gray-200">
                                <div class="flex items-center px-4">
                                    @if (Laravel\Jetstream\Jetstream::managesProfilePhotos())
                                        <div class="shrink-0 me-3">
                                            <img class="h-10 w-10 rounded-full object-cover" src="{{ Auth::user()->profile_photo_url }}" alt="{{ Auth::user()->name }}" />
                                        </div>
                                    @endif

                                    <div>
                                        <div class="font-medium text-base text-gray-800">{{ Auth::user()->name }}</div>
                                        <div class="font-medium text-sm text-gray-500">{{ Auth::user()->email }}</div>
                                    </div>
                                </div>

                                <div class="mt-3 space-y-1">
                                    <!-- Account Management -->
                                    <x-responsive-nav-link href="{{ route('profile.show') }}" :active="request()->routeIs('profile.show')">
                                        {{ __('Profile') }}
                                    </x-responsive-nav-link>

                                    @if (Laravel\Jetstream\Jetstream::hasApiFeatures())
                                        <x-responsive-nav-link href="{{ route('api-tokens.index') }}" :active="request()->routeIs('api-tokens.index')">
                                            {{ __('API Tokens') }}
                                        </x-responsive-nav-link>
                                    @endif

                                    <!-- Authentication -->
                                    <form method="POST" action="{{ route('logout') }}" x-data>
                                        @csrf

                                        <x-responsive-nav-link href="{{ route('logout') }}"
                                                       @click.prevent="$root.submit();">
                                            {{ __('Log Out') }}
                                        </x-responsive-nav-link>
                                    </form>

                                    <!-- Team Management -->
                                    @if (Laravel\Jetstream\Jetstream::hasTeamFeatures())
                                        <div class="border-t border-gray-200"></div>

                                        <div class="block px-4 py-2 text-xs text-gray-400">
                                            {{ __('Manage Team') }}
                                        </div>

                                        <!-- Team Settings -->
                                        <x-responsive-nav-link href="{{ route('teams.show', Auth::user()->currentTeam->id) }}" :active="request()->routeIs('teams.show')">
                                            {{ __('Team Settings') }}
                                        </x-responsive-nav-link>

                                        @can('create', Laravel\Jetstream\Jetstream::newTeamModel())
                                            <x-responsive-nav-link href="{{ route('teams.create') }}" :active="request()->routeIs('teams.create')">
                                                {{ __('Create New Team') }}
                                            </x-responsive-nav-link>
                                        @endcan

                                        <!-- Team Switcher -->
                                        @if (Auth::user()->allTeams()->count() > 1)
                                            <div class="border-t border-gray-200"></div>

                                            <div class="block px-4 py-2 text-xs text-gray-400">
                                                {{ __('Switch Teams') }}
                                            </div>

                                            @foreach (Auth::user()->allTeams() as $team)
                                                <x-switchable-team :team="$team" component="responsive-nav-link" />
                                            @endforeach
                                        @endif
                                    @endif
                                </div>
                            </div>

                        </div>
                    </li>



                    @endguest
                   </ul>
                </div>
            </div>
        </nav>
    </div>



</body>

</html>
