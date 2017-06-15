<template>
  
<div>

<header>

<div class="container-fluid"> 
<div class="container"> 
 
 Header
  
  <ul>
    <li><nuxt-link to="/auth/signin">signin</nuxt-link></li>
<!--    <li><nuxt-link to="/auth/signin" @click.capture="signout">signout</nuxt-link></li>-->
    <li><a href="#" @click.prevent="signout">signout</a></li>
    <li></li>
    <li><nuxt-link to="/">index</nuxt-link></li> 
    <li><nuxt-link to="/users">users</nuxt-link></li>
    <li><nuxt-link to="/user">user</nuxt-link></li>
  </ul>
  
<!--  <button @click="tmp">child</button>-->
   
</div>
</div>

</header>

<nuxt/>

<footer>
 
<div class="container-fluid"> 
<div class="container"   > 

Footer
 
</div>
</div>
  
</footer>
   
</div>
   
</template>

<script>
  
import Vue from 'vue'
import _ from 'lodash' 
//import VueKindergarten from 'vue-kindergarten'
//import child from '~plugins/child'
  
import auth_init from '~plugins/auth_init'
  
Vue.mixin({
  computed: {
    _() {
      return _
    },
    Cookies() {
      return Cookies
    }
  }
}) 
  
 
  
//Vue.use(VueKindergarten, {
//  child,
//});
  
export default {
  middleware: ['auth'],
  mounted(){  
  
    auth_init(this.$store, this.$router)
    
    if ( _.isEmpty( this.$store.getters['users/list'] ) ){
      this.$store.dispatch('users/get')
    } 
    
  },
  methods:{
    tmp(){
      console.log( child.state )
    },
    signout(){
      console.log('signout')
      
//      this.$store.commit('user/drop') 
      Cookies.remove('user');
      
      this.$router.push('/auth/signin')
    }
  }
}
</script>
