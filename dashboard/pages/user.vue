<template>
  
<div class="content-wrapper">
    
  <section class="content-header">
      <h1>
       Пользователь 
      </h1>
 
      
    </section>
 
    <section class="content">


<pre>
  {{ user }}
</pre>
   
    </section>
    
</div>
  
</template>
 
 
<script>
  
import _ from 'lodash' 
  
export default {
  computed: {
    user: function(){
      let tmp = {}
      
      if( !_.isUndefined( this.$store.getters['user/item'] ) ){
        tmp = this.$store.getters['user/item']
      }
      
      console.log(tmp)
      
      return tmp
    }
  },
  mounted(){
    
    if ( _.isEmpty(this.user) ){
      this.$store.dispatch('user/get')
    }
    
  }
}
</script>