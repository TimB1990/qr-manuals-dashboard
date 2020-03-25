<template>
  <div class="root">
    <div class="dialog">
      <div class="dialog-header">
        <img src="/img/EXALTO-TG-logo-WEB.png" />
      </div>
      <div>
        <div class="field-container">
          <i class="fas fa-at icon"></i>
          <input v-model="email" type="text" placeholder="example@exalto.com" />
        </div>
        <div class="field-container">
          <i class="fas fa-key icon"></i>
          <input v-model="password" type="password" placeholder="password..." />
        </div>
        <div class="dialog-footer">
          <!--<div></div>-->
          <button @click="login" class="submit-button">Submit</button>
          <a>I forgot my password...</a>
        </div>
      </div>
    </div>
  </div>
</template>


<script>
export default {
  name: "entry",
  data() {
    return {
      email: "",
      password: "",
      token: ""
    };
  },
  methods: {
    login() {
      axios
        .post("/api/login", {
          email: this.email,
          password: this.password
        })
        .then(res => {
          console.log(res);
          this.token = res.data.success.token;
        })
        .catch(err => {
          console.log(err);
        });
    }
  }
};
</script>

<style>
.root {
  display: flex;
  align-items: center;
  justify-content: center;
}
.dialog {
  margin-top: 16px;
  padding: 18px;
  width: 380px;
  border: 1px solid hsl(0, 0%, 76%);
  border-radius: 16px;
  background-image: linear-gradient(to bottom right, hsl(0, 0%, 98%), white);
  box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19);
}

.field-container {
  display: flex;
  margin-bottom: 12px;
  border-radius: 6px;
  align-items: baseline;
  padding: 8px;
  border: 1px solid hsl(0, 0%, 76%);
}

.field-container > input {
  width: 100%;
  padding: 6px;
  border: 1px solid hsl(0, 0%, 76%);
  background-color: transparent;
}

.submit-button {
  margin: 3px 3px 3px 3px;
  background-color: white;
  color: hsl(0, 0%, 50%);
  border: 1px solid hsl(0, 0%, 76%);
  padding: 8px 12px 8px 12px;
  /*border-radius: 6px;*/
  text-align: center;
  text-decoration: none;
  width: 80px;
  font-size: 14px;
  outline: none;
}

.submit-button:hover {
  border: 1px solid hsl(0, 0%, 40%);
  font-weight: bold;
  color: hsl(0, 0%, 40%);
}

.icon {
  padding-top: 12px;
  padding-bottom: 12px;
  padding-left: 16px;
  padding-right: 16px;
}

.dialog-header > img {
  height: 80px;
  width: auto;
}
/*.dialog-footer{
   display: flex;
   align-items: center;
   justify-content: space-between;
}*/

.dialog-footer {
  display: flex;
  /*flex-direction: column;*/
  justify-content: space-between;
  align-items: center;
  font-size: 12px;
}
</style>