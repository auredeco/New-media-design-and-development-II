<template>
    <div>
        <div id="cards">
            <paginate
                    name="elections"
                    :list="filterByName"
                    :per="5"
            >
                <input type="text" v-model="filterQuery" placeholder="Search...">
                <div class="standard-card" v-for="election in paginated('elections')">
                    <div class="card-wrapper">
                        <div class="card">
                            <img src="/images/logo-square.svg">
                            <div class="card-info">
                                <h1 class="title">{{ election.name }}</h1>
                                <p>
                                    {{ election.description }}
                            </p>
                                <ul>
                                    <li v-if="election.isClosed" class="closed">Status: Gesloten</li>
                                    <li v-else class="open">Status: Lopend</li>
                                </ul>
                            </div>
                        </div>
                        <div class="button-field">
                            <button class="btn blue">Stemmen</button>
                        </div>
                    </div>
                </div>
            </paginate>
        </div>
        <paginate-links for="elections" :limit="5"></paginate-links>
    </div>
</template>
<script>
    export default {
        data() {
            return {
                elections: [],
                paginate: ['elections'],
                filterQuery: ''
            }
        },

        methods: {
            loadData: function () {
                this.axios.get('/api/elections').then((response) => {
                    this.elections = response.data;
                });
            },
        },

        computed: {
            filterByName() {
                return this.elections.filter( election => {
                    return election.name.toLowerCase().indexOf(this.filterQuery.toLowerCase()) > -1;
                })
            }
        },

        mounted() {
            this.loadData();
            console.log('Elections mounted.');
        }
    }
</script>