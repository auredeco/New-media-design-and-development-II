<template>
    <!--<h1>{{election.name}}</h1>-->
    <!--<p>Status: -->
        <!--<span v-if="election.isClosed">Closed</span>-->
        <!--<span v-else>Closed</span>-->
    </p>
</template>

<script>
    export default {
        data() {
            return {
                election: [],
            }
        },

        methods: {
            loadData: function (id) {
                this.axios.get('/api/elections/' + id).then((response) => {
                    this.election = response.data;
                    console.log(this.election)
                });
            },
        },
        mounted() {
            this.loadData(this.$route.params.id);
            console.log('Election mounted.')
            console.log(this.$route.params.id)
        }
    }
</script>