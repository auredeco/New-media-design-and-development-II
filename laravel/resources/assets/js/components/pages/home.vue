<template>
    <div>
        <img src="images/logo-square.svg">

        <div id="cards">
            -        <div class="card-field">
            <tabs>
                <tab v-if="elections" name="verkiezingen" :selected="true">
                    <div>
                        <item v-for="election in elections" :key="election.id" propImage="/images/logo-square.svg"  propLink="/elections/#" :propName="election.name"></item>
                    </div>
                    <router-link :to="{ path: 'elections'}">elections</router-link>
                </tab>
                <tab v-if="referenda" name="referenda">
                    <div>
                        <item v-for="referendum in referenda" :key="referenda.id" propImage="/images/logo-square.svg" propLink="/referenda/#"  :propName="referendum.title"></item>
                    </div>
                    <router-link :to="{ path: 'referenda'}">referenda</router-link>
                </tab>

            </tabs>
        </div>
        </div>
    </div>



</template>

<script>
    import Vue from 'vue';
    import axios from 'axios'
    import VueAxios from 'vue-axios'

    Vue.use(VueAxios, axios)
    Vue.component('tabs', {
        template: `
            <div class="card-with-header">
                <header>
                    <div class="tab" v-for="tab in tabs" :class="{'active' : tab.isActive}">
                        <a @click="selectTab(tab)">{{tab.name}}</a>
                    </div>
                </header>
                <slot></slot>
            </div>`,
        data() {
            return { tabs: [] };
        },

        created() {
            this.tabs = this.$children;
        },

        methods: {
            selectTab(selectedTab) {
                this.tabs.forEach(tab => {
                    tab.isActive = (tab.href == selectedTab.href);
                });
            }
        }

    });
    Vue.component('tab', {
        template: ` <div v-show="isActive" class="card">
                    <div><slot></slot></div>
                    </div>`,
        props: {
            name: { required: true },
            selected: { default: false }
        },

        data() {
            return {
                isActive: false
            };
        },

        computed: {
            href() {
                return '#' + this.name.toLowerCase().replace(/ /g, '-');
            }
        },

        mounted() {
            this.isActive = this.selected;
        },
    })
    Vue.component('item', {
        template: `
         <router-link :to="propLink">
         <div class="card-element">
            <img :src="propImage">
            <p>{{propName}}</p>
         </div>
         </router-link>
`,
        props: ['propName', 'propImage', 'propLink']

    })



    export default {
        data() {
            return {
                elections: [],
                referenda: [],
            };
        },

        mounted() {
            Vue.axios.get('/api/elections').then((response) => {
                this.elections = response.data.sort(function(a,b) {
                    return new Date(a.endDate).getTime() - new Date(b.endDate).getTime()
                });
                this.elections = this.elections.slice(0,3);
            })
            Vue.axios.get('/api/referenda').then((response) => {
                this.referenda = response.data.sort(function(a,b) {
                    return new Date(a.endDate).getTime() - new Date(b.endDate).getTime()
                });
                this.referenda = this.referenda.slice(0,3);
            })

        }
    }

</script>




