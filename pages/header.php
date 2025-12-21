<?php
    function head($title, $script){
        echo "
        <head>
            <meta charset='UTF-8'>
            <meta name='viewport' content='width=device-width, initial-scale=1.0'>
            <title>{$title}</title>
            <script src='https://cdn.tailwindcss.com'></script>
            <script src='{$script}' defer></script>
            <style>
                .lion-card:hover {
                    transform: scale(1.03);
                    box-shadow: 0 10px 15px -3px rgba(0, 0, 0, 0.1), 0 4px 6px -2px rgba(0, 0, 0, 0.05);
                }
                @keyframes fadeIn {
                    from { opacity: 0; transform: translateY(-10px); }
                    to { opacity: 1; transform: translateY(0); }
                }
            </style>
        </head>
        ";
    }
    function navbar(){
        echo "
        <header class='bg-white shadow-md sticky top-0 z-50'>
        <nav class='container mx-auto px-6 py-3 flex justify-between items-center'>
            <div class='text-2xl font-bold text-orange-500'>
                🦁 ASSAD - Zoo Virtuel
            </div>
            <div class='space-x-4 hidden md:flex'>
                <a href='index.php' class='text-orange-600 font-semibold hover:text-orange-700 transition duration-300'>Accueil</a>
                <a href='pages/animals.html' class='text-gray-600 hover:text-orange-700 transition duration-300'>Animaux</a>
                
        ";

        if(isset($_SESSION['loggedAccount'])){
            echo "
                <a href='pages/visits.html' class='text-gray-600 hover:text-orange-700 transition duration-300'>Visites</a>
            </div>
            <div class='flex items-center space-x-2'>
            ";
            $connectedUser = extract_rows(request("SELECT * FROM utilisateurs WHERE id = ?;", "i", [$_SESSION['loggedAccount']]));
            if($connectedUser[0]['role'] == 'admin'){
                echo "
                    <a href='admin/users.php' name='admin' class='bg-transparent border border-orange-700 text-orange-700 px-4 py-2 rounded-lg hover:bg-orange-500 hover:text-white transition duration-300'>
                        Admin
                    </a>
                ";
            }
            echo "
                <form method='POST'>
                    <button name='logout' class='bg-orange-500 text-white px-4 py-2 rounded-lg hover:bg-orange-800 transition duration-300'>
                        Deconnexion
                    </button>
                </form>
                ";
        }else{
            echo "
                </div>
                <div class='flex items-center space-x-2'>
                    <button id='btn-login' class='bg-transparent border border-orange-700 text-orange-700 px-4 py-2 rounded-lg hover:bg-orange-50 transition duration-300'>
                        Connexion
                    </button>
                    <button id='btn-register' class='bg-orange-500 text-white px-4 py-2 rounded-lg hover:bg-orange-800 transition duration-300'>
                        Inscription
                    </button>
            ";
        }

        echo "
                </div>
                </nav>
            </header>
        ";
    }
        
?>