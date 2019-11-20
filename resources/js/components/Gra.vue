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
                Złoto:{{dane.gold}}
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
    <div class="">
        <p>Twój bohater</p>
        <p>Level 1</p>
        <button type="button" name="button" @click="quest">Idź na questa (2h)</button>
        <p v-if="dane.heroQuest=='1'">Bohater jest na queście, wróci za  {{diffDaty}}</p>
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
            let self = this;
            let kosztwood = this.costs[mine+'Upgrade'][0];
            let kosztstone = this.costs[mine+'Upgrade'][1];
            let kosztiron = this.costs[mine+'Upgrade'][2];
            if(this.pay(kosztwood,kosztstone,kosztiron)==false){
                console.log('działa zwrot');
                return
            }

            let levelcalc = this.dane[mine+'Level']+1;
            let factorcalc = levelcalc * 0.01;

            console.log('puszczamy upgrade');
            axios.patch('upgrade',{[mine+'Level']:levelcalc,[mine+'factor']:factorcalc}).then((res)=>console.log('puszczony upgrade')).then((res)=>self.getData());
        },
        upgradeMag(res){
            let self = this;

            let levelcalc=this.dane[res+'Store']+1;

            if(this.pay(100,100,100)==false){
                console.log('działa zwrot');
                return
            }

            axios.patch('upgrade',{[res+'Store']:levelcalc}).then((res)=>console.log('poszedł upgrade magazynu')).then((res)=>self.getData());

        },
        test2(){
                return 'dupa';
        },
        reset(){
            axios.patch('reset');
        },
        refresh(){
            let self = this;
            console.log('puszczamy update');
            axios.patch('update').then((res)=>console.log('update ukończony')).then((res)=>self.getData());
        },
        getData(){
            console.log('ściągamy dane');
            let self = this;
            axios.get('statdata').then((res)=>self.dane = res.data[0]).then((res)=>console.log('dane ściągniete')).then((res)=>self.checkMax());
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
        },
        resHack(){
            this.dane.wood=300;
            this.dane.stone=300;
            this.dane.iron=300;
        },
        pay(woodcost,stonecost,ironcost){
            if(this.dane.wood < woodcost){
                console.log('nie stać cię');
                return false
            }
            if(this.dane.stone < stonecost){
                console.log('nie stać cię');
                return false
            }
            if(this.dane.ironcost < ironcost){
                console.log('nie stać cię');
                return false
            }

            let woodcalc = this.dane.wood - woodcost;
            let stonecalc = this.dane.stone - stonecost;
            let ironcalc = this.dane.iron - ironcost;
            axios.patch('upgrade',{wood:woodcalc,stone:stonecalc,iron:ironcalc}).then((res)=>console.log('zapłacono'));
        },

        quest(){
            let self = this;
            let date1 = new Date(this.dane.questTime);
            let date2 = new Date(this.dane.questDTime);
            if (date2 > date1) {
                console.log('quest ukończony');
            }
            // return data1+data2;
            axios.patch('/quest').then((res)=>self.getData());
            var timeDiff = Math.abs(date2.getTime() - date1.getTime())/1000;
            console.log(timeDiff);
        }
    },
    mounted(){
        let self = this;
        console.log('1');
        this.refresh();
    },
    computed:{
        diffDaty(){
            let date1 = new Date(this.dane.questTime);
            let date2 = new Date(this.dane.questDTime);
            let timeDiff = Math.abs(date2.getTime() - date1.getTime())/1000 ;
            return timeDiff;
            // return //;
        },
        date1(){
            return new Date(this.dane.questTime);
        }
    }
}
</script>

<style>
[v-cloak]{
    display:none
}


</style>
