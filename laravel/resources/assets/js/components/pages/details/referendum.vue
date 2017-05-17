<template>
    <div>
        <div class="info">
            <h1>{{referendum.title}}</h1>
            <p>Status:
                <span v-if="referendum.isClosed">Closed</span>
                <span v-else>Open</span>
            </p>
            <p v-if="!referendum.isClosed">
                eindigd op : {{referendum.endDate}}
            </p>
            <h2>Description:</h2>
            <p>{{referendum.description}}</p>
            <div v-if="referendum.isClosed">
                <h2>Resultaat</h2>
            </div>
            <div v-else>
                <h2>Mening</h2>
                <input type="radio" id="agreed" value="1" v-model="opinion" >
                <label for="agreed">Akkoord</label>
                <br>
                <input type="radio" id="disagreed" value="0" v-model="opinion">
                <label for="disagreed">Niet akkoord</label>
            </div>

        </div>
        <div class="buttons" >
            <button v-if="!referendum.isClosed" @click="vote">Stemmen</button>
            <button @click="nextReferenda">Volgende referenda</button>
        </div>
    </div>
</template>

<script>
    export default {
        data() {
            return {
                referendum: [],
                referenda: [],
                next:[],
                opinion: 0,
            }
        },

        methods: {
            loadData: function (id) {
                this.axios.get('/api/referenda/' + id).then((response) => {
                    this.referendum = response.data;
                });
                this.axios.get('/api/referenda').then((response) => {
                    this.referenda = response.data.sort(function(a,b) {
                        return new Date(a.endDate).getTime() - new Date(b.endDate).getTime()
                    });
                });
            },
            nextReferenda: function ()  {

                var referendum = this.referendum;
                var index = _.findIndex(this.referenda, function(o) { return o.id == referendum.id; });
                this.next = this.referenda[index + 1];
                console.log(this.next.id);
                this.$router.push({ name: 'referendum', params: { id: this.next.id }});
                //pagina laad niet vanzelf
                window.location.reload()
            },
            vote: function () {
                var opinion = Boolean(parseInt(this.opinion));
                var question = "Bent u zeker dat u ";
                opinion? question += "akkoord stemt?": question += "niet akkoord stemt?"

                if(
                    confirm(question)
                )
                {
                    this.axios.post('api/votes/',{
                        voteType: 1,
                        agreed: opinion,
                        referendum_id: this.referendum.id,
                        CandidateElection_id: null
                    }).then(function (response) {
                        var vote = response.data;
                        alert('Houd deze code bij om in de toekomst uw stem te controleren: \n' + vote.uuid)
                    }).catch(function (error) {
                    });
                }
            }
        },
        mounted() {
            this.loadData(this.$route.params.id);
            console.log(this.$route.params.id)
        }
    }
</script>