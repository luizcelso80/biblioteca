<template>
    <div class="container">
        <h1></h1>
    </div>
</template>

<script>
    export default {
        props: [
            'token'
        ],
        mounted() {
            console.log('Component mounted.')
            console.log(this.token)
            console.log(this.getSessionId())
        },
        data () {
            return {
                pagSeguro: {
                    session_id: null,
                }
            }
        },

        methods: {
            getSessionId () {
                return new Promise((resolve, reject) => {
                    //axios.get(`https://ws.sandbox.pagseguro.uol.com.br/v2/sessions?${this.token}`)
                    //https://ws.sandbox.pagseguro.uol.com.br/{{api-endpoint}}?email={{email}}&token={{token-sandbox}}
                    axios.get(`https://ws.sandbox.pagseguro.uol.com.br/v2/sessions?email=dev@limabauru.com.br&token=${this.token}`)
                            .then(response => {
                                console.log(response)
                            })
                            .catch(error => reject(error))
                            // .finally(() => context.commit('PRELOADER', false))
                })
            }
        }
    }
</script>
