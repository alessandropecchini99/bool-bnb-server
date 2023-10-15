@php
    $user = Auth::user();
@endphp

<header>
    <nav class="shadow-lg">
        <div class="myContainer">
            <!-- logo -->
            <a class="image" href="http://localhost:5174/">
                <img
                    src="{{ asset('logo-orizzontale.png') }}"
                    alt="logo"
                    class="ms-total"
                />
                <img src="{{ asset('logo-b.png') }}" alt="logo-small" class="ms-small"/>
            </a>

            <!-- routes -->
            <div class="routes btn-group">
                <div class="menu-dropdown">
                    <button
                        id="button"
                        type="button"
                        data-bs-toggle="dropdown"
                        data-bs-auto-close="inside"
                    >
                        <div id="icon"></div>
                    </button>
                    <ul class="dropdown-menu dropdown-menu-end">
                        <li>
                            <a class="dropdown-item" href="http://localhost:5174">
                                Home
                            </a>
                        </li>
                        <li>
                            <a class="dropdown-item w-100" href="{{ route('admin.dashboard') }}">Dashboard</a>
                        </li>
                        <li>
                            <a class="dropdown-item w-100" href="{{ route('profile.edit') }}">Edit profile</a>
                        </li>
                        <li>
                            <form class="dropdown-item" action="{{ route('logout') }}" method="post">
                                @csrf
                                <button class="btn btn-danger w-100">Log out</button>
                            </form>
                        </li>
                    </ul>
                </div>
                <!-- altra routes -->
                <div class="menu-off">
                    <button
                        id="btn"
                        type="button"
                        data-bs-toggle="offcanvas"
                        data-bs-target="#staticBackdrop"
                        aria-controls="offcanvasRight"
                    >
                        <div id="icn"></div>
                    </button>
                    <div
                        class="offcanvas offcanvas-end w-100"
                        data-bs-backdrop="static"
                        tabindex="-1"
                        id="staticBackdrop"
                        aria-labelledby="staticBackdropLabel"
                    >
                        <div class="offcanvas-header btn-position">
                            <button
                                type="button"
                                class="btn"
                                id="off-close"
                                data-bs-dismiss="offcanvas"
                                aria-label="Close"
                            >
                                <i class="fa-solid fa-xmark"></i>
                            </button>
                        </div>
                        <div class="offcanvas-body">
                            <div class="ms-routes">
                                <ul>
                                    <li>
                                        <button data-bs-dismiss="offcanvas" aria-label="Close"
                                                href="http://localhost:5174">
                                            <div class="drop-item">
                                                Home
                                            </div>
                                        </button>
                                    </li>
                                    <li>
                                        <button data-bs-dismiss="offcanvas" aria-label="Close"
                                                href="{{ route('admin.dashboard') }}">
                                            <div class="drop-item">
                                                Dashboard
                                            </div>
                                        </button>
                                    </li>
                                    <li>
                                        <button data-bs-dismiss="offcanvas" aria-label="Close"
                                                href="{{ route('profile.edit') }}">
                                            <div class="drop-item">
                                                Edit profile
                                            </div>
                                        </button>
                                    </li>
                                    <li>
                                        <button data-bs-dismiss="offcanvas" aria-label="Close" class="drop-item">
                                            <form action="{{ route('logout') }}" method="post">
                                                @csrf
                                                <button>Log out</button>
                                            </form>
                                        </button>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </nav>
</header>
