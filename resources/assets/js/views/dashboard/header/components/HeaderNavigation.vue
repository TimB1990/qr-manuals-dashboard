<template>
    <section>
        <nav
            class="navigationbar"
            role="navigation"
            aria-label="main navigation"
        >
            <!-- navbar menu -->
            <div>
                <span>
                    <router-link :to="{ name: 'products' }"
                        >Products</router-link
                    >
                </span>
                <span>
                    <router-link :to="{ name: 'sheets' }"
                        >QR sheets</router-link
                    >
                </span>
                <span>
                    <router-link :to="{ name: 'quotations' }"
                        >Quotations</router-link
                    >
                </span>
                <span>
                    <router-link :to="{ name: 'scanner' }">Scanner</router-link>
                </span>
            </div>
            <div>
                <span>
                    <a><i @click="toggleProfilePopup" class="fas fa-user"></i></a>
                </span>
            </div>
        </nav>
        <div v-if="showProfilePopup" class="profile-popup">
            <p>
                {{ userEmail }}
            </p>
            <div>
                Profile Settings
                <i class="fas fa-cog"></i>
            </div>
            <div @click="logOut">
                Logout
                <i class="fas fa-sign-out-alt"></i>
            </div>
        </div>
        <code>{{ user }}</code>
    </section>
</template>

<script>
export default {
    name: "headerNavigation",
    data() {
        return {
            user: this.$store.state.user,
            showProfilePopup: false
        };
    },
    components: {},
    methods: {
        logOut() {
            this.user = {};
            this.$store.dispatch("logoutUser");
            console.log("logout: ", this.$store.state.user);
            this.$router.push("/");
        },
        toggleProfilePopup(){
          this.showProfilePopup = !this.showProfilePopup

        }
    },
    computed: {
        userEmail() {
            return this.$store.getters.getUserEmail;
        }
    }
};
</script>
