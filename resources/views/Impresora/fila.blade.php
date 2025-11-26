{{-- resources/views/impresoras/fila.blade.php --}}
@php
    $estadoColor = $estatus == 'Rentada' ? 'bg-orange-500' :
                   ($estatus == 'Comprada' ? 'bg-secondary' : 'bg-gray-500');
@endphp

<tr class="bg-white dark:bg-gray-800/50 hover:bg-gray-50 dark:hover:bg-gray-700/50 border-b dark:border-gray-700">
    <td class="px-3 py-2 font-medium text-gray-900 dark:text-white">{{ $loop->iteration }}</td>
    <td class="px-3 py-2 max-w-32 truncate" title="{{ $proveedor }}">{{ $proveedor }}</td>
    <td class="px-3 py-2 font-medium text-primary max-w-32 truncate" title="{{ $sucursal }}">{{ $sucursal }}</td>
    <td class="px-3 py-2 max-w-40 truncate" title="{{ $nombre_fiscal }}">{{ $nombre_fiscal }}</td>
    <td class="px-3 py-2">
        <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium
            {{ $marca == 'Kyocera' ? 'bg-emerald-100 text-emerald-800 dark:bg-emerald-900/40 dark:text-emerald-300' :
               ($marca == 'Canon' ? 'bg-red-100 text-red-800 dark:bg-red-900/40 dark:text-red-300' :
               'bg-blue-100 text-blue-800 dark:bg-blue-900/40 dark:text-blue-300') }}">
            {{ $marca }}
        </span>
    </td>
    <td class="px-3 py-2">{{ $modelo }}</td>
    <td class="px-3 py-2 font-mono bg-yellow-50 dark:bg-yellow-900/20 px-2 py-1 rounded">{{ $numero_serial }}</td>
    <td class="px-3 py-2 font-mono text-blue-600 dark:text-blue-400">{{ $direccion_ip ?? '—' }}</td>
    <td class="px-3 py-2">
        <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium 
            {{ $estatus == 'Rentada' ? 'bg-orange-500/10 text-orange-800 dark:bg-orange-500/20 dark:text-orange-300' : 
               ($estatus == 'Comprada' ? 'bg-secondary/10 text-secondary-800 dark:bg-secondary/20 dark:text-secondary-300' : 
               'bg-gray-500/10 text-gray-800 dark:bg-gray-600/20 dark:text-gray-300') }}">
            <span class="w-2 h-2 mr-2 rounded-full {{ $estadoColor }}"></span>
            {{ $estatus }}
        </span>
    </td>
    <td class="px-3 py-2 text-right">
        <div class="flex items-center justify-end gap-x-1">
            <button onclick="editar({{ $id }})" class="p-1.5 rounded-md text-gray-500 hover:bg-gray-100 dark:hover:bg-gray-700">
                <span class="material-symbols-outlined text-base">edit</span>
            </button>
            <form action="{{ route('impresoras.destroy', $id) }}" method="POST" class="inline">
                @csrf @method('DELETE')
                <button type="submit" onclick="return confirm('¿Eliminar esta impresora?')" class="p-1.5 rounded-md text-red-600 hover:bg-red-50 dark:hover:bg-red-900/40">
                    <span class="material-symbols-outlined text-base">delete</span>
                </button>
            </form>
        </div>
    </td>
</tr>