<template>
    <div class="">
        <p>Twój bohater</p>
        <p>Level 1</p>
        <p v-if="heroReturned2">Bohater wrócił z questa. Możesz <button @click="getReward">Skolekcjonować golda</button> </p>
        <p v-else-if="dane.heroQuest=='1'">Bohater jest na queście, wróci za  {{diffDaty}} s</p>
        <button v-else type="button" name="button" @click="quest" >Idź na questa (1 min)</button>
    </div>

</template>

<script>
import { mapState } from 'vuex';
export default {
    data(){
        return {
            currentTime:null,
            test:'test',
            heroReturned:false,
            timer:null
        }
    },
    computed:{
        ...mapState({
            dane: 'dane',
        }),
        diffDaty(){
            let date1 = new Date(this.currentTime);
            let date2 = new Date(this.dane.questDTime);
            let timeDiff = Math.abs(date2.getTime() - date1.getTime())/1000 ;
            return timeDiff;
            // return //;
        },
        heroReturned2(){
            let date1 = new Date(this.currentTime);
            let date2 = new Date(this.dane.questDTime);

            if(this.dane.heroQuest=="0"){
                return false
            }else if (date1 > date2){
                return true
            }else{
                return false
            }
        }
    },
    mounted(){
        let self = this;
        axios.get('time').then((res)=>this.currentTime=res.data.date);
        setInterval(()=>{
            self.updateTimer();
        },1000)




    },
    methods:{
        getData(){
            this.$store.dispatch('loadData');
        },
        quest(){
          let self = this;
          let date1 = new Date(this.currentTime);
          let date2 = new Date(this.dane.questDTime);

          axios.patch('/quest').then((res)=>self.getData());
      },
      updateTimer(){
          let dt = new Date(this.currentTime);
          dt.setSeconds( dt.getSeconds() + 1 );
          this.currentTime = dt;
      },
      getReward(){
          let self = this;
          let gold = this.dane.gold;
          let goldcalc = gold+=50;
          axios.patch('changedata',{heroQuest:'0',gold:goldcalc}).then((res)=>self.$store.dispatch('loadData'));
      }
  }
}
</script>

<style lang="css">
</style>
