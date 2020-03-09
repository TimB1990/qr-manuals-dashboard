<template>
  <section>
    <nav class="navbar is-light" role="navigation" aria-label="main navigation">
      <!-- navbar brand -->
      <div class="navbar-brand">
        <a href="./" class="navbar-item">
          <img id="logo" src="/img/EXALTO-TG-logo-WEB.png" />
        </a>
        <a role="button" class="navbar-burger" aria-label="menu" aria-expanded="false">
          <span aria-hidden="true"></span>
          <span aria-hidden="true"></span>
          <span aria-hidden="true"></span>
        </a>
      </div>

      <!-- <div class="navbar-menu">
        hown on mobile
      </div> -->

      <!-- navbar menu -->
      <div class="navbar-menu">
        <div class="navbar-start">
          <router-link class="navbar-item" to="Home">
            <span class="icon">
              <i class="fa fa-tachometer"></i>
            </span>
            <span>Dashboard</span>
          </router-link>
        </div>

        <div class="navbar-end">
          <div class="navbar-item">
            <div class="buttons">
              <a class="button">
                <span>Profile</span>
                <span class="icon">
                  <i class="fa fa-user"></i>
                </span>
              </a>
              <a class="button">
                <span>Log out</span>
                <span class="icon">
                  <i class="fa fa-sign-out"></i>
                </span>
              </a>
            </div>
          </div>
        </div>
      </div>
      <!-- -->
    </nav>
  </section>
</template>

<script>
export default {
  name: "headerNavigation",
  components: {}
};
</script>

<style scoped>
nav {
  padding-top: 10px;
  padding-bottom: 10px;
}
</style>



