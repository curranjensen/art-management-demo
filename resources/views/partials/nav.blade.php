<nav class="navbar navbar-default navbar-fixed-top">
    <div class="container">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="/"> {{ config('owner.company') }}</a>
        </div>
        <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">

            <ul class="nav navbar-nav navbar-right">
                <li class="{{ request()->is('pieces*') ? 'active' : '' }}"><a href="{{ route('pieces.index') }}">Images</a></li>
                <li class="dropdown {{ request()->is('details*') ? 'active' : '' }}">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Details <span class="caret"></span></a>
                    <ul class="dropdown-menu">
                        <li class=""><a href="{{ route('details.index') }}"><span class="glyphicon glyphicon-list" aria-hidden="true"></span> List</a></li>
                        <li class=""><a href="{{ route('details.index', 'grid') }}"><span class="glyphicon glyphicon-th" aria-hidden="true"></span> Grid</a></li>
                    </ul>
                </li>
                <li class="{{ request()->is('catalogue*') ? 'active' : '' }}"><a href="{{ route('catalogue.index') }}">Catalogue</a></li>
                <li class="{{ request()->is('tags*') ? 'active' : '' }}"><a href="{{ route('tags.index') }}">Tags</a></li>
                <li class="{{ request()->is('export*') ? 'active' : '' }}"><a href="{{ route('export.index') }}">Export</a></li>
                <li class="{{ request()->is('search*') ? 'active' : '' }}"><a href="#search">Search</a></li>
            </ul>
        </div>
    </div>
</nav>