<template>
    <div id="election-vote" class="container">
        <div v-if="loading"  class="loader"></div>
        <div class="candidate" v-for="candidate in election.candidates" v-if="candidate.pivot.approved">
            <div class="candidate-wrapper">
                <figure class="user-image">
                    <img v-bind:src="candidate.user.pictureUri" />
                </figure>
                <div class="candidate-info">
                    <h1>{{ candidate.user.firstname }} {{ candidate.user.lastname }}</h1>
                    <p>{{ candidate.party.name }}</p>
                    <div class="button-field">
                        <button class="btn green" v-bind:id="candidate.pivot.id" @click="vote">Stemmen</button>
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
                election: [],
                user: [],
                loading: true,
            }
        },

        methods: {
            /** function that loads current election and user*/
            loadData: function (id, userId) {
                this.axios.get('/api/users/' + userId).then((response) => {
                    this.user = response.data;
                    this.axios.get('/api/elections/' + id).then((response) => {
                        this.election = response.data;
                        if(this.election.candidates.length == 0){
                            this.$router.push({ name: 'elections'});
                        }else {
                            this.checkVoted();
                        }
                    });
                });
            },
            /** function that loads current user*/
            loadUserData: function (electionId) {
                this.axios.get('api/user').then((response) => {
                    this.loadData(electionId, response.data.id);
                });
            },
            /** function for voting on a candidate as response the user gets the uuid to check his vote*/
            vote(e) {
                if (confirm("Weet je zeker dat je op deze candidaat wilt stemmen?")) {
                    var password = prompt('Geef een wachtwoord op om later je stem te valideren');
                    console.log(e);
                    // get the event and take the id from the element that is clicked
                    // Store it in the candidateElection_id variable
                    let candidateElection_id = e.srcElement.id;
                    console.log(candidateElection_id);
                    let _self = this;

                    this.axios.post('api/votes/',{
                        checksum: password,
                        voteType: 0,
                        user_id: this.user.id,
                        election_id: this.election.id,
                        agreed: null,
                        referendum_id: null,
                        CandidateElection_id: candidateElection_id
                    }).then(function (response) {
                        console.log(response.data);
                        var vote = response.data;
                        alert('Houd deze code bij om in de toekomst uw stem te controleren: \n' + vote.uuid)
                        console.log('redirect');
                        window.location.reload();
                    }).catch(function (error) {
                    });
                }
            },
            /** function to check if the current user has voted already*/
            checkVoted(){
                let self = this;
                let history = self.user.history;
                for(let i = 0; i < history.length;  i++){
                    let electionId = self.user.history[i];
                    console.log(electionId.election_id);
                    if(electionId.election_id == self.election.id){
                        self.voted = true;
                        console.log('true mdfkr');
                        console.log(self.voted);
                        this.$router.push({ name: 'elections'});
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
        }
    }
</script>