@forelse($activos as $activo)
    @php
        $estadoColor = $activo->estado == 'Activo' ? 'bg-secondary' : ($activo->estado == 'En Reparación' ? 'bg-orange-500' : 'bg-gray-500');
    @endphp
    <tr class="bg-white dark:bg-gray-800/50 hover:bg-gray-50 dark:hover:bg-gray-700/50 border-b dark:border-gray-700">
        <td class="px-3 py-2 font-medium text-gray-900 dark:text-white">{{ $loop->iteration }}</td>
        <td class="px-3 py-2 max-w-32 truncate" title="{{ $activo->sucursal_area }}">{{ $activo->sucursal_area }}</td>
        <td class="px-3 py-2 max-w-32 truncate" title="{{ $activo->razon_social }}">{{ $activo->razon_social }}</td>
        <td class="px-3 py-2 font-mono">{{ $activo->codigo_barras }}</td>
        <td class="px-3 py-2">{{ $activo->marca }}</td>
        <td class="px-3 py-2 max-w-40 truncate" title="{{ $activo->modelo }}">{{ $activo->modelo }}</td>
        <td class="px-3 py-2">{{ $activo->sd }}</td>
        <td class="px-3 py-2">{{ $activo->ram }}</td>
        <td class="px-3 py-2 max-w-32 truncate" title="{{ $activo->procesador }}">{{ $activo->procesador }}</td>
        <td class="px-3 py-2 max-w-32 truncate" title="{{ $activo->asignado }}">{{ $activo->asignado ?? 'Sin asignar' }}</td>
        <td class="px-3 py-2">
            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium 
                {{ $activo->estado == 'Activo' ? 'bg-secondary/10 text-secondary-800 dark:bg-secondary/20 dark:text-secondary-300' : 
                   ($activo->estado == 'En Reparación' ? 'bg-orange-500/10 text-orange-800 dark:bg-orange-500/20 dark:text-orange-300' : 
                   'bg-gray-500/10 text-gray-800 dark:bg-gray-600/20 dark:text-gray-300') }}">
                <span class="w-2 h-2 mr-2 rounded-full {{ $estadoColor }}"></span>
                {{ $activo->estado }}
            </span>
        </td>
        <td class="px-3 py-2 text-right">
            <div class="flex items-center justify-end gap-x-1">
                <button onclick="editarActivo({{ $activo->id }})" class="p-1.5 rounded-md text-gray-500 hover:bg-gray-100 dark:hover:bg-gray-700">
                    <span class="material-symbols-outlined text-base">edit</span>
                </button>
                <form action="{{ route('activos.destroy', $activo) }}" method="POST" class="inline">
                    @csrf @method('DELETE')
                    <button type="submit" onclick="return confirm('¿Eliminar?')" class="p-1.5 rounded-md text-red-600 hover:bg-red-50 dark:hover:bg-red-900/40">
                        <span class="material-symbols-outlined text-base">delete</span>
                    </button>
                </form>
            </div>
        </td>
    </tr>
@empty
    <tr><td colspan="12" class="text-center py-12 text-gray-500 dark:text-gray-400">No se encontraron activos.</td></tr>
@endforelse