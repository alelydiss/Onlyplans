@extends('layouts.app')

@section('content')

<style>
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
    locations: [
      {
        position: { lat: 40.416775, lng: -3.703790 },
        title: "Madrid",
        address: "Madrid, España",
        placeId: "ChIJgTwKgJcpQg0RaSKMYcHeNsQ",
        detailsUrl: "/eventos/madrid"
      },
      {
        position: { lat: 41.387917, lng: 2.169919 },
        title: "Barcelona",
        address: "Barcelona, España",
        placeId: "ChIJ5TCOcRaYpBIRCmZHTz37sEQ",
        detailsUrl: "/eventos/barcelona"
      },
      {
        position: { lat: 39.469907, lng: -0.376288 },
        title: "Valencia",
        address: "Valencia, España",
        placeId: "ChIJzXOz2Q9PYA0RkRxeWHZrE8Q",
        detailsUrl: "/eventos/valencia"
      },
      {
        position: { lat: 37.388630, lng: -5.982328 },
        title: "Sevilla",
        address: "Sevilla, España",
        placeId: "ChIJAVkDPzd1oRIRy4qU7Hj4BzQ",
        detailsUrl: "/eventos/sevilla"
      },
      {
        position: { lat: 43.263012, lng: -2.934985 },
        title: "Bilbao",
        address: "Bilbao, España",
        placeId: "ChIJgTwKgJcpQg0RaSKMYcHeNsQ",
        detailsUrl: "/eventos/bilbao"
      }
    ],
    mapOptions: {
      center: { lat: 40.416775, lng: -3.703790 }, // Centro inicial en Madrid
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

  document.addEventListener('DOMContentLoaded', async () => {
    if (navigator.geolocation) {
      navigator.geolocation.getCurrentPosition(
        (position) => {
          const userLat = position.coords.latitude;
          const userLng = position.coords.longitude;
          CONFIGURATION.mapOptions.center = { lat: userLat, lng: userLng };
        },
        (error) => {
          console.error('Error obteniendo la ubicación:', error);
        }
      );
    }

    await customElements.whenDefined('gmpx-store-locator');
    const locator = document.querySelector('gmpx-store-locator');
    locator.configureFromQuickBuilder(CONFIGURATION);
  });
</script>

<script type="module" src="https://ajax.googleapis.com/ajax/libs/@googlemaps/extended-component-library/0.6.11/index.min.js"></script>

<div class="bg-white dark:bg-gray-900 text-gray-900 dark:text-white font-sans antialiased h-[800px] mt-[-32px]">
  <header class="text-center my-8 px-4">
    <h2 class="text-3xl font-bold">Explora eventos en el mapa</h2>
    <p class="text-gray-500 mt-2">Descubre planes según tu ubicación o preferencia</p>
  </header>

  <section class="flex justify-center items-center mb-12 px-4">
    <div class="w-full max-w-7xl shadow rounded overflow-hidden">
      <gmpx-api-loader key="AIzaSyDGgOGKw_sBxmxy8i44DmTYFUwfmjpSOAs" solution-channel="GMP_QB_locatorplus_v11_cABCDE"></gmpx-api-loader>
      <gmpx-store-locator map-id="bdba4700e35d9695cb8874ce "></gmpx-store-locator>
    </div>
  </section>
</div>

@endsection
