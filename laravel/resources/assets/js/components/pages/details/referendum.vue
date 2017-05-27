<template>
    <div id="referendum-detail" class="container">
        <div v-if="loading"  class="loader"></div>
        <div class="info">
            <h1>{{referendum.title}}</h1>
            <p>Status:
                <span v-if="referendum.isClosed" class="closed">Closed</span>
                <span v-else class="open">Open</span>
            </p>
            <p v-if="!referendum.isClosed">
                eindigd op : {{referendum.endDate}}
            </p>
            <h2>Beschrijving:</h2>
            <p>{{referendum.description}}</p>
            <div v-if="referendum.isClosed">
                <h2>Resultaat</h2>
                <p v-model="agree">Akkoord: {{ agree }}</p>
                <p v-model="disagree">Niet akkoord: {{ disagree }}</p>
            </div>
            <div v-else>
                <h2>Mening</h2>
                <input type="radio" id="agreed" value="1" v-model="opinion" >
                <label for="agreed">Akkoord</label>
                <br>
                <input type="radio" id="disagreed" value="0" v-model="opinion">
                <label for="disagreed">Niet akkoord</label>
            </div>
            <div v-if="!referendum.isClosed" class="button-field">
                <button v-if="!voted" @click="vote" class="btn green">Stemmen</button>
                <button @click="nextReferenda" class="btn blue">Volgend referendum</button>
            </div>
            <div v-if="referendum.isClosed" class="button-field">
                <button @click="nextReferenda" class="btn blue">Volgend referendum</button>
            </div>
            <div class="ct-chart ct-perfect-fourth"></div>
        </div>
    </div>
</template>

<script>
    export default {
        data() {
            return {
                referendum: [],
                agree: 0,
                disagree: 0,
                referenda: [],
                next:[],
                opinion: 0,
                user: [],
                voted: false,
                loading: true,

            }
        },

        methods: {
            /** function that loads current referendum, all referenda and current user */
            loadData: function (id, userId) {

                this.axios.get('/api/referenda').then((response) => {
                    console.log(this.referenda);
                    this.referenda = response.data.all.sort(function(a,b) {
                        return new Date(a.endDate).getTime() - new Date(b.endDate).getTime()
                    });
                    this.axios.get('/api/referenda/' + id).then((response) => {
                        this.referendum = response.data;
                        this.axios.get('/api/users/' + userId).then((response) => {
                            this.user = response.data;
                            this.checkVoted();
                            this.drawGraph();
                        });
                    });
                });
            },
            /** function to load current user data*/
            loadUserData: function (referendumId) {
                this.axios.get('api/user').then((response) => {
                    this.loadData(referendumId, response.data.id);
                });
            },
            /** function that draws graph if referendum is closed*/
            drawGraph(){
                if(this.referendum.isClosed)
                {
                    let votes = this.referendum.votes;

                    for(let i =0; i < votes.length; i++){
                        if(votes[i].agreed){
                            this.agree++;
                        } else {
                            this.disagree++
                        }
                    }
                    console.log(this.agree);
                    console.log(this.disagree);

                    let Chartdata = {
                        labels: ['Akkoord', 'Niet Akkoord'],
                        series: [this.agree, this.disagree]
                    };

                    new Chartist.Pie('.ct-chart', Chartdata);
                    this.stopLoading();
                }
            },
            /** function that goes to next referenda (sorted by endDate in load function */
            nextReferenda: function ()  {
                var referendum = this.referendum;
                var index = _.findIndex(this.referenda, function(o) { return o.id == referendum.id; });
                this.next = this.referenda[index + 1];
                console.log(this.next.id);
                this.$router.push({ name: 'referendum', params: { id: this.next.id }});
                //pagina laad niet vanzelf
                window.location.reload()
            },
            /** function to vote on a referendum user gets a response with the uuid*/
            vote: function () {
                var opinion = parseInt(this.opinion);
                var question = "Bent u zeker dat u ";
                opinion? question += "akkoord stemt?": question += "niet akkoord stemt?"
                var password = prompt('Geef een wachtwoord op om later je stem te valideren');

                if(
                    confirm(question)
                )
                {
                    this.axios.post('api/votes/',{
                        voteType: 1,
                        agreed: opinion,
                        referendum_id: this.referendum.id,
                        user_id: this.user.id,
                        CandidateElection_id: null,
                        checksum: password
                    }).then(function (response) {
                        var vote = response.data;
                        alert('Houd deze code bij om in de toekomst uw stem te controleren: \n' + vote.uuid)
                        console.log(response.data);
                        location.reload();
                    }).catch(function (error) {
                    });
                }
            },
            /** function to check if user has voted*/
            checkVoted: function(){
                let self = this;
                let history = self.user.history;
                for(let i = 0; i < history.length;  i++){
                    let referendumId = self.user.history[i];
                    console.log(referendumId.referendum_id);
                    if(referendumId.referendum_id == self.referendum.id){
                        self.voted = true;
                        console.log('true mdfkr');
                        console.log(self.voted);
                        break;
                    }
                }
                this.stopLoading();

            },
            /** function that sets the variable loading to false after 1,5 seconds to make sure the page has loaded completely*/
            stopLoading: function () {
                let self = this;
                setTimeout(function(){ self.loading = false; }, 1500);
            }
        },
        mounted() {
            this.loadUserData(this.$route.params.id);
            console.log(this.$route.params.id);
        }
    }
</script>