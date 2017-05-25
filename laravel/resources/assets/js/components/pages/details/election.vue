<template>
    <div id="election-detail" class="container">
        <figure class="election-image">
            <img :src="election.pictureUri">
            <!--<img src="/images/logo-square.svg">-->
        </figure>
        <h1>{{election.name}}</h1>
        <p class="description">{{election.description}}</p>
        <p v-if="status == 'coming'">Gepland</p>
        <p v-if="status == 'coming'">Start op: {{ election.startDate }}</p>
        <p v-if="status == 'open'" class="is-open"> open</p>
        <p v-if="status == 'open'" > Eindigt op: {{ election.endDate }}</p>
        <p v-if="status == 'closed'" class="is-closed">Gesloten</p>

        <hr />
        <!--<router-link v-if="!listed && status == 'coming'"  :to="{ name: 'applyElection', params: { id: election.id }}">registreer</router-link>-->

        <h1 class="candidates-title">Kandidaten</h1>
        <table>
            <thead>
                <th>Kandidaat</th>
                <th>Partij</th>
            </thead>
            <tbody>
            <tr v-for="candidate in election.candidates" v-if="candidate.pivot.approved">
                <td >{{ candidate.user.firstname }} {{ candidate.user.lastname }}</td>
                <td >{{ candidate.party.name }}</td>
            </tr>
            </tbody>
        </table>
        <div class="button-field" v-if="status == 'open'">
            <router-link :to="{ name: 'electionVote', params: { id: election.id }}" class="full-width">
                                <button class="btn blue">Stemmen</button>
            </router-link>
        </div>
        <div class="button-field" v-if="status == 'coming' && !listed">
            <router-link   :to="{ name: 'applyElection', params: { id: election.id }}">
                <button class="btn blue">registreer</button>
            </router-link>

        </div>
        <div v-if="status == 'closed'" class="results">
            <h1>Uitslag</h1>
            <div class="ct-chart">
        </div>
        </div>
    </div>
</template>

<script>
    export default {
        data() {
            return {
                election: [],
                candidates: [],
                scores: [],
                user: [],
                listed: false,
                reg: false,
                status: 'closed',
            }
        },

        methods: {
            loadData: function (id) {
                this.axios.get('/api/elections/' + id).then((response) => {
                    this.election = response.data;

                    this.drawGraph();
                    this.checkListed();
                    this.checkReg();
                    this.checkStatus();
                });
            },
            loadUserData: function (electionId) {
                this.axios.get('api/user').then((response) => {
                    this.user = response.data;
                    this.loadData(electionId);
                });
            },
            checkListed() {
                let candidates = this.election.candidates;
                for (let i = 0; i < candidates.length; i++) {
                    if(this.user.id === candidates[i].user_id){
                        this.listed = true
                    }
                }

            },
            checkReg(){
                if(new Date() < new Date(this.election.startDate)){
                    this.reg = true;
                }else {
                    this.reg = false;
                }
            },
            checkStatus(){

                if(new Date() < new Date(this.election.startDate)){
                    this.status = 'coming';
                }
                else if ((new Date() > new Date(this.election.startDate))&& (new Date() < new Date(this.election.endDate))){
                    this.status = 'open';
                }else{
                    this.status = 'closed';
                }

            },
//                if(new Date() < new Date(this.election.startDate)){
//                    this.status = 'coming';
//                }else if((new Date() > new Date(this.election.startDate) ){
//                    this.status = 'open';
//                }else {
//                    this.status = 'closed';
//                }
//            },
            drawGraph() {
                if(this.election.isClosed) {
                    for(let i = 0; i < this.election.candidates.length; i++){
                        if(this.election.candidates[i].pivot.approved){
                            this.candidates.push(this.election.candidates[i].user.firstname + " " + this.election.candidates[i].user.lastname);
                            this.scores.push(this.election.candidates[i].pivot.score)
                        }
                    }
                    var options = {
                        labelInterpolationFnc: function(value) {
                            return value[0]
                        }
                    };
                    new Chartist.Bar('.ct-chart', {
                        labels: this.candidates,
                        series: [this.scores]
                    }, options);
                }
            },
        },
        mounted() {
            this.loadUserData(this.$route.params.id);
            console.log('Election mounted.');

            console.log(this.$route.params.id);
        }
    }
</script>