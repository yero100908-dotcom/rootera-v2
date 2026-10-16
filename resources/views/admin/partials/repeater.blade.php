{{--
    Dynamic JSON repeater (vanilla JS, no Alpine dependency).
    Props:
      $name    – input base name (e.g. "landmarks" or "typical_issues")
      $label   – section label
      $fields  – null for string list, or ['issue' => 'Masalah', 'solution' => 'Solusi', ...] for row list
      $items   – current values (array)
      $hint    – optional helper text
      $min     – recommended minimum count (shown as badge)
--}}
@php
    $fields   = $fields ?? null;
    $items    = array_values((array) ($items ?? []));
    $hint     = $hint ?? null;
    $min      = $min ?? null;
    $uid      = 'rep_' . $name;
    $isRow    = is_array($fields);
    if (empty($items)) { $items = [$isRow ? array_fill_keys(array_keys($fields), '') : '']; }
@endphp

<div class="rounded-2xl border border-slate-200/80 bg-slate-50/50 p-5" data-repeater="{{ $uid }}">
    <div class="flex items-center justify-between mb-3">
        <div>
            <label class="block text-sm font-extrabold text-slate-800">{{ $label }}</label>
            @if($hint)<p class="text-xs text-slate-500 mt-0.5">{{ $hint }}</p>@endif
        </div>
        <div class="flex items-center gap-2">
            @if($min)
                <span class="text-[11px] font-bold px-2 py-0.5 rounded-full bg-amber-50 text-amber-700 border border-amber-200">min. {{ $min }} untuk skor</span>
            @endif
            <button type="button" onclick="repeaterAdd('{{ $uid }}')"
                class="text-xs font-bold px-3 py-1.5 rounded-lg bg-emerald-600 text-white hover:bg-emerald-700 transition">+ Tambah</button>
        </div>
    </div>

    <div class="space-y-2" data-repeater-list>
        @foreach($items as $i => $item)
            <div class="flex gap-2 items-start bg-white rounded-xl border border-slate-200 p-2" data-repeater-row>
                @if($isRow)
                    <div class="grid gap-2 flex-1 {{ count($fields) > 2 ? 'md:grid-cols-3' : 'md:grid-cols-2' }}">
                        @foreach($fields as $key => $placeholder)
                            <textarea rows="2" data-key="{{ $key }}" name="{{ $name }}[{{ $i }}][{{ $key }}]" placeholder="{{ $placeholder }}"
                                class="w-full text-sm rounded-lg border border-slate-200 px-3 py-2 focus:ring-2 focus:ring-emerald-500/30 focus:border-emerald-500">{{ is_array($item) ? ($item[$key] ?? '') : '' }}</textarea>
                        @endforeach
                    </div>
                @else
                    <input type="text" name="{{ $name }}[]" value="{{ is_string($item) ? $item : '' }}"
                        class="flex-1 text-sm rounded-lg border border-slate-200 px-3 py-2 focus:ring-2 focus:ring-emerald-500/30 focus:border-emerald-500">
                @endif
                <button type="button" onclick="repeaterRemove(this)" title="Hapus"
                    class="p-2 rounded-lg text-rose-600 hover:bg-rose-50 border border-slate-200 shrink-0">✕</button>
            </div>
        @endforeach
    </div>
</div>

@once
@push('scripts')
<script>
    function repeaterReindex(list) {
        list.querySelectorAll('[data-repeater-row]').forEach((row, idx) => {
            row.querySelectorAll('[data-key]').forEach(el => {
                el.name = el.name.replace(/\[\d+\]\[/, '[' + idx + '][');
            });
        });
    }
    function repeaterAdd(uid) {
        const wrap = document.querySelector('[data-repeater="' + uid + '"]');
        const list = wrap.querySelector('[data-repeater-list]');
        const tpl  = list.querySelector('[data-repeater-row]');
        const row  = tpl.cloneNode(true);
        row.querySelectorAll('input, textarea').forEach(el => el.value = '');
        list.appendChild(row);
        repeaterReindex(list);
        const first = row.querySelector('input, textarea'); if (first) first.focus();
    }
    function repeaterRemove(btn) {
        const list = btn.closest('[data-repeater-list]');
        const rows = list.querySelectorAll('[data-repeater-row]');
        if (rows.length <= 1) {
            rows[0].querySelectorAll('input, textarea').forEach(el => el.value = '');
            return;
        }
        btn.closest('[data-repeater-row]').remove();
        repeaterReindex(list);
    }
</script>
@endpush
@endonce
