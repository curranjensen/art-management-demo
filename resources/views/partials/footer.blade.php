<footer class="footer-distributed">
    <div class="container">
        <div class="footer-left">
            <p>
                <a href="#top">
                    <span class="glyphicon glyphicon-hand-up"></span> back to top
                </a>
            </p>
            <h3>
                @if($logoImage)
                <a href="{{ route('pieces.show', $logoImage->piece->number) }}"><img class="img-rounded" src="{{ $logoImage->thumbnail }}"></a>
                @endif
                {{ config('owner.company') }}
            </h3>
            <p class="footer-links">
                <a target="_blank" href="{{ config('owner.website') }}">Website</a>
                ·
                <a href="{{ route('featured.index') }}">Featured</a>
                ·
                <a href="{{ route('catalogue.index') }}">Catalogue</a>
                ·
                <a href="{{ route('pieces.index') }}">Images</a>
                ·
                <a href="{{ route('details.index') }}">Details</a>
                ·
                <a href="{{ route('tags.index') }}">Tags</a>
                ·
                <a href="{{ route('export.index') }}">Export</a>
            </p>
            <p class="footer-company-name">{{ config('owner.street') }}
                <br>{{ config('owner.city') }}
                <br>{{ config('owner.postal_code') }}</p>
            <br>
            <p class="footer-company-name">&copy; {{ date('Y') }} {{ config('owner.company') }}. Designed by <a href="http://www.curranjensen.com">Curran Jensen</a> </p>
        </div>
        <a name="search"></a>
        <div class="footer-right">
            <form method="get" action="{{ route('search.search') }}">
                <input placeholder="Search" name="q" />
                <i class="fa fa-search"></i>
            </form>
            <br>
            <a target="_blank" href="{{ config('owner.facebook') }}"><i class="fa fa-facebook"></i></a>
            <a target="_blank" href="{{ config('owner.twitter') }}"><i class="fa fa-twitter"></i></a>
            <a target="_blank" href="{{ config('owner.instagram') }}"><i class="fa fa-instagram"></i></a>
            <a target="_blank" href="{{ config('owner.youtube') }}"><i class="fa fa-youtube"></i></a>
        </div>
    </div>
</footer>