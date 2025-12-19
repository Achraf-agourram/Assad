<!DOCTYPE html>
    <html lang="fr">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Admin</title>
        <script src="https://cdn.tailwindcss.com"></script>
    </head>

<?php
session_start();
include("../database.php");
function show_admin_page(){
    $usersTotal = extract_rows(request("SELECT COUNT(*) as total FROM `utilisateurs` WHERE role != 'admin';", null, null))[0]['total'];
    $guideAttente = extract_rows(request("SELECT COUNT(*) as attente FROM `utilisateurs` WHERE role = 'guide' AND !role_approuve;", null, null))[0]['attente'];
    $actifAccounts = extract_rows(request("SELECT COUNT(*) as actifAccounts FROM `utilisateurs` WHERE statut_compte AND role != 'admin';", null, null))[0]['actifAccounts'];

    echo '
        <body class="bg-gray-100 font-sans">

            <div class="flex min-h-screen">
                <aside class="w-64 bg-gray-900 text-white hidden md:block">
                    <div class="p-6">
                        <span class="text-2xl font-bold text-orange-500">🦁 ASSAD Admin</span>
                    </div>
                    <nav class="mt-6">
                        <a href="#" class="block py-3 px-6 bg-gray-800 border-l-4 border-orange-500">👤 Utilisateurs</a>
                        <a href="#" class="block py-3 px-6 hover:bg-gray-800 transition">🦁 Animaux (CRUD)</a>
                        <a href="#" class="block py-3 px-6 hover:bg-gray-800 transition">🌿 Habitats (CRUD)</a>
                        <a href="#" class="block py-3 px-6 hover:bg-gray-800 transition">📈 Statistiques</a>
                    </nav>
                </aside>

                <main class="flex-1 p-8">
                    <header class="flex justify-between items-center mb-8">
                        <h1 class="text-3xl font-bold text-gray-800">Gestion des Utilisateurs</h1>
                        <div class="flex items-center space-x-4">
                            <span class="text-sm text-gray-500">Connecté en tant que: <strong>Admin</strong></span>
                            <button class="text-red-500 hover:underline text-sm font-semibold">Déconnexion</button>
                        </div>
                    </header>

                    <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
                        <div class="bg-white p-6 rounded-xl shadow-sm border border-gray-100">
                            <p class="text-sm text-gray-500 font-medium uppercase">Total Utilisateurs</p>
                            <p class="text-3xl font-bold text-gray-900">'. $usersTotal . '</p>
                        </div>
                        <div class="bg-white p-6 rounded-xl shadow-sm border border-gray-100">
                            <p class="text-sm text-orange-500 font-medium uppercase">Guides en attente</p>
                            <p class="text-3xl font-bold text-gray-900">'. $guideAttente . '</p>
                        </div>
                        <div class="bg-white p-6 rounded-xl shadow-sm border border-gray-100">
                            <p class="text-sm text-green-500 font-medium uppercase">Comptes Actifs</p>
                            <p class="text-3xl font-bold text-gray-900">'. $actifAccounts . '</p>
                        </div>
                    </div>

                    <div class="bg-white rounded-xl shadow-md overflow-hidden border border-gray-200">
                        <div class="p-6 border-b border-gray-100 flex flex-col md:flex-row justify-between items-center gap-4">
                            <h2 class="text-xl font-semibold text-gray-800">Liste des comptes</h2>
                            <input type="text" placeholder="Rechercher un email ou nom..." class="p-2 border border-gray-300 rounded-lg w-full md:w-64 focus:ring-orange-500 focus:border-orange-500">
                        </div>
                        
                        <div class="overflow-x-auto">
                            <table class="w-full text-left">
                                <thead class="bg-gray-50 text-gray-600 uppercase text-xs font-bold">
                                    <tr>
                                        <th class="px-6 py-4">Nom / Email</th>
                                        <th class="px-6 py-4">Rôle</th>
                                        <th class="px-6 py-4">Statut Compte</th>
                                        <th class="px-6 py-4">Validation Rôle</th>
                                        <th class="px-6 py-4">Actions</th>
                                    </tr>
                                </thead>
                                <tbody class="divide-y divide-gray-100">
                                    
                                    <tr class="hover:bg-gray-50 transition">
                                        <td class="px-6 py-4">
                                            <div class="font-bold text-gray-900">Youssef El Amrani</div>
                                            <div class="text-sm text-gray-500">youssef@example.com</div>
                                        </td>
                                        <td class="px-6 py-4">
                                            <span class="px-3 py-1 bg-blue-100 text-blue-700 rounded-full text-xs font-semibold">GUIDE</span>
                                        </td>
                                        <td class="px-6 py-4">
                                            <span class="flex items-center text-green-600 text-sm">
                                                <span class="h-2 w-2 bg-green-600 rounded-full mr-2"></span> Actif
                                            </span>
                                        </td>
                                        <td class="px-6 py-4">
                                            <span class="px-3 py-1 bg-orange-100 text-orange-700 rounded-full text-xs font-semibold">EN ATTENTE</span>
                                        </td>
                                        <td class="px-6 py-4">
                                            <div class="flex space-x-2">
                                                <button onclick="approveGuide(1, "Youssef")" class="bg-green-500 hover:bg-green-600 text-white px-3 py-1 rounded text-xs font-bold transition">Approuver</button>
                                                <button onclick="toggleUserStatus(1, "désactiver")" class="bg-gray-200 hover:bg-gray-300 text-gray-700 px-3 py-1 rounded text-xs font-bold transition">Désactiver</button>
                                            </div>
                                        </td>
                                    </tr>

                                    <tr class="hover:bg-gray-50 transition">
                                        <td class="px-6 py-4">
                                            <div class="font-bold text-gray-900">Sarah Smith</div>
                                            <div class="text-sm text-gray-500">sarah.s@web.com</div>
                                        </td>
                                        <td class="px-6 py-4">
                                            <span class="px-3 py-1 bg-purple-100 text-purple-700 rounded-full text-xs font-semibold">VISITEUR</span>
                                        </td>
                                        <td class="px-6 py-4">
                                            <span class="flex items-center text-green-600 text-sm">
                                                <span class="h-2 w-2 bg-green-600 rounded-full mr-2"></span> Actif
                                            </span>
                                        </td>
                                        <td class="px-6 py-4 text-gray-400 text-xs italic">N/A</td>
                                        <td class="px-6 py-4">
                                            <button onclick="toggleUserStatus(2, "désactiver")" class="text-red-500 hover:text-red-700 text-sm font-semibold">Désactiver le compte</button>
                                        </td>
                                    </tr>

                                    <tr class="hover:bg-gray-50 transition bg-red-50">
                                        <td class="px-6 py-4">
                                            <div class="font-bold text-gray-900">John Doe</div>
                                            <div class="text-sm text-gray-500">john@spam.com</div>
                                        </td>
                                        <td class="px-6 py-4">
                                            <span class="px-3 py-1 bg-purple-100 text-purple-700 rounded-full text-xs font-semibold">VISITEUR</span>
                                        </td>
                                        <td class="px-6 py-4">
                                            <span class="flex items-center text-red-600 text-sm">
                                                <span class="h-2 w-2 bg-red-600 rounded-full mr-2"></span> Inactif
                                            </span>
                                        </td>
                                        <td class="px-6 py-4 text-gray-400 text-xs italic">N/A</td>
                                        <td class="px-6 py-4">
                                            <button onclick="toggleUserStatus(3, "activer")" class="bg-green-600 hover:bg-green-700 text-white px-3 py-1 rounded text-xs font-bold transition">Réactiver</button>
                                        </td>
                                    </tr>

                                </tbody>
                            </table>
                        </div>
                    </div>
                </main>
            </div>
            
        </body>

        </html>
    ';
}
function show_unavailable_page(){
    echo '
            <main class="flex-grow flex items-center justify-center px-6 py-12">
                <div class="text-center max-w-2xl">
                    
                    <div class="relative mb-8 flex justify-center">
                        <h1 class="text-[150px] md:text-[200px] font-black text-orange-200 leading-none select-none">
                            404
                        </h1>
                        <div class="absolute inset-0 flex items-center justify-center floating">
                            <span class="text-8xl">🦁</span>
                        </div>
                    </div>

                    <h2 class="text-3xl md:text-4xl font-extrabold text-gray-800 mb-4">
                        Oups ! Vous vous êtes égaré dans la savane...
                    </h2>
                    <p class="text-lg text-gray-600 mb-8 leading-relaxed">
                        Même le Lion de l Atlas ne trouve pas cette trace. Il semble que la page que vous cherchez n existe pas ou a été déplacée vers un autre habitat.
                    </p>

                    <div class="flex flex-col sm:flex-row justify-center gap-4">
                        <a href="../index.php" class="bg-orange-600 text-white font-bold px-8 py-4 rounded-full hover:bg-orange-700 transition shadow-lg flex items-center justify-center">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6" />
                            </svg>
                            Retourner à l accueil
                        </a>
                        <button onclick="window.history.back()" class="bg-white text-orange-600 border-2 border-orange-600 font-bold px-8 py-4 rounded-full hover:bg-orange-50 transition shadow-sm">
                            Page précédente
                        </button>
                    </div>
                </div>
            </main>
        </html>
    ';
}

if(isset($_SESSION['loggedAccount'])){
    $connectedUser = extract_rows(request("SELECT * FROM utilisateurs WHERE id = ?;", "i", [$_SESSION['loggedAccount']]));
    if($connectedUser[0]['role'] == 'admin'){
        show_admin_page();
    }else{show_unavailable_page();}
}
else{
    show_unavailable_page();
}
?>