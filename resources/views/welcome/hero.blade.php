<!-- Include this script tag or install `@tailwindplus/elements` via npm: -->
<!-- <script src="https://cdn.jsdelivr.net/npm/@tailwindplus/elements@1" type="module"></script> -->

<section class="grid md:grid-cols-2 items-center gap-10 max-w-7xl w-full mb-32">
    {{-- Texte principal --}}
    <div class="text-center md:text-left space-y-6">
        <h1 class="text-5xl font-extrabold leading-tight">
            BookMe : Trouvez et Réservez <span class="text-blue-600">les Meilleurs Services Locaux</span><br> en 3 Clics.
        </h1>
        <p class="text-lg text-gray-600 max-w-md mx-auto md:mx-0">
            Coiffeur, coach sportif, électricien, photographe... Tous les professionnels dont vous avez besoin, disponibles à portée de main.        </p>
        <div class="flex flex-col sm:flex-row gap-4 justify-center md:justify-start">
            <a href="#features"
               class="bg-blue-600 hover:bg-blue-700 text-white px-8 py-3 rounded-full font-semibold transition duration-300 shadow-md">
                Explorer les catégories de services
            </a>
            <a href="#contact"
               class="border border-blue-600 text-blue-600 hover:bg-blue-600 hover:text-white px-8 py-3 rounded-full font-semibold transition duration-300">
                Nous Contacter
            </a>
        </div>
    </div>

    {{-- Illustration Hero --}}
    <div class="flex justify-center md:justify-end">
        <img src="heroSection.png"
             alt="Hero Illustration"
             class="w-96 md:w-[28rem]  transition-transform duration-500">
    </div>
</section>
