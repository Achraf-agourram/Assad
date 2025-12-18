<?php
echo "
    <header class='bg-white shadow-md sticky top-0 z-50'>
        <nav class='container mx-auto px-6 py-3 flex justify-between items-center'>
            <div class='text-2xl font-bold text-orange-500'>
                🦁 ASSAD - Zoo Virtuel
            </div>
            <div class='space-x-4 hidden md:flex'>
                <a href='#' class='text-orange-600 font-semibold hover:text-orange-700 transition duration-300'>Accueil</a>
                <a href='pages/animals.html' class='text-gray-600 hover:text-orange-700 transition duration-300'>Animaux</a>
                <a href='pages/visits.html' class='text-gray-600 hover:text-orange-700 transition duration-300'>Visites</a>
            </div>
            <div class='flex items-center space-x-2'>
                <button id='btn-login' class='bg-transparent border border-orange-700 text-orange-700 px-4 py-2 rounded-lg hover:bg-orange-50 transition duration-300'>
                    Connexion
                </button>
                <button id='btn-register' class='bg-orange-500 text-white px-4 py-2 rounded-lg hover:bg-orange-800 transition duration-300'>
                    Inscription
                </button>
            </div>
        </nav>
    </header>
";
?>