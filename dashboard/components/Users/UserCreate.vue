<template>
<div class="box box-primary">
           
  <div class="box-header with-border">
    <h3 class="box-title">Новый пользователь</h3>
  </div>
         
  <div class="box-body" v-show="$user.isAllowed('create')">
                
    <User 
      v-model="form" 
      v-if="!_.isUndefined( form )"
      edit="true" 
      :errors="errors" 
    />
              
    <div class="box-footer">
      <button type="submit" class="btn btn-primary pull-right" @click="store">Добавить</button>
    </div>
              
  </div>
  
  <div class="box-body" v-show="!$user.isAllowed('create')">
   Вы не можете создавать пользователей
  </div>
  
</div>
</template>

<script> 
  
import axios from '~plugins/axios'
  
import User from '~components/Users/User' 
  
import { mapGetters } from 'vuex'
  
import userPerimeter from '~plugins/perimeters/usersPerimeter'
  
export default {
  components: { User },
  
  perimeters: [
    userPerimeter
  ],
  
  computed: mapGetters({
    users: 'users/list'
  }),
  
  data(){
    return {
      form: {},
      errors: {
        raw: [],
        list: []
      },
    }
  },
   
  mounted(){
    
   this.get_form()
    
  },
  
  methods: { 
    get_form(){
      
      axios.get( '/users/create' )
      .then((res) => { 
        this.form = res.data 
      })
      
    },
    store(){
       
      axios.post('/users', this.form)
      .then(function (res) { 
          
        let tmp = this.$store.state.users.list  
        tmp.push( res.data ) 
        this.$store.commit('users/set', tmp )
        
        this.get_form()
          
        this.$router.push('/users')

      }.bind(this))
      .catch( this.on_error )  
 
      
    },
    on_error(error){
             
      if (typeof error.response.data === 'object') {  
                              
        this.errors.raw = error.response.data
                              
        this.errors.list = _.flatten(_.toArray(error.response.data));
      } else {
        this.errors.list = ['Неизвестная ошибка. Попробуйте еще раз.'];
      } 
    }
  },
 
  head: {
    title: 'Новый пользователь'
  },
 
}
</script>