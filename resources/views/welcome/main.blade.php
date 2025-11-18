<main class="flex flex-col items-center justify-center bg-gradient-to-b from-gray-100 via-gray-50 to-white text-gray-800 py-24 px-6">

    {{-- Section Hero --}}
    @include('welcome.hero')
    {{-- Section Features --}}
    <section id="features" class="max-w-6xl w-full mb-32">
        <h2 class="text-3xl font-bold text-center mb-12">Pourquoi choisir notre solution ?</h2>
        <div class="grid md:grid-cols-3 gap-10 ">
            <div class="bg-white shadow-md rounded-2xl p-8 transition hover:-translate-y-1 duration-300 text-center">
                <div class="text-blue-600 text-4xl mb-4">
                    <i class="fa-solid fa-gauge-high"></i>
                </div>
                <h3 class="text-xl font-semibold mb-2">Haute Performance</h3>
                <p class="text-gray-600">Laravel optimise le rendu côté serveur et Tailwind améliore la vitesse de chargement grâce à sa légèreté.</p>
            </div>

            <div class="bg-white shadow-md rounded-2xl p-8 hover:-translate-y-1 transition duration-300 text-center">
                <div class="text-green-600 text-4xl mb-4">
                    <i class="fa-solid fa-cubes"></i>
                </div>
                <h3 class="text-xl font-semibold mb-2">Composants Dynamiques</h3>
                <p class="text-gray-600">Intégrez facilement des composants Livewire pour un rendu dynamique sans JavaScript complexe.</p>
            </div>

            <div class="bg-white shadow-md rounded-2xl p-8 hover:-translate-y-1 transition duration-300 text-center">
                <div class="text-purple-600 text-4xl mb-4">
                    <i class="fa-solid fa-lock"></i>
                </div>
                <h3 class="text-xl font-semibold mb-2">Sécurité Renforcée</h3>
                <p class="text-gray-600">Jetstream offre une authentification robuste et une gestion des utilisateurs prête à l’emploi.</p>
            </div>
        </div>
    </section>

    {{-- Section Contact --}}
    <section id="contact" class="max-w-4xl w-full text-center bg-white/60 backdrop-blur-md shadow-lg rounded-3xl p-10">
        <h2 class="text-3xl font-bold mb-6">Contactez-nous</h2>
        <p class="text-gray-600 mb-8">
            Vous souhaitez en savoir plus ou démarrer un projet avec nous ? Remplissez le formulaire ci-dessous.
        </p>
        <form class="grid gap-4 text-left">
            <input type="text" placeholder="Votre nom" class="p-3 rounded-lg border border-gray-300 bg-white w-full focus:outline-none focus:ring-2 focus:ring-blue-500">
            <input type="email" placeholder="Votre email" class="p-3 rounded-lg border border-gray-300 bg-white w-full focus:outline-none focus:ring-2 focus:ring-blue-500">
            <textarea placeholder="Votre message" rows="4" class="p-3 rounded-lg border border-gray-300 bg-white w-full focus:outline-none focus:ring-2 focus:ring-blue-500"></textarea>
            <button type="submit"
                    class="bg-blue-600 hover:bg-blue-700 text-white px-8 py-3 rounded-full font-semibold transition duration-300 w-full">
                Envoyer le message
            </button>
        </form>
    </section>

</main>
