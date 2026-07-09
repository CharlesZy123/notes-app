<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Notes PWA</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="bg-gray-100 min-h-screen">
    <!-- Navigation Bar -->
    <nav class="bg-blue-600 text-white px-6 py-4 shadow flex justify-between items-center">
        <h1 class="text-xl font-bold">📝 Notes PWA</h1>
        <button id="installBtn" class="hidden bg-indigo-600 hover:bg-indigo-700 text-white px-4 py-2 rounded text-sm">
            📲 Install App
        </button>
        <div class="float-end">
            @auth
                <a href="{{ url('/notes') }}"
                    class="inline-block px-5 py-1.5 dark:text-[#EDEDEC] border-[#19140035] hover:border-[#1915014a] border text-[#1b1b18] dark:border-[#3E3E3A] dark:hover:border-[#62605b] rounded-sm text-sm leading-normal">
                    Dashboard
                </a>
            @else
                <a href="{{ route('login') }}"
                    class="inline-block px-5 py-1.5 dark:text-[#EDEDEC] text-[#1b1b18] border border-transparent hover:border-[#19140035] dark:hover:border-[#3E3E3A] rounded-sm text-sm leading-normal">
                    Log in
                </a>

                @if (Route::has('register'))
                    <a href="{{ route('register') }}"
                        class="inline-block px-5 py-1.5 dark:text-[#EDEDEC] border-[#19140035] hover:border-[#1915014a] border text-[#1b1b18] dark:border-[#3E3E3A] dark:hover:border-[#62605b] rounded-sm text-sm leading-normal">
                        Register
                    </a>
                @endif
            @endauth
        </div>
    </nav>

    <!-- Content Section -->
    <main class="max-w-3xl mx-auto mt-8 px-4">
        <div class="text-center">
            <h2 class="mb-4">Login or Register to view and add notes</h2>
        </div>
        @yield('content')
    </main>

    <script>
        if ('serviceWorker' in navigator) {
            navigator.serviceWorker.register('/service-worker.js')
                .then(() => console.log('Service Worker registered'))
                .catch(err => console.error('SW error:', err));
        }
    </script>

    <script>
        let deferredPrompt;
        const installBtn = document.getElementById('installBtn');

        window.addEventListener('beforeinstallprompt', (e) => {
            e.preventDefault();
            deferredPrompt = e;
            installBtn.classList.remove('hidden');
        });

        installBtn.addEventListener('click', async () => {
            if (!deferredPrompt) return;
            deferredPrompt.prompt();
            const result = await deferredPrompt.userChoice;
            if (result.outcome === 'accepted') {
                installBtn.classList.add('hidden');
            }
            deferredPrompt = null;
        });

        window.addEventListener('appinstalled', () => {
            installBtn.classList.add('hidden');
            console.log('PWA installed!');
        });
    </script>
</body>

</html>