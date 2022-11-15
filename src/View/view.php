<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <link href="https://unpkg.com/tailwindcss@^2/dist/tailwind.min.css" rel="stylesheet">
    <script defer src="https://unpkg.com/alpinejs@3.2.4/dist/cdn.min.js"></script>
    <title><?php echo $pagetitle; ?></title>
</head>
<body>
<header>
    <nav class="bg-gray-800">
        <div class="mx-auto max-w-7xl px-2 sm:px-6 lg:px-8">
            <div class="relative flex h-16 items-center justify-between">
                <div class="flex flex-1 items-center justify-center sm:items-stretch sm:justify-start">
                    <div class="flex flex-shrink-0 items-center">
                        <img src="./assets/alteer.png" class="block aspect-auto object-cover h-10 w-auto">
                    </div>
                    <div class="hidden sm:ml-6 sm:block">
                        <div class="flex space-x-4">
                            <a href="frontController.php"
                               class="bg-gray-900 text-white px-3 py-2 rounded-md text-sm font-medium"
                               aria-current="page">Accueil</a>
                        </div>
                    </div>
                </div>
                <div class="absolute inset-y-0 right-0 flex justify-center items-center pr-2 sm:static sm:inset-auto sm:ml-6 sm:pr-0">

                    <!-- Profile dropdown -->
                    <div class="container flex justify-center mx-auto">
                        <div x-data="{ open: false }" @mouseleave="open = false" class="relative">
                            <!-- Dropdown toggle button -->
                            <button @mouseover="open = true" class="flex items-center block p-2 rounded-md">
                            <span
                                    class="flex rounded-full bg-gray-800 text-sm focus:outline-none focus:ring-2 focus:ring-white focus:ring-offset-2 focus:ring-offset-gray-800"
                                    id="user-menu-button" aria-expanded="false" aria-haspopup="true">
                                    <img class="h-8 w-8 rounded-full"
                                         src="https://images.unsplash.com/photo-1472099645785-5658abf4ff4e?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=facearea&facepad=2&w=256&h=256&q=80"
                                         alt="">

                            </span>
                            </button>
                            <div x-show="open"
                                 x-transition:enter.duration.500ms
                                 x-transition:leave.duration.1000ms
                                 class="absolute right-0 w-48 py-2 mt-2 bg-white bg-gray-100 rounded-md shadow-xl">
                                <a href="#"
                                   class="block px-4 py-2 text-sm text-gray-300 text-gray-700 hover:bg-gray-400 hover:text-white">
                                    Historique de transactions
                                </a>
                                <a href="#"
                                   class="block px-4 py-2 text-sm text-gray-300 text-gray-700 hover:bg-gray-400 hover:text-white">
                                    Préferences & Sécurité
                                </a>
                                <a href="#"
                                   class="block px-4 py-2 text-sm text-gray-300 text-gray-700 hover:bg-gray-400 hover:text-white">
                                    Se déconnecter
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </nav>
</header>
<main>
    <section>
        <?php
        require __DIR__ . "/{$cheminVueBody}";
        ?>
    </section>
</main>

<footer>
    <!-- à renseigner-->
</footer>

</body>
</html>