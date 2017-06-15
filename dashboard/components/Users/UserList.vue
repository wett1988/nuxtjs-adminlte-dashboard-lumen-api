<template>
  
<div class="row">

<div class="col-md-4" v-for="user in users"> 
   
 <User :value="user"/>  
  
 <nuxt-link :to=" '/users/edit/'+ user.id " v-show="$store.getters['user/isAdmin']">Edit</nuxt-link>
 
<!--  <nuxt-link :to=" '/users/edit/'+ user.id " v-show="$user.isAllowed('update', user)">Edit</nuxt-link>-->
    
<!--  <nuxt-link :to=" '/users/'+ user.id " v-show="$user.isAllowed('destroy', user)">Destroy</nuxt-link>-->

</div>

</div>
  
</template>


<script>
 
import User from '~components/Users/User'
  
//import usersPerimeter from '~plugins/perimeters/usersPerimeter'
  
import _ from 'lodash'
  
export default {
  
  components: { User },
  
//  perimeters: [
//    usersPerimeter
//  ],
  
  computed: {
    users: function(){
      let tmp = [] 
      
      if ( !_.isEmpty( this.$store.getters['users/list'])){
         
        tmp = this.$store.getters['users/list'] 
        
      }  
      
      console.log(tmp)
      
      return tmp
    }
  },
  
 
   
  mounted(){
  
  if ( _.isEmpty(this.users) ){
    this.$store.dispatch('users/get')
  }
     
    
  }
  
}
</script>