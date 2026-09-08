{{-- Interactive Media Documentation Showcase (Before-After Photos & Video Reels) --}}
<div class="bg-slate-100 py-16 border-y border-slate-200">
@include('components.media-documentation', [
    'projectShowcases' => $projectShowcases ?? null,
    'relatedArticles'  => $relatedArticles ?? collect(),
    'locationName'     => $locationName,
    'locationShort'    => $locationShort
])
</div>
