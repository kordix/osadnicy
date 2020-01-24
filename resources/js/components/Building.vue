<template>
  <div @click="pop = !pop">
    <div
      class="building" :id="attr+'Mine'" style="height:100px;"
      v-bind:style="{ 'background-image': 'url(' + 'images/'+attr +dane[attr+'Level']+'.png)',left:left+'px',top:top+'px',width:width+'px'}"
    ></div>
    <popover v-if="pop">Level: {{dane[attr+'Level']}}  Produkcja: {{dane[attr+'factor'] * 3600 }}/h
       <button @click="$parent.upgrade(attr)">Upgrade ({{costs[attr+'Upgrade'][0]}}D {{costs[attr+'Upgrade'][1]}}K {{costs[attr+'Upgrade'][2]}}Ż)</button>
    </popover>

   
    
  </div>
</template>
<script>
import {mapState} from 'vuex';

export default {
  props: ['attr','width','height','left','top','type'],
  computed: {
    ...mapState({
      dane: "dane",
      costs:"costs"
    }),
      popheader(){
      return 'Kopalnia '+this.attr;
    }
  },
  data(){
    return {
    pop:false
    }
  }
};
</script>

<style scoped>
.building {
  background-size: contain;
  position: absolute;
}

.building:hover{
  opacity:0.6;
  cursor:pointer;
}

.woodIcon {
  background-size: contain;
  background-repeat: no-repeat;
  left: 60px;
  position: relative;
  width: 20px;
  height: 20px;
  top: 25px;
}

.stoneIcon {
  background-size: contain;
  background-repeat: no-repeat;
  left: 60px;
  position: relative;
  width: 15px;
  height: 15px;
  top: 22px;
}

.ironIcon {
  background-size: contain;
  background-repeat: no-repeat;
  left: 60px;
  position: relative;
  width: 20px;
  height: 20px;
  top: 25px;
}
</style>


