@props(['tickets', 'estado'])

<div class="bg-white dark:bg-gray-800 rounded-xl shadow-md overflow-hidden">
  <div class="px-6 py-4 border-b border-gray-200 dark:border-gray-700 flex justify-between items-center">
    <h2 class="text-lg font-semibold text-gray-800 dark:text-gray-100">Tickets {{ $estado }}</h2>
    <span class="text-sm text-gray-500 dark:text-gray-300">{{ count($tickets) }} ticket(s)</span>
  </div>

  @forelse ($tickets as $ticket)
    <a href="{{ route('admin.tickets.show', $ticket['id']) }}" class="block hover:bg-gray-50 dark:hover:bg-gray-700 transition border-b border-gray-200 dark:border-gray-700 last:border-b-0">
      <div class="px-6 py-4 flex justify-between">
        <div>
          <h3 class="text-lg font-medium text-gray-900 dark:text-gray-100">{{ $ticket['titulo'] }}</h3>
          <p class="text-sm text-gray-500 dark:text-gray-400">Usuario: {{ $ticket['usuario'] }}</p>
        </div>
        <div class="text-right">
          <span class="text-sm text-gray-500 dark:text-gray-400">{{ $ticket['fecha_formateada'] }}</span>
          <div class="mt-1">
            <span class="inline-block px-2 py-0.5 text-xs font-semibold rounded-full 
              {{ $estado === 'Revisado' ? 'bg-green-100 dark:bg-green-900 text-green-800 dark:text-green-300' : 'bg-yellow-100 dark:bg-yellow-900 text-yellow-800 dark:text-yellow-300' }}">
              {{ $estado }}
            </span>
          </div>
        </div>
      </div>
    </a>
  @empty
    <div class="p-8 text-center text-gray-500 dark:text-gray-300">No hay tickets {{ strtolower($estado) }}.</div>
  @endforelse
</div>
