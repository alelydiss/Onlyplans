<x-app-layout>

  <style>
    html, body {
      height: 100%;
      margin: 0;
    }

    gmpx-store-locator {
      width: 100%;
      height: 600px;

      --gmpx-color-surface: #fff;
      --gmpx-color-on-surface: #212121;
      --gmpx-color-on-surface-variant: #757575;
      --gmpx-color-primary: #4f46e5;
      --gmpx-color-outline: #e0e0e0;
      --gmpx-fixed-panel-width-row-layout: 28.5em;
      --gmpx-fixed-panel-height-column-layout: 65%;
      --gmpx-font-family-base: "Roboto", sans-serif;
      --gmpx-font-family-headings: "Roboto", sans-serif;
      --gmpx-font-size-base: 0.875rem;
      --gmpx-hours-color-open: #22c55e;
      --gmpx-hours-color-closed: #ef4444;
      --gmpx-rating-color: #facc15;
      --gmpx-rating-color-empty: #e0e0e0;
    }
  </style>

  <script>
    const CONFIGURATION = {
      locations: [ /* tus ubicaciones */ ],
      mapOptions: {
        center: { lat: 37.4, lng: -5.9 },
        fullscreenControl: true,
        mapTypeControl: false,
        streetViewControl: false,
        zoom: 6,
        zoomControl: true,
        maxZoom: 17,
        mapId: ""
      },
      mapsApiKey: "AIzaSyDGgOGKw_sBxmxy8i44DmTYFUwfmjpSOAs",
      capabilities: {
        input: true,
        autocomplete: true,
        directions: true,
        distanceMatrix: true,
        details: true,
        actions: false
      }
    };
  </script>
  <script type="module">
    document.addEventListener('DOMContentLoaded', async () => {
      await customElements.whenDefined('gmpx-store-locator');
      const locator = document.querySelector('gmpx-store-locator');
      locator.configureFromQuickBuilder(CONFIGURATION);
    });
  </script>
</head>

<body class="bg-gray-50 text-gray-800 min-h-screen flex flex-col">

  <!-- Título -->
  <header class="text-center my-8 px-4">
    <h2 class="text-3xl font-bold">Explora eventos en el mapa</h2>
    <p class="text-gray-500 mt-2">Descubre planes según tu ubicación o preferencia</p>
  </header>

  <!-- Mapa -->
  <section class="flex justify-center items-center mb-12 px-4">
    <div class="w-full max-w-7xl shadow rounded overflow-hidden">
      <script type="module" src="https://ajax.googleapis.com/ajax/libs/@googlemaps/extended-component-library/0.6.11/index.min.js"></script>
      <gmpx-api-loader key="AIzaSyDGgOGKw_sBxmxy8i44DmTYFUwfmjpSOAs" solution-channel="GMP_QB_locatorplus_v11_cABCDE"></gmpx-api-loader>
      <gmpx-store-locator map-id="DEMO_MAP_ID"></gmpx-store-locator>
    </div>
  </section>

  <!-- Footer -->
  <footer class="bg-gray-900 text-gray-400 text-sm py-8">
    <div class="max-w-7xl mx-auto px-4 grid grid-cols-1 md:grid-cols-3 gap-8">
      <div>
        <h3 class="text-white font-semibold mb-2">OnlyPlans</h3>
        <p>Conecta con planes cerca de ti y descubre lo que ocurre en tu ciudad con nuevos amigos.</p>
      </div>
      <div>
        <h3 class="text-white font-semibold mb-2">Enlaces</h3>
        <ul>
          <li><a href="/terminos" class="hover:text-white">Términos y condiciones</a></li>
          <li><a href="/politica" class="hover:text-white">Política de privacidad</a></li>
          <li><a href="/contacto" class="hover:text-white">Contacto</a></li>
        </ul>
      </div>
      <div>
        <h3 class="text-white font-semibold mb-2">Síguenos</h3>
        <ul>
          <li><a href="#" class="hover:text-white">Instagram</a></li>
          <li><a href="#" class="hover:text-white">YouTube</a></li>
          <li><a href="#" class="hover:text-white">TikTok</a></li>
        </ul>
      </div>
    </div>
    <div class="text-center mt-6 text-gray-500">© 2025 OnlyPlans. Todos los derechos reservados.</div>
  </footer>

</body>
</x-app-layout>