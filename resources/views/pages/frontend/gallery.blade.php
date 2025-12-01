@extends('layouts.frontend.master')

@section('content')

@php
    // list kategori unik (fallback kalau belum ada kategori)
    $categories = $gallery->pluck('category')->filter()->unique()->values();
    $totalPhotos = $gallery->count();
@endphp

<style>
    /* ---------- LAYOUT ---------- */
    .gallery-controls {
        display:flex;
        flex-wrap:wrap;
        gap:12px;
        align-items:center;
        justify-content:center;
        margin-bottom:28px;
    }
    .filter-btn {
        border:1px solid #cfe8d7;
        background:#fff;
        color:#2b6a46;
        padding:8px 14px;
        border-radius:999px;
        font-weight:600;
        cursor:pointer;
        transition:all .18s ease;
        box-shadow:0 2px 6px rgba(0,0,0,0.04);
    }
    .filter-btn.active {
        background:#2b6a46;
        color:#fff;
        transform:translateY(-2px);
        box-shadow:0 6px 18px rgba(43,106,70,0.18);
    }

    .gallery-meta {
        color:#556b5a;
        font-size:14px;
        margin-left:8px;
        font-weight:600;
    }

    .gallery-grid {
        display:grid;
        grid-template-columns:repeat(3, 1fr);
        gap:28px;
    }

    /* responsive */
    @media (max-width: 992px) {
        .gallery-grid { grid-template-columns:repeat(2, 1fr); }
    }
    @media (max-width: 576px) {
        .gallery-grid { grid-template-columns:repeat(1, 1fr); }
    }

    /* ---------- CARD ---------- */
    .gallery-card {
        display:flex;
        flex-direction:column;
        background:#fff;
        border-radius:14px;
        overflow:hidden;
        box-shadow:0 8px 28px rgba(16,24,40,0.06);
        transition:transform .22s ease, box-shadow .22s ease, opacity .35s ease;
        opacity:1;
    }
    .gallery-card.hidden {
        opacity:0;
        transform:scale(.99);
        pointer-events:none;
        height:0;
        margin:0;
        padding:0;
    }

    .gallery-thumb {
        position:relative;
        width:100%;
        aspect-ratio:1 / 1; /* square */
        overflow:hidden;
        background:#f2f5f2;
    }
    .gallery-thumb img {
        width:100%;
        height:100%;
        object-fit:cover;
        display:block;
        transition:transform .4s ease;
    }
    .gallery-thumb:hover img { transform:scale(1.06); }

    .card-body {
        padding:14px 16px 18px 16px;
        text-align:left;
    }
    .card-title {
        font-size:15px;
        font-weight:700;
        color:#1f3f2e;
        margin-bottom:8px;
        min-height:40px;
    }
    .card-sub {
        display:flex;
        align-items:center;
        gap:10px;
        color:#6b7c70;
        font-size:13px;
    }
    .card-date { font-size:13px; color:#889487; margin-top:8px; }

    /* ---------- LOAD MORE ---------- */
    .load-more-wrap { text-align:center; margin-top:26px; }
    .btn-load-more {
        padding:10px 18px;
        border-radius:10px;
        border:1px solid #d2e6d8;
        background:#fff;
        color:#2b6a46;
        font-weight:700;
        cursor:pointer;
        box-shadow:0 6px 18px rgba(43,106,70,0.06);
    }

    /* ---------- MODAL ---------- */
    .gallery-modal {
        display:none;
        position:fixed;
        inset:0;
        z-index:99999;
        background:rgba(6,10,12,0.75);
        backdrop-filter: blur(4px);
        align-items:center;
        justify-content:center;
        padding:28px;
    }
    .gallery-modal.open { display:flex; }

    .modal-card {
        max-width:1100px;
        width:100%;
        border-radius:12px;
        overflow:hidden;
        background:transparent;
        text-align:center;
    }
    .modal-image {
        width:100%;
        max-height:75vh;
        object-fit:contain;
        border-radius:10px;
        box-shadow:0 12px 42px rgba(0,0,0,0.5);
        margin-bottom:16px;
    }
    .modal-info {
        color:#fff;
        text-align:left;
        background:linear-gradient(180deg, rgba(0,0,0,0.18), rgba(0,0,0,0.28));
        padding:12px 18px;
        border-radius:10px;
    }
    .modal-caption { font-size:20px; font-weight:700; margin-bottom:6px; color:#f7fff7; }
    .modal-date { font-size:14px; color:#d8e7d9; margin-bottom:10px; }

    .modal-actions { display:flex; gap:8px; flex-wrap:wrap; margin-top:8px; }
    .share-btn {
        display:inline-flex;
        gap:8px;
        align-items:center;
        padding:8px 12px;
        border-radius:8px;
        background:rgba(255,255,255,0.06);
        color:#fff;
        border:1px solid rgba(255,255,255,0.06);
        cursor:pointer;
        font-weight:600;
        text-decoration:none;
    }

    .modal-close {
        position:absolute;
        top:18px;
        right:22px;
        font-size:28px;
        color:#fff;
        cursor:pointer;
        opacity:.95;
    }

    /* subtle appearing animation */
    .gallery-card, .gallery-card img { will-change: transform, opacity; }
</style>

<div class="wrapper">

    {{-- PAGE TITLE --}}
    <section class="page-title page-title-layout1 bg-overlay bg-overlay-2 bg-parallax text-center">
        <div class="bg-img">
            <img src="{{ url('solatec/assets/images/page-titles/7.jpg') }}" alt="background">
        </div>

        <div class="container">
            <h1 class="pagetitle__heading mb-0">Galeri dan Dokumentasi</h1>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb justify-content-center">
                    <li class="breadcrumb-item"><a href="#">Beranda</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Galeri</li>
                </ol>
            </nav>
        </div>
    </section>

    {{-- CONTROLS: FILTER + COUNTER --}}
    <section class="py-4">
        <div class="container">
            <div class="gallery-controls">
                <button class="filter-btn active" data-filter="*">Semua</button>

                @foreach ($categories as $cat)
                    <button class="filter-btn" data-filter="{{ \Illuminate\Support\Str::slug($cat) }}">
                        {{ $cat }}
                    </button>
                @endforeach

                <div class="gallery-meta" aria-live="polite">
                    Total foto: <strong id="photoCounter">{{ $totalPhotos }}</strong>
                </div>
            </div>
        </div>
    </section>

    {{-- GALLERY GRID --}}
    <section id="gallery" class="gallery py-3">
        <div class="container">
            <div class="gallery-grid" id="galleryGrid">

                @foreach ($gallery as $index => $glrs)
                    @php
                        $catSlug = $glrs->category ? \Illuminate\Support\Str::slug($glrs->category) : 'uncategorized';
                        $formattedDate = \Carbon\Carbon::parse($glrs->created_at)->translatedFormat('d F Y');
                    @endphp

                    <article class="gallery-card" 
                             data-category="{{ $catSlug }}" 
                             data-index="{{ $index }}" 
                             role="article"
                             aria-label="{{ $glrs->caption ?? 'Foto galeri' }}">

                        <div class="gallery-thumb" tabindex="0"
                             data-img="{{ url('storage/images/' . $glrs->foto) }}"
                             data-caption="{{ $glrs->caption ?? '' }}"
                             data-date="{{ $formattedDate }}">
                            {{-- lazy loading: data-src + loading fallback handled by JS --}}
                            <img class="lazy" data-src="{{ url('storage/images/' . $glrs->foto) }}" alt="{{ $glrs->caption ?? 'Foto galeri' }}" loading="lazy">
                        </div>

                        <div class="card-body">
                            <div class="card-title">{{ $glrs->caption ?? 'Tidak ada caption' }}</div>
                            <div class="card-sub">
                                <span class="badge-category" style="background:#eef7ef;padding:6px 8px;border-radius:6px;color:#2b6a46;font-weight:700;">
                                    {{ $glrs->category ?? 'Uncategorized' }}
                                </span>
                                <span class="card-date">{{ $formattedDate }}</span>
                            </div>
                        </div>
                    </article>
                @endforeach

            </div>

            {{-- LOAD MORE --}}
            <div class="load-more-wrap">
                <button id="loadMoreBtn" class="btn-load-more" aria-label="Muat lebih banyak foto">Muat Lebih</button>
            </div>
        </div>
    </section>

</div>

{{-- MODAL --}}
<div id="galleryModal" class="gallery-modal" role="dialog" aria-modal="true" aria-hidden="true">
    <div class="modal-close" id="modalClose" aria-label="Tutup">&times;</div>

    <div class="modal-card" role="document">
        <img id="modalImage" class="modal-image" src="" alt="">
        <div class="modal-info">
            <div class="modal-caption" id="modalCaption">Caption</div>
            <div class="modal-date" id="modalDate">Tanggal</div>

            <div class="modal-actions" id="modalActions">
                <a id="shareWhatsapp" class="share-btn" target="_blank" rel="noopener noreferrer" aria-label="Bagikan lewat WhatsApp">
                    <svg width="16" height="16" viewBox="0 0 24 24" fill="none"><path d="M..." fill="currentColor"/></svg>
                    WhatsApp
                </a>

                <a id="shareFacebook" class="share-btn" target="_blank" rel="noopener noreferrer" aria-label="Bagikan lewat Facebook">
                    <svg width="16" height="16" viewBox="0 0 24 24" fill="none"><path d="M..." fill="currentColor"/></svg>
                    Facebook
                </a>

                <a id="shareTwitter" class="share-btn" target="_blank" rel="noopener noreferrer" aria-label="Bagikan lewat Twitter">
                    <svg width="16" height="16" viewBox="0 0 24 24" fill="none"><path d="M..." fill="currentColor"/></svg>
                    Twitter
                </a>
            </div>
        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function () {
    // Basic state
    const cards = Array.from(document.querySelectorAll('.gallery-card'));
    const grid = document.getElementById('galleryGrid');
    const filterButtons = Array.from(document.querySelectorAll('.filter-btn'));
    const loadMoreBtn = document.getElementById('loadMoreBtn');
    const photoCounterEl = document.getElementById('photoCounter');

    // Modal elements
    const modal = document.getElementById('galleryModal');
    const modalImg = document.getElementById('modalImage');
    const modalCaption = document.getElementById('modalCaption');
    const modalDate = document.getElementById('modalDate');
    const modalClose = document.getElementById('modalClose');
    const shareWhatsapp = document.getElementById('shareWhatsapp');
    const shareFacebook = document.getElementById('shareFacebook');
    const shareTwitter = document.getElementById('shareTwitter');

    // LOAD MORE settings
    const PER_PAGE = 9; // initial 9 (3x3)
    let visibleCount = PER_PAGE;

    // Initialize: hide all, then reveal first visibleCount
    function refreshVisibility() {
        const activeFilter = document.querySelector('.filter-btn.active')?.dataset.filter || '*';
        let shown = 0;

        cards.forEach((card, idx) => {
            const cat = card.dataset.category || '';
            const matchesFilter = (activeFilter === '*' || activeFilter === cat);

            if (matchesFilter && shown < visibleCount) {
                card.classList.remove('hidden');
                shown++;
            } else {
                card.classList.add('hidden');
            }
        });

        // Hide Load More if all visible under current filter
        const totalMatching = cards.filter(c => (activeFilter === '*' || c.dataset.category === activeFilter)).length;
        if (visibleCount >= totalMatching) {
            loadMoreBtn.style.display = 'none';
        } else {
            loadMoreBtn.style.display = 'inline-block';
        }

        // Update counter (showing X of Y)
        photoCounterEl.innerText = totalMatching;
    }

    // Filters
    filterButtons.forEach(btn => {
        btn.addEventListener('click', () => {
            filterButtons.forEach(b => b.classList.remove('active'));
            btn.classList.add('active');

            // Reset visibleCount when changing filter so users see first page of that filter
            visibleCount = PER_PAGE;
            refreshVisibility();

            // smooth scroll up to controls on mobile for convenience
            btn.scrollIntoView({ behavior: 'smooth', block: 'center' });
        });
    });

    // Load more handler
    loadMoreBtn.addEventListener('click', () => {
        visibleCount += PER_PAGE;
        refreshVisibility();
    });

    // Lazy loading via IntersectionObserver (for modern browsers)
    const lazyImages = Array.from(document.querySelectorAll('img.lazy'));
    if ('IntersectionObserver' in window) {
        const io = new IntersectionObserver((entries, obs) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    const img = entry.target;
                    const src = img.dataset.src;
                    if (src) {
                        img.src = src;
                        img.removeAttribute('data-src');
                        img.classList.remove('lazy');
                    }
                    obs.unobserve(img);
                }
            });
        }, { rootMargin: '100px' });

        lazyImages.forEach(img => io.observe(img));
    } else {
        // fallback: load all images (still uses native loading="lazy")
        lazyImages.forEach(img => {
            if (img.dataset.src) { img.src = img.dataset.src; img.removeAttribute('data-src'); }
        });
    }

    // Click to open modal (on thumbnail area)
    document.querySelectorAll('.gallery-thumb').forEach(thumb => {
        const onOpen = (ev) => {
            const imgUrl = thumb.dataset.img;
            const caption = thumb.dataset.caption || '';
            const date = thumb.dataset.date || '';

            modalImg.src = imgUrl;
            modalImg.alt = caption || 'Foto';
            modalCaption.textContent = caption;
            modalDate.textContent = date;

            // build share links (encode)
            const pageUrl = encodeURIComponent(window.location.href + '?img=' + encodeURIComponent(imgUrl));
            const text = encodeURIComponent(caption + ' — ' + date);

            shareWhatsapp.href = `https://api.whatsapp.com/send?text=${text}%20${pageUrl}`;
            shareFacebook.href = `https://www.facebook.com/sharer/sharer.php?u=${pageUrl}&quote=${text}`;
            shareTwitter.href = `https://twitter.com/intent/tweet?text=${text}&url=${pageUrl}`;

            // open modal
            modal.classList.add('open');
            modal.setAttribute('aria-hidden', 'false');
            document.body.style.overflow = 'hidden'; // lock scroll
        };

        thumb.addEventListener('click', onOpen);
        thumb.addEventListener('keydown', (e) => {
            if (e.key === 'Enter' || e.key === ' ') {
                e.preventDefault();
                onOpen();
            }
        });
    });

    // Close modal handlers
    modalClose.addEventListener('click', () => {
        modal.classList.remove('open');
        modal.setAttribute('aria-hidden', 'true');
        document.body.style.overflow = '';
        modalImg.src = '';
    });
    modal.addEventListener('click', (e) => {
        if (e.target === modal) {
            modalClose.click();
        }
    });
    document.addEventListener('keydown', (e) => {
        if (e.key === 'Escape' && modal.classList.contains('open')) modalClose.click();
    });

    // Initial setup: hide all cards then show initial set
    // Add small staggered animation
    cards.forEach((c, i) => {
        c.style.transitionDelay = `${(i % 6) * 30}ms`;
    });

    refreshVisibility();

    // Optional: support query param to open an image directly (?img=url)
    (function openFromQuery() {
        try {
            const params = new URLSearchParams(window.location.search);
            const imgParam = params.get('img');
            if (!imgParam) return;
            // Find card with that image
            const target = cards.find(c => c.querySelector('.gallery-thumb')?.dataset.img === imgParam);
            if (target) {
                const thumb = target.querySelector('.gallery-thumb');
                setTimeout(() => thumb.click(), 400);
            }
        } catch (err) {}
    })();
});
</script>

@endsection
