<template>
<div class="box box-primary" v-if="!_.isEmpty(current_item)">
           
  <div class="box-header with-border"> 
  </div>
      
  <div class="box-body">
                  
      <User 
        v-model="current_item" 
        v-if="!_.isEmpty(current_item)"
        edit="true" 
        :errors="errors"
      />
              
    <div class="box-footer">
      <button type="submit" class="btn btn-primary pull-right" @click="update">Обновить</button>
      <button class="btn btn-danger pull-left" v-show="$user.isAllowed('destroy', current_item)" @click="confirm">Удалить</button>
    </div>
              
  </div>
</div>
</template> 

<script> 
  
import User from '~components/Users/User'  
  
import axios from '~plugins/axios'
  
import { mapGetters } from 'vuex'
  
import usersPerimeter from '~plugins/perimeters/usersPerimeter'
  
export default {
  components: { User },
  perimeters: [
    usersPerimeter
  ],
  data(){
    return {
      current_item: {},
      errors: {
        raw: [],
        list: []
      },
    }
  },
  computed: mapGetters({
    users: 'users/list'
  }),
  methods: {
    get_form(){
       
        axios.get('/users/'+ this.$route.params.id )
        .then((res) => { 
          this.current_item = res.data 
        }) 
      
    },
    update(){
  
      axios.put('/users/' + this.current_item.id, this.current_item)
      .then(function (res) { 
        
        let user = res.data 
        let tmp = this.users
          
        var index = _.indexOf(tmp, _.find(tmp, { id: user.id }))
        
        tmp.splice(index, 1, user )
  
        this.$store.commit('users/set', tmp ) 
          
        this.get_form()
        
        this.$router.push('/users')
        
      }.bind(this))
      .catch( this.on_error )
 
    },
    confirm(){ 
      
        let vm = this
                 
        bootbox.confirm({
          message: "Вы действительно хотите удалить пользователя? ",
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
              vm.destroy();
            } 
          } 
      })
    },
    destroy(){
  
      axios.delete('/users/' + this.current_item.id)
      .then(function (res) { 
  
        this.$store.commit('users/set', _.remove(this.users, { id: res.data.id }) )
          
        this.$router.push('/users')

      }.bind(this))
      .catch( this.on_error )
 
    },
    on_error(error){ 
        
        console.log(error)
                
        if (typeof error.response.data === 'object') {  
                   
          this.errors.raw = error.response.data
                              
          this.errors.list = _.flatten(_.toArray(error.response.data));
        } else {
          this.errors.list = ['Неизвестная ошибка. Попробуйте еще раз.'];
        } 
    }
  },
  mounted( ){ 
    
    console.log(axios.defaults.headers.common['Authorization'])
    
    console.log('edit data')
 
    this.current_item = _.find(this.users, { id: parseInt(this.$route.params.id) })
    
    console.log(this.current_item)
  
    this.get_form()
       
  },
  head: {
    title: 'Редактирование данных пользователя'
  },
 
}
</script> 