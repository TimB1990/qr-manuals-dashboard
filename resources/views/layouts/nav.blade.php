<nav class="tabs is-boxed">
    <div class="navbar-menu" id="container">
        <div class="navbar-start">
            <ul>
                <router-link tag="li" to="/" exact>
                    <a>Home</a>
                </router-link>
                <router-link tag="li" to="/contact" exact>
                    <a>Contact</a>
                </router-link>
                <router-link tag="li" to="/manuals" exact>
                    <a>Manuals</a>
                </router-link>
            </ul>
        </div>
        <div class="navbar-end">
            <ul>
                <router-link tag="li" to="/uploads" exact>
                    <a> 
                        <span class="icon is-medium is-left">
                            <i class="fa fa-upload" aria-hidden="true"></i>
                        </span>
                        Upload
                    </a>
                </router-link>
            </ul>
        </div>
    </div>
</nav>