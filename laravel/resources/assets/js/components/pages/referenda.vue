<template>
    <div id="referenda" class="container">
            <paginate
                    name="referenda"
                    :list="filterByName"
                    :per="5"
            >
                <div class="filters">
                    <div class="searchfield">
                        <figure class="icon">
                            <img src="images/magnifier.svg" class="search"/>
                        </figure>
                        <input type="text" v-model="filterQuery" placeholder="Search...">
                    </div>
                    <div class="checkboxes">
                        <input type="checkbox" id="0" value="0" v-model="checkboxValues"> Lopend
                        <input type="checkbox" id="1" value="1" v-model="checkboxValues"> Gesloten
                    </div>
                    <router-link :to="{ name: 'newReferenda'}">nieuw</router-link>
                </div>
                <div class="card-field">
                    <div class="standard-card" v-for="item in paginated('referenda')">
                        <div class="card-wrapper">
                            <div class="card">
                                <p>{{item.title}}</p>
                                <p>{{item.description}}</p>
                                <p>Status:
                                    <span v-if="item.isClosed">Closed</span>
                                    <span v-else >Open</span>
                                </p>
                                <p>
                                    <router-link :to="{ name: 'referendum', params: { id: item.id }}">lees meer</router-link>
                                </p>
                            </div>
                        </div>
                    </div>
                </div>

            </paginate>
        <paginate-links for="referenda" :limit="5"></paginate-links>
    </div>
</template>


<script>
    export default {

        data() {
            return {
                referenda: [],
                paginate: ['referenda'],
                filterQuery: '',
                checkboxValues: []
            }
        },

        methods: {
            loadData: function () {
                this.axios.get('/api/referenda').then((response) => {
                    this.referenda = response.data.sort(function(a,b) {
                        return new Date(a.endDate).getTime() - new Date(b.endDate).getTime()
                    });
                });
            },
        },
        computed: {
            filterByName() {
                return this.referenda.filter( referendum => {
                    if(this.checkboxValues.length == null || this.checkboxValues.length == 0 || this.checkboxValues.length == 2){
                        return referendum.title.toLowerCase().indexOf(this.filterQuery.toLowerCase()) > -1;
                    }else{
                        let value = this.checkboxValues[0];
                        return referendum.title.toLowerCase().indexOf(this.filterQuery.toLowerCase()) > -1 && referendum.isClosed == value;
                    }
                })
            },
        },
        mounted() {
            this.loadData();
            console.log('Referenda mounted.');
        }
    }
</script>