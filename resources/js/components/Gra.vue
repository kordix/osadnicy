<template>
    <div class="" v-cloak>
    <resourcetab></resourcetab>
    <wioska></wioska>
    <hero></hero>
</div>

</template>

<script>
export default {
    data(){
        return {
            dane:{},
            test:'asdfsiemano',
            costs:{
                woodUpgrade:[150,100,100],
                ironUpgrade:[150,50,100],
                stoneUpgrade:[100,100,100],
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
        },


    },
    mounted(){
        let self = this;
        console.log('1');
        this.refresh();
    },
    computed:{

    }
}
</script>

<style>
[v-cloak]{
    display:none
}


</style>
