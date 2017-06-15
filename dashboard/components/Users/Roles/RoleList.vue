<template>
 
<div>
 
 <ul style="padding: 0; margin:0; list-style-type: none;">
   <li v-for="item in roles" style="margin: 5px 0;">
<!--
     {{ item.title }}
     <button @click="confirm(item.id)" class="btn btn-sm btn-danger">delete</button>
-->
  
<!--    <button @click="confirm(item.id)" type="button" class="close" style="float: none;  font-size: 25px;">×</button>-->
  
     <crm_input2 
       v-model="item.title" 
       error_msg="Название не может быть пустым"
       
       @destroy="confirm(item.id)"
       @update="update(item)" 
       :required="true" 
     /> 
  
   </li>
 </ul>
  
  
</div> 
</template>
<script>

import _ from 'lodash'
import axios from '~plugins/axios'
import crm_input2 from '~components/_lib/crm_input2'

export default {
  components: { crm_input2 },
  computed: {
    roles: function(){
      let tmp = []
        
      if ( !_.isUndefined(this.$store.getters['roles/list']) ){
        tmp = this.$store.getters['roles/list']
      }
      
      return tmp
    }
  },
  methods: {
    
    confirm(id){ 
      
        let vm = this
                 
        bootbox.confirm({
          message: "Вы действительно хотите удалить этe роль? ",
          buttons: {
            confirm: {
              label: 'Да',
              className: 'btn-danger'
            },
            cancel: {
              label: 'Нет',
              className: 'btn-default'
            }
          },
          callback: function(result){  
            if (result){
              vm.destroy(id);
            } 
          } 
      })
    },
    update(item){
      
      axios.put('/roles/' + item.id, item)
      .then(function (res) { 
        
        item = res.data
  
      }.bind(this))
      .catch( this.on_error )
      
    }, 
    destroy(id){
       
  
      axios.delete('/roles/' + id, this.form)
      .then(function (res) { 
        
          
//        let tmp = this.$store.state.crm_params 
//         
//          
//        tmp.project_activity_type.children = _.remove( tmp.project_activity_type.children, function(o) {
//          return !_.eq(o.id, id)
//        })
//         
//        this.$store.commit('set_crm_params', tmp )
  
      }.bind(this))
      .catch( this.on_error )  
 
      
    },
  }
}
</script>