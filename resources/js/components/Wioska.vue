<template>
    <div class="">
        <button type="button" class="btn btn-lg btn-danger" data-toggle="popover" title="Popover title" data-content="afsadfs">Click to toggle popover</button>
        <p>Twoja wioska  <span style="display:inline-block;margin-left:20px;color:red" v-if="log !=''" @click="log = ''">{{log}}</span> </p>
        <div id="wioska" style="background:url('images/pole.png');background-size:contain;width:500px;height:500px;position:relative">
            <div id="drewMine" style="width:100px;height:100px;left:50px;top:50px;" v-bind:style="{ 'background-image': 'url(' + 'images/wood'+dane.woodLevel+'.png)' }"></div>
            <div id="stoneMine" style="width:100px;height:100px;left:200px;top:50px;" v-bind:style="{ 'background-image': 'url(' + 'images/stone'+dane.stoneLevel+'.png)' }"></div>
            <div id="ironMine" style="width:100px;height:100px;left:200px;top:200px;" v-bind:style="{ 'background-image': 'url(' + 'images/iron'+dane.ironLevel+'.png)' }"></div>
            <div id="drewMag" style="width:90px;height:90px;left:50px;top:400px" v-bind:style="{ 'background-image': 'url(' + 'images/Mag'+dane.woodStore+'.png)' }" >
                <div id="ikonadrew" class="woodIcon" style="background-image:url(images/wood.png);"></div>
            </div>
            <div id="stoneMag" style="width:90px;height:90px;left:150px;top:400px" v-bind:style="{ 'background-image': 'url(' + 'images/Mag'+dane.stoneStore+'.png)' }" >
                <div id="ikonastone" class="stoneIcon" style="background-image:url(images/stone.png);"></div>

            </div>
            <div id="ironMag" style="width:90px;height:90px;left:250px;top:400px" v-bind:style="{ 'background-image': 'url(' + 'images/Mag'+dane.ironStore+'.png)' }" >
                <div id="ikonairon" class="stoneIcon" style="background-image:url(images/iron.png);"></div>
            </div>
        </div>

        <p>Tartak:<span style="font-size:20px" v-for="(level,index) in dane.woodLevel">•</span><span>
            Produkcja: {{dane.woodfactor * 3600 }}/h</span>
            <button @click="upgrade('wood')">Upgrade ({{costs.woodUpgrade[0]}}D {{costs.woodUpgrade[1]}}K {{costs.woodUpgrade[2]}}Ż)</button>
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
        <p>Magazyn drewna: Max {{dane.woodStore * 100 +200}} <button type="button" name="button" @click="upgradeMag('wood')">Upgrade</button><span style="font-size:10px"> Upgrade magazynów 100 każdego surowca </span></p>
        <p>Magazyn kamienia: Max {{dane.stoneStore * 100 +200}} <button type="button" name="button" @click="upgradeMag('stone')">Upgrade</button> </p>
        <p>Magazyn rudy: Max {{dane.ironStore * 100 +200}} <button type="button" name="button" @click="upgradeMag('iron')">Upgrade</button> </p>
        <!-- <popover></popover> -->
        <popover>asdfasdf</popover>

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
            },
            log:''
        }
    },
    computed:{
        ...mapState({
            dane: 'dane'
        })
    },
    mounted(){

    },
    methods:{
        ...mapActions([
            'loadData'
        ]),
        upgradeMag(res){
            let self = this;

            let levelcalc=this.dane[res+'Store']+1;

            if(this.pay(100,100,100)==false){
                console.log('działa zwrot');
                return
            }

            axios.patch('upgrade',{[res+'Store']:levelcalc}).then((res)=>self.loadData());

        },
        upgrade(mine){
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
                this.log='Brakuje ci drewna';
                return false
            }
            if(this.dane.stone < stonecost){
                this.log = 'Brakuje ci kamienia';

                return false
            }
            if(this.dane.iron < ironcost){
                this.log = 'Brakuje ci żelaza' ;

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
#wioska>div{
    background-size:contain;
    position:absolute;
}

.woodIcon{
    background-size:contain;background-repeat:no-repeat;left:60px;position:relative;width:20px;height:20px;top:25px;
}

.stoneIcon{
    background-size:contain;background-repeat:no-repeat;left:60px;position:relative;width:15px;height:15px;top:22px;
}

.ironIcon{
    background-size:contain;background-repeat:no-repeat;left:60px;position:relative;width:20px;height:20px;top:25px;
}




</style>
