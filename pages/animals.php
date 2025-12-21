<?php
include("../database.php");
include("header.php");
$connectedUser = null;
session_start();
$animals = extract_rows(request("SELECT nom, espece, alimentation, image, paysorigine, descriptioncourte, nb_consultations, habitats.h_name FROM `animaux` JOIN habitats ON animaux.id_habitat = habitats.id;", null, null))
?>


<!DOCTYPE html>
<html lang="fr">
<?php head("Animaux", ""); ?>

<body class="bg-gray-100 font-sans">
    <?php navbar(['../index.php', 'animals.php', 'visits.php', '../admin/users.php'], 'animals'); ?>
    <main class="mb-16 p-4">
        <h2 class="text-3xl font-bold text-orange-500 mb-8 border-b-2 border-orange-600 pb-2">🌍 Explorer les Animaux
            Africains</h2>

        <div class="bg-white p-6 rounded-lg shadow-md mb-8">
            <div class="flex flex-col space-y-4 md:flex-row md:space-y-0 md:space-x-4">

                <div class="relative flex-grow">
                    <input type="text" id="search-animal" placeholder="Rechercher par nom ou espèce..."
                        class="w-full p-3 pl-10 border border-gray-300 rounded-lg focus:ring-orange-500 focus:border-orange-500">
                    <svg class="absolute left-3 top-1/2 transform -translate-y-1/2 w-5 h-5 text-gray-400" fill="none"
                        stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                    </svg>
                </div>

                <select id="filter-habitat" class="p-3 border border-gray-300 rounded-lg bg-white w-full md:w-auto">
                    <option value="">Filtrer par Habitat</option>
                    <option value="foret">Forêt Tropicale</option>
                    <option value="savane">Savane</option>
                    <option value="desert">Désert</option>
                    <option value="aquatique">Aquatique</option>
                </select>

                <select id="filter-country" class="p-3 border border-gray-300 rounded-lg bg-white w-full md:w-auto">
                    <option value="">Filtrer par Pays Africain</option>
                    <option value="maroc">Maroc</option>
                    <option value="kenya">Kenya</option>
                    <option value="afrique_du_sud">Afrique du Sud</option>
                </select>

                <button id="btn-apply-filter"
                    class="bg-orange-500 text-white px-6 py-3 rounded-lg font-semibold hover:bg-orange-600 transition duration-300 w-full md:w-auto">
                    Appliquer
                </button>
            </div>
        </div>

        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-8">

            <?php
                foreach($animals as $animal){
                    echo "
                        <div title='{$animal['descriptioncourte']}' class='bg-white rounded-xl shadow-lg overflow-hidden transform hover:scale-[1.02] transition duration-300 ease-in-out'>
                            <img src='../images/{$animal['image']}' alt='{$animal['nom']}'
                                class='w-full h-48 object-cover'>
                            <div class='p-4'>
                                <h3 class='text-xl font-bold text-gray-900'>{$animal['nom']}</h3>
                                <p class='text-sm text-gray-600'>Espèce: *{$animal['espece']}*</p>
                                <div class='mt-2 text-xs font-semibold'>
                                    <span
                                        class='inline-block bg-orange-200 text-orange-800 rounded-full px-3 py-1 mr-2'>{$animal['paysorigine']}</span>
                                    <span class='inline-block bg-yellow-200 text-yellow-800 rounded-full px-3 py-1'>{$animal['h_name']}</span>
                                </div>
                            </div>
                        </div>
                    ";
                }
            ?>

        </div>
    </main>

</body>

</html>