<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Laravel Modern Dashboard</title>
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,600&display=swap" rel="stylesheet" />
    <!-- Tailwind CDN -->
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        body {
            font-family: Figtree, sans-serif;
        }

        .glass {
            background: rgba(255, 255, 255, 0.7);
            backdrop-filter: blur(8px);
        }

        .dark .glass {
            background: rgba(31, 41, 55, 0.7);
        }
    </style>
</head>

<body class="antialiased bg-gradient-to-br from-blue-100 via-purple-100 to-pink-100 dark:from-gray-900 dark:via-gray-800 dark:to-gray-900 min-h-screen">
    <div class="relative min-h-screen flex flex-col">
        @if (Route::has('login'))
        <nav class="absolute top-0 right-0 p-6 z-10 flex gap-4">
            @auth
            <a href="{{ url('/dashboard') }}" class="font-semibold text-gray-700 dark:text-gray-200 hover:text-blue-600 dark:hover:text-blue-400 transition">Dashboard</a>
            @else
            <a href="{{ route('login') }}" class="font-semibold text-gray-700 dark:text-gray-200 hover:text-blue-600 dark:hover:text-blue-400 transition">Log in</a>
            @if (Route::has('register'))
            <a href="{{ route('register') }}" class="font-semibold text-gray-700 dark:text-gray-200 hover:text-blue-600 dark:hover:text-blue-400 transition">Register</a>
            @endif
            @endauth
        </nav>
        @endif

        <main class="flex-grow flex items-center justify-center">
            <div class="w-full max-w-7xl px-6 py-12">
                <div class="mb-8 flex flex-col items-center">
                    <h1 class="text-4xl md:text-5xl font-extrabold text-gray-900 dark:text-white drop-shadow-lg mb-2 tracking-tight">Hoş Geldin!</h1>
                    <p class="text-lg text-gray-600 dark:text-gray-300">Modern Dashboard - Laravel v{{ Illuminate\Foundation\Application::VERSION }} (PHP v{{ PHP_VERSION }})</p>
                </div>
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-8">
                    {{-- Günün Sözü --}}
                    @php
                    $sozler = [
                    'Hayal gücünüz sınırınız olsun.',
                    'Bugün, yarının ilk günü.',
                    'Başlamak için mükemmel olmak zorunda değilsin.',
                    'Küçük adımlar büyük değişimler getirir.',
                    'Her şey mümkün, yeter ki iste.'
                    ];
                    $gununSozu = $sozler[array_rand($sozler)];
                    @endphp
                    <div class="glass rounded-2xl shadow-xl p-8 flex flex-col items-center justify-center hover:scale-105 transition-all duration-300 border border-gray-200 dark:border-gray-700">
                        <div id="sozKutusu" class="w-full px-4 py-6 rounded-lg font-semibold text-xl text-gray-700 dark:text-white bg-gradient-to-r from-red-50 to-pink-100 dark:from-red-900 dark:to-pink-900 transition-all duration-500 text-center shadow">
                            <span class="block text-3xl mb-2">📝</span>
                            <span id="gununSozu">{{ $gununSozu }}</span>
                        </div>
                        <button onclick="degistirSoz()" class="mt-6 px-5 py-2.5 bg-pink-500 hover:bg-pink-600 text-white font-bold rounded-lg shadow transition-all">Şaşırt Beni!</button>
                        <div id="emojiContainer" class="relative w-full h-8"></div>
                    </div>

                    {{-- Hava Durumu (Demo) --}}
                    <div class="glass rounded-2xl shadow-xl p-8 flex flex-col items-center justify-center hover:scale-105 transition-all duration-300 border border-gray-200 dark:border-gray-700">
                        <div class="w-full px-4 py-6 rounded-lg font-semibold text-xl text-blue-700 dark:text-blue-200 bg-gradient-to-r from-blue-50 to-cyan-100 dark:from-blue-900 dark:to-cyan-900 transition-all text-center shadow">
                            <span class="block text-3xl mb-2">🌤️</span>
                            <span id="havaDurumu">28°C, Parçalı Bulutlu</span>
                        </div>
                        <div class="mt-4 text-sm text-gray-500 dark:text-gray-400">İstanbul için demo veri</div>
                    </div>

                    {{-- BIST 30 Hisse Senetleri (Demo) --}}
                    <div class="glass rounded-2xl shadow-xl p-8 flex flex-col items-center justify-center hover:scale-105 transition-all duration-300 border border-gray-200 dark:border-gray-700">
                        <div class="w-full px-4 py-6 rounded-lg font-semibold text-xl text-green-700 dark:text-green-200 bg-gradient-to-r from-green-50 to-lime-100 dark:from-green-900 dark:to-lime-900 transition-all text-center shadow">
                            <span class="block text-3xl mb-2">📈</span>
                            <span>BIST 30 Hisse Senetleri</span>
                            <ul id="bist30" class="mt-4 text-left text-base font-normal space-y-1">
                                <li>AKBNK: <span class="font-bold">42.10 ₺</span></li>
                                <li>GARAN: <span class="font-bold">60.25 ₺</span></li>
                                <li>ISCTR: <span class="font-bold">18.90 ₺</span></li>
                                <li>KCHOL: <span class="font-bold">16.70 ₺</span></li>
                                <li>SISE: <span class="font-bold">57.30 ₺</span></li>
                            </ul>
                        </div>
                        <div class="mt-4 text-sm text-gray-500 dark:text-gray-400">Demo hisse verisi</div>
                    </div>

                    {{-- Günün Rengi --}}
                    @php
                    $renkler = [
                    'Kırmızı', 'Mavi', 'Yeşil', 'Sarı', 'Mor', 'Turuncu', 'Pembe', 'Lacivert', 'Beyaz', 'Siyah'
                    ];
                    $gununRengi = $renkler[array_rand($renkler)];
                    @endphp
                    <div class="glass rounded-2xl shadow-xl p-8 flex flex-col items-center justify-center hover:scale-105 transition-all duration-300 border border-gray-200 dark:border-gray-700">
                        <div class="w-full px-4 py-6 rounded-lg font-semibold text-xl text-yellow-700 dark:text-yellow-200 bg-gradient-to-r from-yellow-50 to-orange-100 dark:from-yellow-900 dark:to-orange-900 transition-all text-center shadow">
                            <span class="block text-3xl mb-2">🎨</span>
                            <span>{{ $gununRengi }}</span>
                        </div>
                        <div class="mt-4 text-sm text-gray-500 dark:text-gray-400">Bugünün rengiyle enerjini bul!</div>
                    </div>
                </div>
            </div>
        </main>

        <footer class="w-full text-center py-6 text-gray-500 dark:text-gray-400 text-sm">
            &copy; {{ date('Y') }} Modern Laravel Dashboard
        </footer>
    </div>

    <script>
        const sozler = @json($sozler);
        const renkler = [
            "#fef2f2", "#f0fdf4", "#f0f9ff", "#f3f4f6", "#fdf2fa",
            "#fefce8", "#f1f5f9", "#ede9fe", "#fff7ed", "#e0f2fe"
        ];
        const emojiler = ["🎉", "✨", "🚀", "😃", "🌟", "🔥", "🥳", "💡", "🎈", "🦄"];

        function degistirSoz() {
            let mevcut = document.getElementById('gununSozu').innerText;
            let yeni;
            do {
                yeni = sozler[Math.floor(Math.random() * sozler.length)];
            } while (yeni === mevcut);
            document.getElementById('gununSozu').innerText = yeni;

            // Rastgele arka plan rengi ve animasyon
            let kutu = document.getElementById('sozKutusu');
            let yeniRenk = renkler[Math.floor(Math.random() * renkler.length)];
            kutu.style.background = yeniRenk;
            kutu.style.transform = "scale(1.08)";
            setTimeout(() => {
                kutu.style.transform = "scale(1)";
            }, 200);

            // Emoji fırlatma efekti
            let emoji = emojiler[Math.floor(Math.random() * emojiler.length)];
            let emojiElem = document.createElement('span');
            emojiElem.innerText = emoji;
            emojiElem.style.position = 'absolute';
            emojiElem.style.left = Math.random() * 80 + 10 + '%';
            emojiElem.style.top = '80%';
            emojiElem.style.fontSize = '2.5rem';
            emojiElem.style.opacity = '1';
            emojiElem.style.transition = 'all 1s cubic-bezier(.17,.67,.83,.67)';
            document.getElementById('emojiContainer').appendChild(emojiElem);

            setTimeout(() => {
                emojiElem.style.top = '10%';
                emojiElem.style.opacity = '0';
            }, 50);
            setTimeout(() => {
                emojiElem.remove();
            }, 1200);
        }
    </script>
</body>

</html>