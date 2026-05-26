<!DOCTYPE html>
<html lang="ar" dir="rtl" class="dark">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>الصفحة غير موجودة | 404</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://unpkg.com/@phosphor-icons/web"></script>
    <link href="https://fonts.googleapis.com/css2?family=Cairo:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    <script>
        tailwind.config = {
            darkMode: 'class',
            theme: {
                extend: {
                    fontFamily: { sans: ['Cairo', 'sans-serif'] },
                    colors: {
                        brand: { 50: '#eef2ff', 100: '#e0e7ff', 500: '#6366f1', 600: '#4f46e5', 700: '#4338ca', 900: '#312e81' },
                        slate: { 850: '#151e2e', 900: '#0f172a', 950: '#020617' }
                    }
                }
            }
        }
    </script>
    <style>
        body { font-family: 'Cairo', sans-serif; background-color: #020617; color: white; }
        .brand-text { background: linear-gradient(135deg, #818cf8, #4f46e5); -webkit-background-clip: text; -webkit-text-fill-color: transparent; }
        .brand-gradient { background: linear-gradient(135deg, #6366f1, #4338ca); }
    </style>
</head>
<body class="h-screen flex items-center justify-center overflow-hidden">
    <div class="relative z-10 text-center px-6">
        <div class="mb-8 relative inline-block">
            <h1 class="text-[10rem] md:text-[15rem] font-black opacity-10 leading-none">404</h1>
            <div class="absolute inset-0 flex items-center justify-center">
                <i class="ph ph-warning-octagon text-8xl md:text-9xl text-brand-500 animate-pulse"></i>
            </div>
        </div>
        <h2 class="text-3xl md:text-4xl font-extrabold mb-4">أوبس! الصفحة مفقودة</h2>
        <p class="text-slate-400 text-lg mb-10 max-w-md mx-auto">يبدو أنك سلكت طريقاً خاطئاً، الصفحة التي تبحث عنها غير موجودة أو تم نقلها.</p>
        
        <div class="flex flex-col sm:flex-row items-center justify-center gap-4">
            <a href="/" class="brand-gradient px-8 py-4 rounded-2xl font-bold text-lg shadow-xl shadow-brand-500/30 hover:-translate-y-1 transition duration-300 w-full sm:w-auto">
                العودة للرئيسية <i class="ph ph-house ml-2"></i>
            </a>
            <button onclick="history.back()" class="bg-slate-800 hover:bg-slate-700 px-8 py-4 rounded-2xl font-bold text-lg transition duration-300 w-full sm:w-auto">
                العودة للخلف
            </button>
        </div>
    </div>

    <!-- Decoration -->
    <div class="absolute top-0 left-0 w-full h-full pointer-events-none overflow-hidden">
        <div class="absolute -top-24 -left-24 w-96 h-96 bg-brand-500/10 rounded-full blur-[100px]"></div>
        <div class="absolute -bottom-24 -right-24 w-96 h-96 bg-brand-700/10 rounded-full blur-[100px]"></div>
    </div>
</body>
</html>
