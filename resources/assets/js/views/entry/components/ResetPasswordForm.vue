<template>
  <div class="root">
    <div class="dialog">
      <div class="dialog-header">
        <img src="/img/EXALTO-TG-logo-WEB.png" />
      </div>
      <div>
        <form autocomplete="off" @submit.prevent="" method="post">
          <div class="field-container">
            <i class="fas fa-at icon"></i>
            <input type="email" id="email" placeholder="user@exalto.com" v-model="email" required />
          </div>
          <div class="field-container">
            <i class="fas fa-key icon"></i>
            <input
              id="password"
              v-model="password"
              type="password"
              placeholder="password..."
              required
            />
          </div>
          <div class="field-container">
            <i class="fas fa-key icon"></i>
            <input
              id="password_confirmation"
              v-model="password_confirmation"
              type="password"
              placeholder="password..."
              required
            />
          </div>
          <button type="submit" class="submit-button">Update</button>
        </form>

        <div class="dialog-footer"></div>
      </div>
    </div>
  </div>
</template>

<script>
export default {
  name: "resetPasswordForm",
  data() {
    return {
      token: null,
      email: null,
      password: null,
      password_confirmation: null,
      has_error: false
    };
  },
  methods: {
    resetPassword() {
      axios
        .post("api/auth/reset/password", {
          token: this.$route.params.token,
          email: this.email,
          password: this.password,
          password_confirmation: this.password_confirmation
        })
        .then(result => {
          this.$router.push({ name: "entry" });
        })
        .catch(error => {
          console.log(error);
        });
    }
  }
};
</script>