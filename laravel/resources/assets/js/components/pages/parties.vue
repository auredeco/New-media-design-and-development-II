<template>
    <div id="parties" class="container">
        <div class="card-field">
            <div class="standard-card" v-for="party in parties">
                <div class="card-wrapper">
                        <router-link :to="{ name: 'party', params: { id: party.id }}">
                            <img src="/images/logo-square.svg">
                            <h1>{{party.name}}</h1>
                        </router-link>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        data() {
            return {
                parties: [],
                filterQuery: '',
                checkboxValues: []
            }
        },

        methods: {
            loadData() {
                this.axios.get('/api/parties').then((response) => {
                    this.parties = response.data;
                });
            },
        },

        computed: {
            filterByName() {
                return this.parties.filter( party => {
                    return party.name.toLowerCase().indexOf(this.filterQuery.toLowerCase()) > -1 && party.isClosed == value;
                })
            },
        },

        mounted() {
            this.loadData();
            console.log('Elections mounted.');
        }
    }

</script>