<template>
    <div id="account" class="container">
        <div v-if="loading"  class="loader"></div>
        <div class="group">
            <figure>
                <img :src="user.picture">
            </figure>
            <div class="info">
                <h1>Mijn Profiel</h1>
                <table>
                    <tbody>
                    <tr>
                        <th>naam: </th>
                        <td>{{user.name}}</td>
                    </tr>
                    <tr>
                        <th>email: </th>
                        <td>{{user.email}}</td>
                    </tr>
                    <tr>
                        <th>geslacht: </th>
                        <td>{{user.gender}}</td>
                    </tr>
                    <tr>
                        <th>geboortedatum: </th>
                        <td>{{user.birthdate}}</td>
                    </tr>
                    </tbody>
                </table>
            </div>
        </div>
        <div class="groups">
            <h2>groepen</h2>
            <div class="card-field">
                <div class="standard-card" v-for="group in groups">
                    <div class="card-wrapper">
                        <router-link :to="{ name: 'group', params: { id: group.id }}">
                            <figure>
                                <img :src="group.pictureUri" alt="group image">
                            </figure>
                            <p>{{group.name}}</p>
                        </router-link>
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
                groups: [],
                user : [],
                loading: true,

            }
        },
        methods: {
            /** function  that loads current user and put's it in a more accessible object*/
            loadData: function (id) {
                this.axios.get('/api/users/' + id).then((response) => {
                    let user = response.data;
                    this.groups = user.groups;
                    this.user = {
                        username: user.username,
                        name: user.firstname + " " + user.lastname,
                        gender: user.gender,
                        birthdate: user.birthdate,
                        email: user.email,
                        picture: user.pictureUri,
                    };
                this.stopLoading();

            });
            },
            /** function that sets the variable loading to false after 1,5 seconds to make sure the page has loaded completely*/
            stopLoading: function () {
                let self = this;
                setTimeout(function(){ self.loading = false; }, 1500);
            }
        },
        mounted() {
            this.loadData(this.$route.params.id);
        },


    }
</script>
