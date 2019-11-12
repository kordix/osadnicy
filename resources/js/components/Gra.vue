<template>
    <div class="" v-cloak>

    <div class="">
        <p>tu będzie gra</p>
        <div class="row">
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
                <button type="button" name="button" @click="refresh">refresh</button>
            </div>
        </div>
    </div>
    <div class="">
        <p>Twoja wioska</p>
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
        <p>Magazyn drewna: Max {{dane.woodStore * 100 +200}} <button type="button" name="button" @click="upgradeMag('wood')">Upgrade</button> </p>
        <p>Magazyn kamienia: Max {{dane.stoneStore * 100 +200}} <button type="button" name="button" @click="upgradeMag('stone')">Upgrade</button> </p>
        <p>Magazyn rudy: Max {{dane.ironStore * 100 +200}} <button type="button" name="button" @click="upgradeMag('iron')">Upgrade</button> </p>
    </div>
</div>

</template>

<script>
export default {
    data(){
        return {
            dane:{},
            test:'asdfsiemano',
            // sawmillLevel:1,
            // mineLevel:1,
            // quarryLevel:1,
            costs:{
                woodUpgrade:[150,100,100],
                ironUpgrade:[150,50,100],
                stoneUpgrade:[100,100,100],
            },
            magazyny:{
                wood:1,
                stone:1,
                iron:1
            }

        }
    },
    methods:{
        upgrade(mine){
            console.log('upgrade');
            let kosztwood = this.costs[mine+'Upgrade'][0];
            let kosztstone = this.costs[mine+'Upgrade'][1];
            let kosztiron = this.costs[mine+'Upgrade'][2];

            if(this.dane.wood < kosztwood){
                console.log('nie stać cię');
                return
            }

            let woodcalc = this.dane.wood - kosztwood;
            let stonecalc = this.dane.stone - kosztstone;
            let ironcalc = this.dane.iron - kosztiron;
            let levelcalc = this.dane[mine+'Level']+1;
            let factorcalc = levelcalc * 0.01;


            axios.patch('upgrade',{[mine+'Level']:levelcalc,wood:woodcalc,stone:stonecalc,iron:ironcalc,[mine+'factor']:factorcalc});
            this.refresh();
        },
        upgradeMag(res){
            if(this.dane.wood < kosztwood){
                console.log('nie stać cię');
                return
            }
            let kosztwood = 100;
            let kosztstone = 100;
            let kosztiron = 100;
            let woodcalc = this.dane.wood - kosztwood;
            let stonecalc = this.dane.stone - kosztstone;
            let ironcalc = this.dane.iron - kosztiron;
            let levelcalc=this.dane[res+'Store']+1;
            axios.patch('upgrade',{[res+'Store']:levelcalc,wood:woodcalc,stone:stonecalc,iron:ironcalc});
        },
        reset(){
            axios.patch('reset');
        },
        refresh(){
            // axios.patch('update');
            this.getData();
        },
        getData(){
            let self = this;
            axios.get('statdata').then((res)=>self.dane = res.data[0]).then((res)=>self.checkMax());
        },
        checkMax(){
            let self = this;
            let resources=['wood','stone','iron'];
            for(let i=0;i<resources.length;i++){
                let operand = resources[i];
                let max = self.dane[operand+'Store']*100+200;

                if (self.dane[operand] > max){
                    self.dane[operand]=max;
                    console.log('działa');
                }

            }
        }
    },
    mounted(){
        let self = this;
        // this.reset();
        // this.refresh();
        this.getData();
    }
}
</script>

<style>
[v-cloak]{
    display:none
}


</style>
