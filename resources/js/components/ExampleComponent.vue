<template>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card card-default">
                    <full-calendar :events="events"></full-calendar>
                </div>
            </div>
        </div>
    </div>
</template>
<script>
    export default {
        data() {
            return {
                events: {},
                form: new Form({                
                    title : 'event1',
                    start : '2018-12-13',
                })
            }
        },     
        mounted() {
        console.log('Component mounted')
        }
    }
</script>