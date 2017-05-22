<template>
    <div>
        <h1>Nieuw referendum</h1>
        <form @submit.prevent="placeNew">
            <div class="form-group">
                <label for="title">Title</label>
                <input  type="text" id="title" name="title" v-model="title" >
            </div>
            <div class="form-group">
                <label for="group">group</label>
                <select id="group" name="group" v-model="group" >
                    <option v-for="group in groups" :value="group.id">{{group.name}}</option>
                </select>
            </div>
            <div class="form-group">
                <label for="startTime">start time</label>
                <input  type="date" id="startDate" name="startDate" v-model="startDate" >
                <input  type="time" id="startTime" name="startTime" v-model="startTime" >
            </div>
            <div class="form-group">
                <label for="endTime">end time</label>
                <input  type="date" id="endDate" name="endDate" v-model="endDate" >
                <input  type="time" id="endTime" name="endTime" v-model="endTime" >
            </div>
            <div class="form-group">
                <label for="description">Description</label>
                <textarea  type="text" id="description" name="description" v-model="description" >
                </textarea>
            </div>
            <input type="submit" value="submit" >
        </form>

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
                }).then(function (response) {
                    console.log(response);
                }).catch(function (error) {
                    console.log(error);
                });

            }
        },
        mounted() {
            this.loadData(this.$route.params.id);
        }
    }
</script>