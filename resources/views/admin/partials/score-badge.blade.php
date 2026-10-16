{{-- Content score badge. Props: $score (int), $threshold (int) --}}
@php
    $score = (int) ($score ?? 0);
    $ok    = $score >= $threshold;
    $mid   = !$ok && $score >= 40;
    $cls   = $ok ? 'bg-emerald-100 text-emerald-800 border-emerald-200' : ($mid ? 'bg-amber-100 text-amber-800 border-amber-200' : 'bg-rose-100 text-rose-700 border-rose-200');
    $bar   = $ok ? 'bg-emerald-500' : ($mid ? 'bg-amber-500' : 'bg-rose-500');
@endphp
<div class="inline-flex flex-col items-center gap-1 min-w-[72px]">
    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-extrabold border {{ $cls }}">{{ $score }}/100</span>
    <span class="w-16 h-1.5 rounded-full bg-slate-200 overflow-hidden"><span class="block h-full {{ $bar }}" style="width: {{ min(100, $score) }}%"></span></span>
</div>
