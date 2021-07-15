<template>
    <div class="container mt-3">
        <h1 class="title flex">Login</h1>
        <strong v-if="error" class="text-danger underlined">{{ error }}</strong>
        <div v-if="!secrets.length" class="row">
            <form action="#" @submit.prevent="handleLogin">
                <div class="form-row p-3">
                    <input type="email" v-model="formData.email">
                </div>
                <div class="form-row p-3">
                    <input type="password" v-model="formData.password">
                </div>
                <div class="form-row p-3">
                    <button type="submit">Sign In</button>
                </div>
            </form>
        </div>
        <div>
        <div v-if="secrets.length" class="row">
            <div class="secret" v-for="(secret, index) in secrets" :key="index">
                <strong v-text="secret.secret"></strong> - created at <span v-text="secret.created_at"></span>
            </div>
        </div>
    </div>
    </div>
</template>

<script>
export default {
    data() {
        return {
            secrets: [],
            formData: {
                email: '',
                password: ''
            },
            error: ''
        }
    },
    methods: {
        handleLogin(e) {
            console.log('saludos')
            axios.get('/sanctum/csrf-cookie').then((res) => {
                axios.post('/login', this.formData).then(res => {
                    this.getSecrets()
                }).catch((err) => {
                    const resp = JSON.parse(err.response.request.response)
                    console.log('resp: ', resp.errors.email)
                    if (resp.errors.email) {
                        this.error = resp.errors.email[0]
                    }
                })
            }).catch(err => console.log('err: ', err))
        },
        getSecrets() {
            axios.get('/api/secrets').then(res => {
                console.log('data_: ', res.data)
                this.secrets = res.data})
        }
    }
}
</script>

<style>

</style>