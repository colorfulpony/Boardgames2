<template>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">

                <div class="alert alert-danger" role="alert" v-if="error !== null">
                    {{ error }}
                </div>

                <div class="card card-default">
                    <div class="card-header">Login</div>
                    <div class="card-body">
                        <form>
                            <div class="form-group row">
                                <label for="email" class="col-sm-4 col-form-label text-md-right">E-Mail Address</label>
                                <div class="col-md-6">
                                    <input id="email" type="email" class="form-control" v-model="email" required
                                           autofocus autocomplete="off">
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="password" class="col-md-4 col-form-label text-md-right">Password</label>
                                <div class="col-md-6">
                                    <input id="password" type="password" class="form-control" v-model="password"
                                           required autocomplete="off">
                                </div>
                            </div>

                            <div class="form-group row mb-0">
                                <div class="col-md-8 offset-md-4">
                                    <button type="submit" class="btn btn-primary" @click.prevent="handleSubmit">
                                        Login
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import api from '../../api'
export default {
    data() {
        return {
            email: "",
            password: "",
            error: null,
            token: null
        }
    },
    methods: {
        handleSubmit() {
            api.post('/api/login', { email: this.email, password: this.password })
                .then(response => {
                    localStorage.setItem('X_XSRF_TOKEN', response.config.headers['X-XSRF-TOKEN'])
                    localStorage.setItem('USER_ROLE_ID', response.data.userRoleId)
                    this.emitter.emit("get-token-login", localStorage.getItem('X_XSRF_TOKEN'));
                    this.emitter.emit("get-user-role_id", response.data.userRoleId);
                    this.$router.push({name : 'dashboard'})
                })
                .catch(function (error) {
                    return Promise.reject(error);
                });
        },
    },
}
</script>
