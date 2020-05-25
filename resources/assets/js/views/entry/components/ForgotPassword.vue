<template>
    <div class="root">
        <div class="dialog">
            <div class="dialog-header">
                <img src="/img/EXALTO-TG-logo-WEB.png" />
            </div>
            <!--<form autocomplete="off" @submit.prevent="" method="post"></form>-->
            <div>
                <p><b>Send Token</b></p>
                <div class="field-container">
                    <i class="fas fa-at icon"></i>
                    <input
                        :class="{
                            'is-invalid': errorEmail,
                            'is-valid': infoEmail
                        }"
                        v-model="email"
                        type="text"
                        placeholder="example@exalto.com"
                    />
                    <button class="btn" @click="sentToken">
                        Send
                    </button>
                </div>

                <div>
                    <div>{{ errorEmail }}</div>
                    <div>{{ infoEmail }}</div>
                </div>

                <div>
                    <p><b>Input Token</b></p>
                    <form v-on:submit.prevent="validateToken">
                        <div class="field-container">
                            <i class="fas fa-key icon"></i>
                            <input
                                :class="{
                                    'is-invalid': errorToken,
                                    'is-valid': infoToken
                                }"
                                placeholder="token"
                                v-model="token"
                            />
                        </div>
                        <div>{{ errorToken }}</div>
                        <div>{{ infoToken }}</div>
                        <button class="btn" type="submit">Validate Token</button>
                    </form>
                </div>

                <div v-if="tokenValid">
                    <p><b>Change Password</b></p>
                    <form v-on:submit.prevent="changePassword">
                        <div class="field-container">
                            <i class="fas fa-key icon"></i>
                            <input
                                v-model="newPassword"
                                type="password"
                                :class="{ 'is-invalid': errorNewPassword }"
                                placeholder="new password"
                            />
                            <div>{{ errorNewPassword }}</div>
                        </div>
                        <div class="field-container">
                          <i class="fas fa-key icon"></i>
                            <input
                                v-model="passwordAgain"
                                type="password"
                                :class="{ 'is-invalid': errorPasswordAgain }"
                                placeholder="password again"
                            />
                            <div>{{ errorPasswordAgain }}</div>
                        </div>
                        <button class="btn" type="submit">Change password</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    name: "forgotPassword",
    props: ["app"],
    data() {
        return {
            email: null,
            has_error: false,
            infoEmail: null,
            infoToken: null,
            response: null,
            errorEmail: null,
            token: "",
            errorToken: null,
            newPassword: "",
            errorNewPassword: null,
            passwordAgain: "",
            errorPasswordAgain: null,
            tokenValid: false,
            user: null
        };
    },
    methods: {
        sentToken() {
            this.errorEmail = null;
            if (!this.email) {
                this.errorEmail = "Email required";
            }

            if (!this.errorEmail) {
                const data = {
                    email: this.email
                };

                axios
                    .post("api/send-token", data)
                    .then(() => {
                        this.infoEmail = "Email sent";
                    })
                    .catch(error => {
                        this.errorEmail = error.response.data.error;
                    });
            }
        },
        validateToken() {
            this.errorToken = null;

            if (!this.token) {
                this.errorToken = "Token required";
            }

            if (!this.errorToken) {
                const data = { token: this.token };
                axios
                    .post("api/validate-token", data)
                    .then(response => {
                        if (response.data.id) {
                            this.tokenValid = true;
                            this.infoToken = "Token is valid";
                            this.user = response.data;
                        }
                    })
                    .catch(error => {
                        this.errorToken = error.response.data.error;
                    });
            }
        },
        changePassword() {
            this.errorNewPassword = null;
            this.errorPasswordAgain = null;

            if (!this.newPassword) {
                this.errorNewPassword = "New password is required";
            }

            if (!this.passwordAgain) {
                this.errorPasswordAgain = "Password confirmation required";
            }

            if (this.newPassword !== this.passwordAgain) {
                this.errorPasswordAgain = "Passwords do not mach";
            }

            if (!this.errorNewPassword && !this.errorPasswordAgain) {
                const data = {
                    password: this.newPassword,
                    user_id: this.user.id
                };

                axios.post("api/reset-password", data).then(() => {
                    this.$router.push({ name: "entry" });
                });
            }
        }
    }
};
</script>
<style>
.is-invalid {
    border: 1px solid red;
}
.is-valid {
    border: 1px solid green;
}
</style>
