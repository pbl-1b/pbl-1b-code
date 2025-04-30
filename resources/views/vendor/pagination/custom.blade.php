@if ($paginator->hasPages())
    <div class="flex items-center justify-between mt-4 border-t border-gray-200 pt-4">
        <div class="text-sm text-gray-500">
            Showing 
            <span class="font-medium">{{ $paginator->firstItem() }}</span> 
            to 
            <span class="font-medium">{{ $paginator->lastItem() }}</span> 
            of 
            <span class="font-medium">{{ $paginator->total() }}</span> 
            results
        </div>

        <div class="flex gap-1">
            {{-- Previous Page Link --}}
            @if ($paginator->onFirstPage())
                <button class="px-3 py-1 border border-gray-300 rounded-md text-sm text-gray-700 bg-white opacity-50 cursor-not-allowed" disabled>
                    Previous
                </button>
            @else
                <a href="{{ $paginator->previousPageUrl() }}" class="px-3 py-1 border border-gray-300 rounded-md text-sm text-gray-700 bg-white hover:bg-gray-50">
                    Previous
                </a>
            @endif

            {{-- Pagination Elements --}}
            @foreach ($elements as $element)
                {{-- "Three Dots" Separator --}}
                @if (is_string($element))
                    <button class="px-3 py-1 border border-gray-300 rounded-md text-sm text-gray-700 bg-white opacity-50 cursor-not-allowed" disabled>
                        {{ $element }}
                    </button>
                @endif

                {{-- Array Of Links --}}
                @if (is_array($element))
                    @foreach ($element as $page => $url)
                        @if ($page == $paginator->currentPage())
                            <span class="min-w-[40px] px-3 py-1 border rounded-md text-sm bg-green-600 text-white border-green-600">
                                {{ $page }}
                            </span>
                        @else
                            <a href="{{ $url }}" class="min-w-[40px] px-3 py-1 border rounded-md text-sm bg-white text-gray-700 border-gray-300 hover:bg-gray-50">
                                {{ $page }}
                            </a>
                        @endif
                    @endforeach
                @endif
            @endforeach

            {{-- Next Page Link --}}
            @if ($paginator->hasMorePages())
                <a href="{{ $paginator->nextPageUrl() }}" class="px-3 py-1 border border-gray-300 rounded-md text-sm text-gray-700 bg-white hover:bg-gray-50">
                    Next
                </a>
            @else
                <button class="px-3 py-1 border border-gray-300 rounded-md text-sm text-gray-700 bg-white opacity-50 cursor-not-allowed" disabled>
                    Next
                </button>
            @endif
        </div>
    </div>
@endif
