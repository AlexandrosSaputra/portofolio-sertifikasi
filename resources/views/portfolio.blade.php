<!DOCTYPE html>
<html lang="id" class="bg-ink">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="Portofolio Alexandros Saputra, mahasiswa Teknik Informatika dan software developer.">
    <meta name="theme-color" content="#050708">
    <title>Alexandros Saputra — Software Developer</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:ital,wght@0,400;0,500;0,600;0,700;1,400;1,500&amp;family=Raleway:wght@400;500;600;700;800&amp;display=swap" rel="stylesheet">
    <script>document.documentElement.classList.add('js');</script>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="site-body">
    <div class="ambient-layer" aria-hidden="true"></div>

    @include('partials.navigation')

    <main>
        @include('partials.sections.home')
        @include('partials.sections.about')
        @include('partials.sections.skills')
        @include('partials.sections.projects')
        @include('partials.sections.contact')
    </main>
</body>
</html>
