<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Notes PWA</title>
    <link rel="manifest" href="/manifest.json">
    <meta name="theme-color" content="#0f172a">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="bg-gray-100 min-h-screen">
    <!-- Navigation Bar -->
    <nav class="bg-blue-600 text-white px-6 py-4 shadow flex justify-between items-center">
        <h1 class="text-xl font-bold">📝 Notes PWA</h1>
        <button id="installBtn" class="hidden bg-indigo-600 hover:bg-indigo-700 text-white px-4 py-2 rounded text-sm">
            📲 Install App
        </button>
        @auth
            <div class="flex items-center gap-4 text-sm">
                <span>{{ Auth::user()->name }}</span>
                <form action="/logout" method="POST">
                    @csrf
                    <button type="submit" class="underline hover:text-blue-200">Logout</button>
                </form>
            </div>
        @endauth
    </nav>

    <!-- Content Section -->
    <main class="max-w-3xl mx-auto mt-8 px-4">
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