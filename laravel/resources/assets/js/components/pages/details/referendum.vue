<template>
    <h1>referendum</h1>
</template>

<script>
    export default {
        data() {
            return {
                referendum: [],
            }
        },

        methods: {
            loadData: function (id) {
                this.axios.get('/api/referenda/' + id).then((response) => {
                    this.referendum = response.data;
                    console.log(this.referendum)
                });
            },
        },
        mounted() {
            this.loadData(this.$route.params.id);
            console.log('Referendum mounted.')
            console.log(this.$route.params.id)
        }
    }
</script>