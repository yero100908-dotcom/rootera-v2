{{-- Interactive Media Documentation Showcase (Before-After Photos & Video Reels) --}}
<div class="bg-slate-50/80 border-y border-slate-200/70 py-14">
@include('components.media-documentation', [
    'projectShowcases' => $projectShowcases ?? null,
    'relatedArticles'  => $relatedArticles ?? collect(),
    'locationName'     => $locationName,
    'locationShort'    => $locationShort
])
</div>
