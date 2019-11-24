<template>
    <div class="">
        <p>Twoja wioska</p>
        <p>Tartak:<span style="font-size:20px" v-for="(level,index) in dane.woodLevel">•</span><span>
            Produkcja: {{dane.woodfactor * 3600 }}/h</span>
            <button @click="test()">Upgrade ({{costs.woodUpgrade[0]}}D {{costs.woodUpgrade[1]}}K {{costs.woodUpgrade[2]}}Ż)</button>
        </p>
        <p>Kamieniołom:<span style="font-size:20px" v-for="(level,index) in dane.stoneLevel">•</span>
            <span>Produkcja: {{dane.stonefactor * 3600}}/h </span>
            <button @click="upgrade('stone')" >Upgrade  ({{costs.stoneUpgrade[0]}}D {{costs.stoneUpgrade[1]}}K {{costs.stoneUpgrade[2]}}Ż)</button>
        </p>
        <p>Kopalnia rudy:<span style="font-size:20px" v-for="(level,index) in dane.ironLevel">•</span>
            <span>Produkcja: {{dane.ironfactor * 3600}}/h </span>
            <button @click="upgrade('iron')" >Upgrade  ({{costs.ironUpgrade[0]}}D {{costs.ironUpgrade[1]}}K {{costs.ironUpgrade[2]}}Ż)</button>
        </p>
        </p>
        <p>Magazyn drewna: Max {{dane.woodStore * 100 +200}} <button type="button" name="button" @click="upgradeMag('wood')">Upgrade</button> </p>
        <p>Magazyn kamienia: Max {{dane.stoneStore * 100 +200}} <button type="button" name="button" @click="upgradeMag('stone')">Upgrade</button> </p>
        <p>Magazyn rudy: Max {{dane.ironStore * 100 +200}} <button type="button" name="button" @click="upgradeMag('iron')">Upgrade</button> </p>
    </div>
</template>

<script>
import { mapState } from 'vuex';
import { mapActions } from 'vuex';



export default {
    data(){
        return {
            costs:{
                woodUpgrade:[150,100,100],
                ironUpgrade:[150,50,100],
                stoneUpgrade:[100,100,100],
            }
        }
    },
    computed:{
        ...mapState({
            dane: 'dane',
        })
    },
    mounted(){

    },
    methods:{
        ...mapActions([
            'loadData'
        ]),
        test(){
            console.log('siemano');
        },
        upgradeMag(res){
            // let self = this;
            //
            // let levelcalc=this.dane[res+'Store']+1;
            //
            // if(this.pay(100,100,100)==false){
            //     console.log('działa zwrot');
            //     return
            // }
            //
            // axios.patch('upgrade',{[res+'Store']:levelcalc}).then((res)=>console.log('poszedł upgrade magazynu')).then((res)=>self.getData());

        },
        upgrade(mine){
            console.log('upgrade');
            let self = this;
            let kosztwood = this.costs[mine+'Upgrade'][0];
            let kosztstone = this.costs[mine+'Upgrade'][1];
            let kosztiron = this.costs[mine+'Upgrade'][2];
            if(this.pay(kosztwood,kosztstone,kosztiron)==false){
                return
            }

            let levelcalc = this.dane[mine+'Level']+1;
            let factorcalc = levelcalc * 0.01;

            axios.patch('upgrade',{[mine+'Level']:levelcalc,[mine+'factor']:factorcalc}).then((res)=>console.log('puszczony upgrade')).then((res)=>self.loadData());
        },
        refresh(){
            // let self = this;
            // console.log('puszczamy update');
            // axios.patch('update').then((res)=>console.log('update ukończony')).then((res)=>self.getData());
        },
        resHack(){
            this.$store.commit('resHack');
        },
        pay(woodcost,stonecost,ironcost){
            if(this.dane.wood < woodcost){
                return false
            }
            if(this.dane.stone < stonecost){
                return false
            }
            if(this.dane.ironcost < ironcost){
                return false
            }

            let woodcalc = this.dane.wood - woodcost;
            let stonecalc = this.dane.stone - stonecost;
            let ironcalc = this.dane.iron - ironcost;
            axios.patch('upgrade',{wood:woodcalc,stone:stonecalc,iron:ironcalc}).then((res)=>console.log('zapłacono'));
        }
    }
}
</script>

<style>
</style>
