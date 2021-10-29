<template>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <button @click="update" class="btn" v-if="!is_refresh">Обновить - {{ id }}</button>
                <span v-if="is_refresh">Обновление...</span>
                <table class="table">
                    <thead>
                    <tr>
                        <th>name</th>
                        <th>url</th>
                    </tr>
                    </thead>
                    <tbody>
                        <tr v-for="value in charts">
                            <td>{{value.title}}</td>
                            <td>{{value.url}}</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        data: function () {
            return {
                charts: [],
                is_refresh: false,
                id: 0
            }
        },
        mounted() {
            this.update()
        },
        methods: {
            update: function () {
                this.is_refresh = true
                axios.get('/get-charts').then((response) => {
                    console.log(response)
                    this.charts = response.data
                    this.is_refresh = false
                    this.id++
                })
            }
        }
    }
</script>
