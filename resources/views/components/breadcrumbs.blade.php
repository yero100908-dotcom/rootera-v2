{{-- Reusable Accessible HTML5 Breadcrumb Component --}}
@props(['items' => []])

@if(!empty($items) && is_array($items))
<nav class="breadcrumb-nav w-full py-2.5 px-1 mb-4 text-xs font-semibold text-slate-300" aria-label="Breadcrumb">
    <ol class="flex items-center flex-wrap gap-1.5 list-none m-0 p-0">
        @foreach($items as $index => $item)
            <li class="flex items-center gap-1.5">
                @if($index > 0)
                    <span class="text-slate-400 opacity-60 text-[10px]" aria-hidden="true">›</span>
                @endif

                @if(!$loop->last && !empty($item['url']))
                    <a href="{{ $item['url'] }}" class="text-white/80 hover:text-emerald-400 hover:underline transition-colors decoration-emerald-400/50 underline-offset-4">
                        {{ $item['name'] }}
                    </a>
                @else
                    <span class="text-emerald-300 font-bold" aria-current="page">
                        {{ $item['name'] }}
                    </span>
                @endif
            </li>
        @endforeach
    </ol>
</nav>
@endif
