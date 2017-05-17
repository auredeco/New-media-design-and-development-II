<template>
    <div>
        <div id="cards">
            <paginate
                    name="elections"
                    :list="filterByName"
                    :per="5"
            >
                <div class="filters">
                    <input type="text" v-model="filterQuery" placeholder="Search...">
                    <input type="checkbox" id="0" value="0" v-model="checkboxValues"> Lopend
                    <input type="checkbox" id="1" value="1" v-model="checkboxValues"> Gesloten
                </div>
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
                            <router-link :to="{ name: 'election', params: { id: election.id }}">
                                <button class="btn blue">Stemmen</button>
                            </router-link>
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
                filterQuery: '',
                checkboxValues: []
            }
        },

        methods: {
            loadData() {
                this.axios.get('/api/elections').then((response) => {
                    this.elections = response.data;
                });
            },
        },

        computed: {
            filterByName() {
                return this.elections.filter( election => {
                    if(this.checkboxValues.length == null || this.checkboxValues.length == 0 || this.checkboxValues.length == 2){
                        return election.name.toLowerCase().indexOf(this.filterQuery.toLowerCase()) > -1;
                    }else{
                        let value = this.checkboxValues[0];
                        return election.name.toLowerCase().indexOf(this.filterQuery.toLowerCase()) > -1 && election.isClosed == value;
                    }
                })
            },
        },

        mounted() {
            this.loadData();
            console.log('Elections mounted.');
        }
    }
</script>