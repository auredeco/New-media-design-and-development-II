<template>
    <div>
        <h1>Elections</h1>
        <div id="cards">
            <div class="standard-card" v-for="item in items">
                <div class="card-wrapper">
                    <div class="card">
                        <img src="/images/logo-square.svg">
                        <div class="card-info">
                            <h1 class="title">{{ item.name }}</h1>
                            <p>
                                {{ item.description }}
                            </p>
                            <ul>
                                <li class="open">Status: Lopend</li>
                                <li v-if="item.isClosed" class="closed">Status: Gesloten</li>
                            </ul>
                        </div>
                    </div>
                    <div class="button-field">
                        <button class="btn blue">Stemmen</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>


<script>
    export default {

        data() {
            return {
                items: []
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