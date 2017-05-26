<template>
    <div id="createReferendum" class="container">
        <h1>Nieuw referendum</h1>
        <div class="form-field">
            <form @submit.prevent="placeNew">
                <div class="form-item">
                    <label for="title">Title</label>
                    <input  type="text" id="title" name="title" v-model="title" required>
                </div>
                <div class="form-item">
                    <label for="group">Group</label>
                    <select id="group" name="group" v-model="group" required>
                        <option v-for="group in groups" :value="group.id">{{group.name}}</option>
                    </select>
                </div>
                <div class="form-item">
                    <label for="startTime">Start time</label>
                    <div class="group">
                        <input  type="date" id="startDate" name="startDate" v-model="startDate" required>
                        <input  type="time" id="startTime" name="startTime" v-model="startTime" required>
                    </div>
                </div>
                <div class="form-item">
                    <label for="endTime">End time</label>
                    <div class="group">
                        <input  type="date" id="endDate" name="endDate" v-model="endDate" required>
                        <input  type="time" id="endTime" name="endTime" v-model="endTime" required>
                    </div>
                </div>
                <div class="form-item description">
                    <label for="description">Description</label>
                    <textarea  type="text" id="description" name="description" v-model="description" required></textarea>

                </div>
                    <div class="button-field">
                        <input type="submit" value="Referendum aanmaken" class="btn green">
                    </div>
                <div class="errors">
                    <p v-for="message in messages" class="error">
                        <i class="fa fa-exclamation-circle" aria-hidden="true"></i>{{message}}
                    </p>
                </div>
            </form>
        </div>
    </div>
</template>

<script>
    export default {
        data() {
            return {
                groups: [],
                title: '',
                group: '',
                startDate: null,
                startTime: null,
                endDate: null,
                endTime: null,
                description: '',
                user: [],
                messages: [],
                status: false,
            }
        },
        methods: {
            loadData: function () {
                this.axios.get('/api/groups/').then((response) => {
                    this.groups = response.data;
                });
                this.axios.get('/api/user/').then((response) => {
                    this.user = response.data;
                    console.log(this.user.id);
                });
            },
            placeNew: function () {
                this.axios.post('api/referenda/',{
                    title: this.title,
                    description: this.description,
                    startDate:  this.startDate + " " + this.startTime,
                    endDate:  this.endDate + " " + this.endTime,
                    group_id: this.group,
                    user_id: this.user.id
                }).then((response) => {
                    console.log(response);
                    if(response.status === 200){
                        this.status = true;
                        if(confirm("uw referendum werd doorgestuurd")){
                           this.$router.push({ name: 'referenda' });
                        }
                    }
                    else {
                        this.status = false;
                    }
                    this.messages = response.data[0];
                    console.log(this.messages);
                });
            }
        },
        mounted() {
            this.loadData(this.$route.params.id);
        }
    }
</script>