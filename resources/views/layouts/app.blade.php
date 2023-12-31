<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{$metaTitle ? :'Laravel-Blog'}}</title>
    <meta name="author" content="LaravelDaily">
    <meta name="description" content="{{$metaDescription }}">

    <!-- Tailwind -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/tailwindcss/2.2.19/tailwind.min.css" rel="stylesheet">
    <style>
        @import url('https://fonts.googleapis.com/css?family=Karla:400,700&display=swap');

        .font-family-karla {
            font-family: karla;
        }
    </style>

    <!-- AlpineJS -->
    <script src="https://cdn.jsdelivr.net/gh/alpinejs/alpine@v2.x.x/dist/alpine.min.js" defer></script>
    <!-- Font Awesome -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.13.0/js/all.min.js" integrity="sha256-KzZiKy0DWYsnwMF+X1DvQngQ2/FxF7MF3Ff72XcpuPs=" crossorigin="anonymous"></script>
    @livewireStyles 
</head>
<body class="bg-gray 50 font-family-karla">

    <!-- Top Bar Nav -->
    <nav class="w-full py-4 bg-blue-800 shadow">
        <div class="w-full container mx-auto flex flex-wrap items-center justify-between">

            <nav>
                <ul class="flex items-center justify-between font-bold text-sm text-white uppercase no-underline">
                    <li><a class="hover:text-gray-200 hover:underline px-4" href="#">Shop</a></li>
                    <li><a class="hover:text-gray-200 hover:underline px-4" href="#">About</a></li>
                </ul>
            </nav>

            <div class="flex items-center text-lg no-underline text-white pr-6">
                <a class="" href="#">
                    <i class="fab fa-facebook"></i>
                </a>
                <a class="pl-6" href="#">
                    <i class="fab fa-instagram"></i>
                </a>
                <a class="pl-6" href="#">
                    <i class="fab fa-twitter"></i>
                </a>
                <a class="pl-6" href="#">
                    <i class="fab fa-linkedin"></i>
                </a>
            </div>
        </div>

    </nav>

    <!-- Text Header -->
    <header class="w-full container mx-auto">
        <div class="flex flex-col items-center py-12">
            <a class="font-bold text-gray-800 uppercase hover:text-gray-700 text-5xl" href="#">
            {{\App\Models\TextWidget::getContent('Lorem lipsum is the text')}}
            </a>
        </div>
    </header>

    <!-- Topic Nav -->
    <nav class="w-full py-4 border-t border-b bg-gray-100" x-data="{ open: false }">
        <div class="block sm:hidden">
            <a
                href="#"
                class="block md:hidden text-base font-bold uppercase text-center flex justify-center items-center"
                @click="open = !open"
            >
                Topics <i :class="open ? 'fa-chevron-down': 'fa-chevron-up'" class="fas ml-2"></i>
            </a>
        </div>
        <div :class="open ? 'block': 'hidden'" class="w-full flex-grow sm:flex sm:items-center sm:w-auto">
            <div class="w-full container mx-auto flex flex-col sm:flex-row items-center justify-between text-sm font-bold uppercase mt-0 px-6 py-2">
                <div>
                <a href="{{route('home')}}" class="hover:bg-gray-400 rounded py-2 px-4 mx-2">Home</a>
                @foreach($categories as $category)
                <a href="{{route('by-category',$category)}}" class="hover:bg-gray-400 rounded py-2 px-4 mx-2 {{request('category')?->slug === $category->slug ? 'bg-blue-600 text-white' : ''}}">{{$category->title}}</a>
                @endforeach
                <a href="{{route('about-us')}}" class="hover:bg-gray-400 rounded py-2 px-4 mx-2">About us </a>
                </div>
                <div>
                @auth
                <form method="POST" action="{{ route('logout') }}">
                                    @csrf
                    <x-dropdown-link :href="route('logout')"
                        onclick="event.preventDefault();
                            this.closest('form').submit();">
                                {{ __('Log Out') }}
                                </x-dropdown-link>
                                </form>
                        @else
                 <a href="{{route('login')}}" class="hover:bg-gray-400 rounded py-2 px-4 mx-2">Login</a>
                <a href="{{route('register')}}" class="bg-blue-400 rounded py-2 px-4 mx-2">Register</a>
                @endauth
             
             </div>
        </div>
    </nav>
 <div class="w-full  justify-center justify-container mx-auto flex flex-wrap py-6">
      
     {{ $slot }}
        <!-- Posts Section -->
                                                                          
        <!-- Sidebar Section -->
       </div>
     <footer class="w-full border-t bg-white pb-12">
         <div class="uppercase text-center">&copy; laravel.com</div>
        </div>
    </footer>
</script>
@livewireScripts
</body>
</html>