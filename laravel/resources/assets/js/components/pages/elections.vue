<template>
    <div>
        <paginate-links for="items"></paginate-links>
        <div id="cards">
            <paginate
                    name="elections"
                    :list="items"
                    :per="5"
            >
                <div class="standard-card" v-for="item in paginated('elections')">
                    <div class="card-wrapper">
                        <div class="card">
                            <img src="/images/logo-square.svg">
                            <div class="card-info">
                                <h1 class="title">{{ item.name }}</h1>
                                <p>
                                    {{ item.description }}
                            </p>
                                <ul>
                                    <li v-if="item.isClosed" class="closed">Status: Gesloten</li>
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
                items: [],
                paginate: ['elections']
            }
        },

        methods: {
            loadData: function () {
                this.axios.get('/api/elections').then((response) => {
                    this.items = response.data;
                });
            },
        },

        mounted() {
            this.loadData();
            console.log('Elections mounted.');
        }
    }
</script>