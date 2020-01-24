<template>
    <div class="row" style="margin-bottom:20px">
        <div class="col-md-2">
            Drewno:{{dane.wood}}
        </div>
        <div class="col-md-2">
            Kamień:{{dane.stone}}
        </div>
        <div class="col-md-2">
            Żelazo:{{dane.iron}}
        </div>
        <div class="col-md-2">
            Złoto:{{dane.gold}}
        </div>
        <div class="col-md-2">
            <button type="button" name="button" @click="updateResources">refresh</button>
        </div>
        <p></p>
    </div>
</template>

<script>
import { mapState } from 'vuex';
import { mapActions } from 'vuex';


export default {
    data(){
        return {

        }
    },
    computed:{
        ...mapState({
            dane: 'dane',
        })
    },
    mounted(){
        this.loadData();
        this.updateResources();
    },
    methods:{
        ...mapActions({
            loadData:'loadData',
            updateResources:'updateResources'
        })
    }
}
</script>

<style>
</style>
