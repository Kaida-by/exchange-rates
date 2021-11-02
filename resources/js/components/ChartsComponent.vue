<template>
    <div class="container">
        <div class="row justify-content-center">
            <line-chart :chart-data="data" :height="300" :width="1000" :options="lineOptions">
            </line-chart>
        </div>
    </div>
</template>

<script>
    import LineChart from "../LineChart";
    export default {
        components: {
            LineChart
        },
        data: function () {
            return {
                data: [],
                lineOptions: {
                    elements: {
                        line: {
                            fill: false,
                        }
                    }
                }
            }
        },
        mounted() {
            this.update()
        },
        methods: {
            update: function () {
                axios.get('/get-charts').then((response) => {
                    this.data = response.data
                })
            }
        }
    }
</script>
