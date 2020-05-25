<template>
  <section>
    <nav class="navigationbar" role="navigation" aria-label="main navigation">
      <!-- navbar menu -->
      <div>
        <span>
          <a> {{ userEmail }} <i class="fas fa-user"></i></a>
        </span>
      </div>

      <div>
        <span>
          <router-link :to="{ name: 'products'}">Products</router-link>
        </span>
        <span>
          <router-link :to="{ name: 'quotations'}">Quotations</router-link>
        </span>
        <span>
          <router-link :to="{ name: 'scanner'}">Scanner</router-link>
        </span>
        <span>
          <a @click="logOut">
            sign out
            <i class="fa fa-sign-out-alt" />
          </a>
        </span>
      </div>
    </nav>
  </section>
</template>

<script>
export default {
  name: "headerNavigation",
  data() {
    return {
      user: this.$store.state.user
    };
  },
  components: {},
  methods: {
    logOut() {
      this.user = {};
      this.$store.dispatch("logoutUser");
      console.log("logout: ", this.$store.state.user);
      this.$router.push("/");
    }
  },
  computed: {
    userEmail(){
      return this.$store.getters.getUserEmail;
    }
  }
};
</script>



